<?php 
/**
 * Template Name: Standaard
 */

get_header(); ?>



<section id="basic">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-8 col-md-6 col-md-6 col-sm-12 col-xs-12">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            
            </div>
        	<div class="col-lg-4 col-md-6 col-md-6 col-sm-12 col-xs-12">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('widget') ) : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer();?>