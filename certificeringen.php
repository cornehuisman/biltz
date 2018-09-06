<?php
/**
 * Template Name: Competenties
 */
get_header();

$header_image = get_the_post_thumbnail_url();
?>
<header class="header third" style="background-image: url('<?php echo $header_image; ?>');">
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

<section class="competenties">
    <div class="container">
        <div class="row">
            <?php
            if( have_rows('competenties') ):
                while( have_rows('competenties') ): the_row();
                    $brand = get_sub_field('brand');
                    ?>
                    <div class="col-md-8 col-sm-12 competenties__item">
                        <div class="competenties__item__head">
                            <h3><?php the_sub_field('title'); ?></h3>
                            <img src="<?php echo $brand['url']; ?>" alt="<?php echo $brand['title']; ?>">
                        </div>
                        <?php the_sub_field('content'); ?>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<?php 
get_footer();
?>
