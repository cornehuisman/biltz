<?php

// AJAX LOAD CUSTOM POST TYPE projecten
add_action( 'wp_ajax_zz_lazyload','zz_get_projecten' );
add_action( 'wp_ajax_nopriv_zz_lazyload','zz_get_projecten' );
function zz_get_projecten() {
    if ( !isset( $_POST['search'] ) || !isset( $_POST['search']['projecten-loader'] ) ) {
        return;
    }

    if ( !isset( $_POST['start'] ) || !isset( $_POST['limit'] ) ) {
		echo json_encode( array() );
        wp_die();
	}

	$start 	= max( 0, $_POST['start'] );
	$limit 	= $_POST['limit'];


	$tax_query = array();
    if ( $_POST['search'] && $_POST['search']['category'] ) {
		$tax_query[] = array(
			'taxonomy' => 'projecten-categories',
			'field' => 'term_id',
			'terms' => explode( ',', $_POST['search']['category'] ),
		);
	}

    $exclude = array();
    if ( $_POST['search'] && $_POST['search']['exclude'] ) {
		$exclude = explode( ',', $_POST['search']['exclude'] );
    }

    $post_type = 'projecten';
    if ( $_POST['search'] && $_POST['search']['post_type'] ) {
   		$post_type = $_POST['search']['post_type'];
    }
    $args = array(
        'post_type'         => $post_type,
        'posts_per_page'    => $limit,
        'orderby' 	        => 'rand',
        'tax_query'         => $tax_query,
        'exclude'           => $exclude
    );
    // if ($_POST['search']['projecten-loader'] == '1' ){
    //     $args['order'] = 'ASC';
    //     $args['orderby'] = 'date';
    // }
    if ( isset( $_POST['search']['sort'] ) ) {
        switch( $_POST['search']['sort'] ) {
            case 'asc':
                $args['order'] = 'ASC';
                $args['orderby'] = 'date';
                break;
            case 'desc':
                $args['order'] = 'DESC';
                $args['orderby'] = 'date';
                break;
        }
    }

    $json_posts = array();

    $posts = get_posts( $args );
    foreach( $posts as $post ) {
        setup_postdata( $post );

        $terms = wp_get_post_terms( $post->ID, 'projecten-categories' ); // Get all terms of a taxonomy
        $thumb = get_post_thumbnail_id( $post->ID );
        $image = vt_resize( $thumb, '', 1600, 900, true );

        $term_slug = '';
        if ( count( $terms ) == 1 ) {
            $term_slug = $terms[0]->slug;
        }

        $json_post = array(
            'id'                => $post->ID,
            'term_slug'         => $term_slug,
            'term_name'         => $term_slug,
            'image_url'         => $image['url'],
            'title'             => get_the_title( $post->ID ),
            'permalink'         => get_permalink( $post->ID ),
            'color'             => get_field('color','term_'.$terms[0]->term_id)
        );

        $json_posts[] = $json_post;
    }
	wp_reset_postdata();

	echo json_encode( $json_posts );
	wp_die();
}

// CUSTOM POST TYPE projecten
add_action('init', 'create_redvine_projecten');
function create_redvine_projecten()
{
  $labels = array(
    'name' => _x('Projecten', 'projecten'),
    'singular_name' => _x('Projecten', 'projecten'),
    'add_new' => _x('Nieuw project', 'projecten'),
    'add_new_item' => __('Nieuwe project'),
    'edit_item' => __('Bewerk project'),
    'new_item' => __('Nieuw project'),
    'view_item' => __('Bekijk project'),
    'search_items' => __('Zoek naar een project'),
    'not_found' =>  __('Geen projecten gevonden'),
    'not_found_in_trash' => __('Geen projecten in de prullenbak gevonden'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'has_archive' => false,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-hammer',
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','thumbnail','revisions', 'editor')
  );
  register_post_type('projecten',$args);

    register_taxonomy( "projecten-categories",
        array( 	"projecten" ),
        array( 	"hierarchical" => true,
        		"labels" => array(
                    'name'=>"Categorieën",
                    'add_new_item'=>"Voeg categorie toe"
                ),
        		"singular_label" => __( "Field" ),
        	 )
    );
}

add_action('restrict_manage_posts', 'tsm_filter_projecten');
function tsm_filter_projecten() {
	global $typenow;
	$post_type = 'projecten'; // change to your post type
	$taxonomy  = 'projecten-categories'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
