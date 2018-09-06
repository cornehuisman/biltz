<?php
// AJAX LOAD CUSTOM POST TYPE HELDEN
add_action( 'wp_ajax_zz_lazyload','zz_get_helden' );
add_action( 'wp_ajax_nopriv_zz_lazyload','zz_get_helden' );
function zz_get_helden() {
    if ( !isset( $_POST['search'] ) || !isset( $_POST['search']['helden-loader'] ) ) {
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
			'taxonomy' => 'helden-categories',
			'field' => 'term_id',
			'terms' => explode( ',', $_POST['search']['category'] ),
		);
	}

    $exclude = array();
    if ( $_POST['search'] && $_POST['search']['exclude'] ) {
		$exclude = explode( ',', $_POST['search']['exclude'] );
    }

    $post_type = 'helden';
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

        $terms = wp_get_post_terms( $post->ID, 'helden-categories' ); // Get all terms of a taxonomy
        $thumb = get_post_thumbnail_id( $post->ID );
        $image = vt_resize( $thumb, '', 1600, 900, true );

        $term_slug = '';
        if ( count( $terms ) == 1 ) {
            $term_slug = $terms[0]->slug;
        }

        $json_post = array(
            'id'                => $post->ID,
            'term_slug'         => $term_slug,
            'image_url'         => $image['url'],
            'title'             => get_the_title( $post->ID ),
            'permalink'         => get_permalink( $post->ID ),
            'color'             => get_field( 'heros_color', $post->ID ),
            'content'           => get_the_content( $post->ID )
        );

        $json_posts[] = $json_post;
    }
	wp_reset_postdata();

	echo json_encode( $json_posts );
	wp_die();
}

// CUSTOM POST TYPE projecten
add_action('init', 'create_redvine_helden');
function create_redvine_helden()
{
  $labels = array(
    'name' => _x('Helden', 'helden'),
    'singular_name' => _x('Helden', 'helden'),
    'add_new' => _x('Held toevoegen', 'helden'),
    'add_new_item' => __('Nieuwe held'),
    'edit_item' => __('Bewerk held'),
    'new_item' => __('Held toevoegen'),
    'view_item' => __('Bekijk held'),
    'search_items' => __('Zoek naar een held'),
    'not_found' =>  __('Geen helden gevonden'),
    'not_found_in_trash' => __('Geen helden in de prullenbak gevonden'),
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
  register_post_type('helden',$args);

    register_taxonomy( "helden-categories",
        array( 	"helden" ),
        array( 	"hierarchical" => true,
        		"labels" => array(
                    'name'=>"Categorieën",
                    'add_new_item'=>"Voeg categorie toe"
                ),
        		"singular_label" => __( "Field" ),
        	 )
    );
}

add_action('restrict_manage_posts', 'tsm_filter_helden');
function tsm_filter_helden() {
	global $typenow;
	$post_type = 'helden'; // change to your post type
	$taxonomy  = 'helden-categories'; // change to your taxonomy
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
?>
