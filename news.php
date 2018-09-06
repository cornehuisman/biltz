<?php
/**
 * Template Name: Nieuws
 */

get_header();
$header_image = get_field('header_image');
?>

<header class="header third" style="background-image: url('<?php echo $header_image['url']; ?>');">
    <div data-aos="fade-up" class="header_wrapper_right bg-white">
        <h1><?php the_title(); ?></h1>
    </div>
</header>
<div class="breadcrumb">
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('
            <p id="breadcrumb">','</p>
            ');
        }
    ?>
</div>

<section id="news">
    <div class="container-fluid">
        <?php echo do_shortcode('[zz-social-feed id="437"]'); ?>
    </div>
</section>




<?php get_footer(); ?>
