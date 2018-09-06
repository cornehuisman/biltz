<?php
/**
 * Template Name: Helden
 */

get_header();
?>

<?php
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

<section class="heros pdrm" id="heros">
    <div class="container-fluid">
        <div class="zz-lazyload-search">
            <input type="hidden" name="helden-loader" value="1" />
            <div class="hero_wrapper">
                <div id="zz-lazyload-container" class="template-heros">
                    <!-- LOADED BY AJAX -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
