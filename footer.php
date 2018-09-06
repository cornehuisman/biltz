<?php if ( is_singular('helden') ) : ?>

<?php else: ?>

    <footer>
        <div class="container">
            <div class="row">
                <div class="footer_brands">
                    <?php
                        if ( have_rows('brands', 'options') ) :
                            $i = 0;
                            while ( have_rows('brands', 'options') ) :
                                $i++;
                                the_row();

                                $footer_brand = get_sub_field('brand', 'options');
                                ?>
                                <div data-aos="fade-up" data-aos-offset="50" data-aos-delay="<?php echo $i; ?>00" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="<?php echo get_permalink(555); ?>" class="brand__link">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="brand" viewBox="0 0 400 377">
                                            <defs>
                                                <filter id="filtersPicture">
                                                    <feComposite result="inputTo_38" in="SourceGraphic" in2="SourceGraphic" operator="arithmetic" k1="0" k2="1" k3="0" k4="0" />
                                                    <feColorMatrix id="filter_38" type="saturate" values="0" data-filterid="38" />
                                                </filter>
                                            </defs>
                                            <image filter="url(&quot;#filtersPicture&quot;)" x="0" y="0" width="400" height="377" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $footer_brand['url']; ?>" alt="<?php the_field('logo'); ?>"/>
                                        </svg>
                                    </a>
                                </div>
                                <?php
                            endwhile;
                        endif;
                    ?>
                </div>

                <div data-aos="fade-up" data-aos-offset="0" class="footer_contact">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-5">
                            <div class="contact">
                                <a href="mailto:<?php the_field('mail', 'option'); ?>"><?php the_field('mail', 'option'); ?></a>
                                <a href="tel:<?php the_field('number', 'option'); ?>"><?php the_field('number', 'option'); ?></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
                            <div class="copyright text-center">
                                <p>Realisatie door <a href="https://zekerzichtbaar.nl" target="_blank">Zeker Zichtbaar</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="social">
                                <a class="facebook" href="<?php the_field('facebook', 'option'); ?>"><i class="icon-facebook"></i></a>
                                <a class="twitter" href="<?php the_field('twitter', 'option'); ?>"><i class="icon-twitter"></i></a>
                                <a class="linkedin" href="<?php the_field('linkedin', 'option'); ?>"><i class="icon-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 visible-xs">
                            <div class="copyright text-center">
                                <p>Realisatie door <a href="https://zekerzichtbaar.nl" target="_blank">Zeker Zichtbaar</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php endif; ?>
</main>
<?php wp_footer();?>

<script>
    jQuery( document ).ready( function( $ ){
        if ( jQuery( '.projects #zz-lazyload-container' ).length != 0 ) {
             var lazy = new ZZLazyLoad({
                ajax_url: zzlazyload_params.ajax_url,
                search_delay_time_ms: 0,
                fade_in_time_ms: 200,
                partial_num_load: 4,
                with_button: true,
                constructItem: function( item ) {
                    return '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 project-item ' + item.term_name + '">' +
                                '<input type="hidden" name="exclude" value="' + item.id + '"/>' +
                                    '<div class="project" style="background-image:url(\'' + item.image_url + '\');">' +
                                        '<div class="project_wrapper">' +
                                            '<div class="overlay" style="background-color: ' + item.color + ';"></div>' +
                                            '<div class="content">' +
                                                '<h3 class="white project_title">' + item.title + '</h3>' +
                                            '</div>' +
                                            '<a class="coverlink" href="' + item.permalink + '"></a>' +
                                        '</div>' +
                                    '</div>' +
                            '</div>';
                },

                constructFinished: function() {
                    return '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center item"><div class="button end-loading">Er zijn niet meer projecten beschikbaar!</div></div>';
                },

                constructLoader: function() {
                    return '<div class="text-center loading"><span class="button loading"><i class="icon-loadmore"></i></span></div>';
                },
                constructButton: function() {
                 	return jQuery('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadmore-btn"><div class="button loadmore-btn"><i class="icon-loadmore"></i> Meer laden <span class="icon-loading"></span></div></div>');
                }
            });
        }

        if ( jQuery( '#heros #zz-lazyload-container' ).length != 0 ) {
             var lazy = new ZZLazyLoad({
                ajax_url: zzlazyload_params.ajax_url,
                search_delay_time_ms: 0,
                fade_in_time_ms: 200,
                partial_num_load: 4,
                with_button: true,
                constructItem: function( item ) {
                    return '<div class="col-lg-4 col-sm-6 col-xs-6">' +
                                '<input type="hidden" name="exclude" value="' + item.id + '"/>' +
                                '<div class="hero" style="background-image: url('+ item.image_url +');">' +
                                    '<div class="hero_title_wrapper" style="background-color:' + item.color + ';">' +
                                        '<h4>' + item.title + '</h4>' +
                                    '</div>' +
                                    '<div class="hero_title_wrapper_hover" style="background-color:' + item.color + ';">' +
                                        '<h4>Bekijk deze held</h4>' +
                                    '</div>' +
                                    '<a href="' + item.permalink + '" class="coverlink"></a>' +
                                '</div>' +
                                '<div class="content" style="color:' + item.color + ';"><p>' + item.content + '</p></div>' +
                            '</div>';
                },

                constructFinished: function() {
                    return '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center item"><div class="button end-loading">Er zijn niet meer helden beschikbaar!</div></div>';
                },
                constructLoader: function() {
                    return '<div class="text-center loading"><span class="button loading"><i class="icon-loadmore"></i></span></div>';
                },
                constructButton: function() {
                 	return jQuery('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadmore-btn"><div class="button loadmore-btn"><i class="icon-loadmore"></i> Meer laden <span class="icon-loading"></span></div></div>');
                }
            });
        }
    });
</script>

<div class="popup">
    <div class="popup__wrapper">
        <div class="popup__close">
            <i class="icon-cross"></i>
        </div>
        <video controls loop id="popup-vid" preload>
            <source src="https://player.vimeo.com/external/264197557.hd.mp4?s=a10d05ee562bd27329afeb3fb25dd9fd43da9a9f&profile_id=174" type="video/webm">
            <source src="https://player.vimeo.com/external/264197557.hd.mp4?s=a10d05ee562bd27329afeb3fb25dd9fd43da9a9f&profile_id=174" type="video/mp4">
        </video>
    </div>
</div>

</body>
</html>
