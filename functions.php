<?php
require_once(__DIR__ . '/includes/autoload.php');


function add_js_and_css() {
    global $wp_scripts;
    wp_enqueue_style( 'global', get_template_directory_uri() . '/assets/css/global.min.css', array(), '1.0.4' );
}
add_action( 'wp_enqueue_scripts', 'add_js_and_css' );


function footer_enqueue() {
    wp_enqueue_script( 'jquery', get_template_directory_uri(). '/assets/js/jquery-2.1.1.min.js', array( 'jquery') );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri(). '/assets/js/bootstrap.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'flickity', get_template_directory_uri(). '/assets/js/flickity.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'zz-lazyload', get_template_directory_uri(). '/assets/js/lazyload.js', array( 'jquery' ) );
    wp_enqueue_script( 'aos', get_template_directory_uri(). '/assets/js/aos.js', array( 'jquery' ) );
    wp_enqueue_script( 'script', get_template_directory_uri(). '/assets/js/script.js', array( 'jquery') );
    wp_enqueue_script( 'fallback', get_template_directory_uri(). '/assets/js/object-fit_fallback.js', array( 'jquery' ) );

    wp_localize_script( 'zz-lazyload', 'zzlazyload_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_footer', 'footer_enqueue');


function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary' ),
            'secondary' => __( 'Secondary' ),
            'footermenu' => __( 'Footermenu' ),
            'footermenu2' => __( 'Footermenu2' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Website opties',
		'menu_title'	=> 'Website opties',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer opties',
		'menu_title'	=> 'Footer opties',
		'parent_slug'	=> 'theme-general-settings',
	));

}

// Active single post type page
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
  function add_current_nav_class($classes, $item) {

    global $post;

    $current_post_type = get_post_type_object(get_post_type($post->ID));
    $current_post_type_slug = $current_post_type->rewrite[slug];

    $menu_slug = strtolower(trim($item->url));

    if (strpos($menu_slug,$current_post_type_slug) !== false) {
        $classes[] = 'current_page_item';
    }

    return $classes;
}

// Excerpt
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Add posttype to breadcrumbs
add_filter( 'wpseo_breadcrumb_links', 'my_wpseo_breadcrumb_links' );
function my_wpseo_breadcrumb_links( $links ) {
    if ( is_single() ) {
        $cpt_object = get_post_type_object( get_post_type() );
        if ( ! $cpt_object->_builtin ) {
            $landing_page = get_page_by_path( $cpt_object->rewrite['slug'] );
            array_splice( $links, -1, 0, array(
                array(
                    'id'    => $landing_page->ID
                )
            ));
        }
    }

    return $links;
}


