<?php

function zz_get_previous_post( $current_post, $infinite = true, $post_type = 'post', $taxonomy = '', $term_id = '' ) {
	return zz_get_post( $current_post, $infinite, $post_type, $taxonomy, $term_id, true );
}
function zz_get_next_post( $current_post, $infinite = true, $post_type = 'post', $taxonomy = '', $term_id = '' ) {
	return zz_get_post( $current_post, $infinite, $post_type, $taxonomy, $term_id );
}

function zz_get_post( $current_post, $infinite, $post_type, $taxonomy, $term_id, $prev = false ) {
	$args = array(
		'posts_per_page' => 1,
		'post_type' => $post_type,
		'post__not_in' => array( $current_post->ID ),
		'order' => 'ASC',
	);
	
    if ( $term_id != '' && $taxonomy != '' ) {
    	$args[ 'tax_query' ] = array(
    		array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => array( $term_id ),
			)
    	);
    }
    
    if ( $prev ) {
		$args['order'] = 'DESC';
		$args['date_query'] = array(
			array(
				'before'    => $current_post->post_date,
				'inclusive' => true,
			),
		);
    }
    else {    
		$args['date_query'] = array(
			array(
				'after'    => $current_post->post_date,
				'inclusive' => true,
			),
		);
	}
    
    
    $post = new WP_Query( $args );
    
    if ( count( $post->posts ) == 0 ) {
    	if ( $infinite ) {
    		unset( $args['date_query'] );
			$post = new WP_Query( $args );
			if ( count( $post->posts ) > 0 ) {
				return $post->posts[0];
			}    		
    	}   
    
    
    	return false;
	}
 	return $post->posts[0];
}