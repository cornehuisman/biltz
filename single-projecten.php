<?php

get_header();
?>

<?php
    // $category = get_the_category('projecten-categories');
    // $color = get_field('color', 'term_'.$category->term_id);
    $header_image = get_the_post_thumbnail_url();

    $id = get_the_id();
    $terms = get_the_terms( $id, 'projecten-categories' );
    $color = get_field('color', 'term_'.$terms->term_id);
?>
<header class="header third" style="background-image: url('<?php echo $header_image; ?>');">
    <div class="header_overlay" style="background-color: <?php echo $color; ?>;"></div>
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

<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-5 col-xs-12">
                <table>
                    <tr data-aos="fade-up" data-aos-delay="100">
                        <td class="intro_title">Klant</td>
                        <td class="intro_subtitle"><?php the_field('project_customer'); ?></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="200">
                        <td class="intro_title">Product</td>
                        <td class="intro_subtitle"><?php the_field('project_product'); ?></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="300">
                        <td class="intro_title">Jaar</td>
                        <td class="intro_subtitle"><?php the_field('project_year'); ?></td>
                    </tr>
                </table>
            </div>
            <div data-aos="fade-up" data-aos-delay="300" class="col-md-8 col-sm-7 col-xs-12">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<section class="textbox">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-11 col-xs-12">
                <div class="textbox_title">
                    <h2 data-aos="fade-up"><?php the_field('project_title'); ?><span data-aos="fade-left" data-aos-delay="100" class="number">01</span></h2>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <?php the_field('project_content'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="images">
    <div class="service_images_wrapper">
        <?php
            if ( have_rows('project_images') ) :
                while ( have_rows('project_images') ) :
                    the_row();

                    $project_image = get_sub_field('project_image');
                    ?>
                        <div class="service_image" style="background-image: url('<?php echo $project_image['url']; ?>');"></div>
                    <?php
                endwhile;
            endif;
        ?>
    </div>
</section>

<section class="textbox back-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-11 col-xs-12">
                <div class="textbox_title">
                    <h2 data-aos="fade-up"><?php the_field('project_title_two'); ?><span class="number">02</span></h2>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <?php the_field('project_content_two'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="images">
    <div class="service_images_wrapper">
        <?php
            if ( have_rows('project_images') ) :
                while ( have_rows('project_images') ) :
                    the_row();

                    $project_image = get_sub_field('project_image');
                    ?>
                        <div class="service_image" style="background-image: url('<?php echo $project_image['url']; ?>');"></div>
                    <?php
                endwhile;
            endif;
        ?>
    </div>
</section>

<section class="reference text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="reference_content">
                    <span data-aos="zoom-in" data-aos-delay="700">"</span>
                    <div data-aos="fade-up">
                        <?php the_field('reference_content'); ?>
                    </div>
                </div>
                <div class="reference_name">
                    <h4>
                        <span data-aos="fade-up" data-aos-delay="100"><?php the_field('reference_name'); ?></span>
                        <div data-aos="fade-up" data-aos-delay="200" >
                            <?php the_field('reference_companyname'); ?>
                        </div>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>




<?php get_footer(); ?>
