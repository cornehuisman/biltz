function ZZLazyLoad( options ) {
    var defaults = {
        container: '#zz-lazyload-container',
        search_inputs: '.zz-lazyload-search input, .zz-lazyload-search select',
        initial_num_load: 10,
        partial_num_load: 10,
        fade_in_time_ms: 100,
        search_delay_time_ms: 500,
        with_button: false,
        ajax_url: '',
        constructItem: this.constructItem,
        constructLoader: this.constructLoader,
        constructFinished: this.constructFinished,
        constructButton: this.constructButton
    }
    this.options = jQuery.extend( defaults, options );
    
    if ( this.options.ajax_url == '' ) {
        console.error('Give a valid ajax_url argument to the ZZLazyLoad!');
        return;
    }
    
    this.$container = jQuery( this.options.container );
    if ( this.$container == undefined || this.$container.length == 0 ) {
        console.error('Give a valid container selector to the ZZLazyLoad!');
        return;
    }
    
    this.search_delay_timer; // Wait before loading when search inputs changed.
    this.fade_timer = setInterval( this.showItem(), this.options.fade_in_time_ms );  // To make an effect each item is faded in seperately.
    
    this.loading_more_items = false;
    this.possibly_more_items = true;
    
    this.$search_inputs = jQuery( this.options.search_inputs );
    
    this.$search_inputs.on( 'change input keyup', this.doFilter() );
    this.doFilter()();
    
    
    if ( !this.options.with_button )
        jQuery(window).on( 'scroll', this.handleScroll() );
    
}



// ERROR HANDLING
ZZLazyLoad.prototype.handleErrorAJAX = function( response ) {
    this.$container.find('.item').remove();
    clearInterval( this.fade_timer );
    console.error( response );
}


// FINISHED LOADING
ZZLazyLoad.prototype.constructFinished = function() {
    return '<div class="item">No more items available!</div>';
}
ZZLazyLoad.prototype.constructButton = function() {
    return jQuery('<button class="loadmore-btn">Load more</button>');
}


// LOADER
ZZLazyLoad.prototype.constructLoader = function() {
    return '<span class="glyphicon glyphicon-refresh rotate"></span>';
}
ZZLazyLoad.prototype.removeLoaders = function() {
    this.$container.parent().find('.loader').remove();
    this.removeButton();
}
ZZLazyLoad.prototype.removeButton = function() {
    this.$container.parent().find('.loadmore-btn').remove();
}
ZZLazyLoad.prototype.addLoader = function() {
    this.removeLoaders();
    this.$container.append( jQuery( '<div>' ).addClass('loader').html( this.options.constructLoader() ) );
}



// HANDLE SCROLL
ZZLazyLoad.prototype.handleScroll = function() {
    var item = this;
    return function() {
        var scrolled        = parseInt( jQuery(window).scrollTop() );
        var scrollHeight    = parseInt( jQuery('body')[0].scrollHeight ) - parseInt( jQuery(window).height() );

        if ( scrolled >= scrollHeight ) {
            item.loadMoreItems();
        }
    }
}
ZZLazyLoad.prototype.addButton = function() {
    var $button = this.options.constructButton();
    var item = this;
    $button.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        item.loadMoreItems();
    });
    this.$container.append($button);
}




// AJAX
ZZLazyLoad.prototype.showItem = function() {
    var item = this;
    return function() {
        item.$container.find('.item').not('.in').first().addClass('in');
    }
}
ZZLazyLoad.prototype.doFilter = function() {
    var item = this;
    return function() {
        item.$container.find('.item').remove();
        item.$container.parent().find('.end-loading').remove();
        item.addLoader();
        
        item.possibly_more_items = true;

        clearTimeout( item.search_delay_timer );
        item.search_delay_timer = setTimeout(function() {
            item.loadMoreItems( true );
        }, item.options.search_delay_time_ms );
    }
}
                                
ZZLazyLoad.prototype.loadMoreItems = function( clear_container ) {
    if ( this.loading_more_items ) { // If already loading more items.
        return;
    }
    if ( !this.possibly_more_items ) { // No more items available.
        return;
    }

    this.addLoader();
    this.loading_more_items = true; // Now loading more items.
    
    this.$search_inputs = jQuery( this.options.search_inputs );
    
    var search = {};
    this.$search_inputs.each( function() {
        var $this = jQuery(this);
        if ( $this.attr('type') == 'radio' || $this.attr('type') == 'checkbox' ) {
            if ( !$this.is(':checked') ) {
                return;
            }
        }
        if ( $this.attr('name') in search ) {
            search[ $this.attr('name') ] += ',' + $this.val();
            return;
        }
        search[ $this.attr('name') ] = $this.val();
        
    })
    
    var item = this;
    item.$container.addClass('loading');
    jQuery.ajax({
        url: this.options.ajax_url,
        type: 'POST',
        data:{ 
            action: 'zz_lazyload',
            search: search,
            start: this.$container.children().length - 1, // Minus the loader
            limit: this.options.partial_num_load
        },
        success: function( data ){
            item.$container.removeClass('loading');
            item.removeLoaders();
            if ( clear_container ) {
                item.$container.find('.item').remove();
            }

            var json = JSON.parse( data );
            item.constructItems( json );

            clearInterval( item.fade_timer );
            item.fade_timer = setInterval( item.showItem(), item.options.fade_in_time_ms );

            item.loading_more_items = false;
            if ( json.length == item.options.partial_num_load ) {
                item.possibly_more_items = true;  
                if ( !item.options.with_button )          		
                    item.handleScroll()();
                else
                    item.addButton();
            }
            else {
                item.possibly_more_items = false;
                item.$container.append( item.options.constructFinished() );
            }
        },
        error: item.handleErrorAJAX
    })
}



// ADD STANDARD ITEM ELEMENTS
ZZLazyLoad.prototype.constructItems = function( json ) {
    for ( var i = 0; i < json.length; i++ ) {
        var item = json[i];
        var el = this.options.constructItem( item );
        this.$container.append( jQuery( el ).addClass('item'));
    }
}
ZZLazyLoad.prototype.constructItem = function( item ) {
    var el = jQuery( '<div>' );
    Object.keys( item ).forEach( function( key ) {
        el.append( jQuery('<div>').html( '<b>' + key + ':</b>' + item[key] ) );
    });
    return el;
}