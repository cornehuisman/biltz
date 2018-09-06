<?php
    /**
     * Template Name: Services
     */

    get_header();

    $header_image = get_field('header_image');
?>

<header class="header header_second">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 header_wrapper_flex">
                <div class="header_wrapper text-center">
                    <h1 data-aos="fade-up"><?php the_field('header_title'); ?></h1>
                    <h3 data-aos="fade-up" data-aos-delay="100"><?php the_field('header_subtitle'); ?></h3>
                    <div class="border-bottom"></div>
                </div>
            </div>
        </div>
    </div>
    <div data-aos="zoom-in" data-aos-delay="400" class="header_image" style="background-image: url('<?php echo $header_image['url']; ?>');"></div>
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('
                <p data-aos="fade-up" data-aos-deley="150" id="breadcrumb">','</p>
            ');
        }
    ?>
</header>

<section class="intro" id="intro">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 data-aos="fade-up" data-aos-delay="100"><?php the_field('intro_title'); ?></h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h5 data-aos="fade-up" data-aos-delay="200" class="quote"><?php the_field('intro_quote'); ?></h5>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<section class="services ptn pdbs">
    <div class="container">
        <div class="row">
            <?php
                $terms = get_terms( 'projecten-categories', array("hide_empty" => false ));
                $i = 0;
                foreach ($terms as $t ) {
                $i++;
                $service_image = get_field('cat_service_image','term_' . $t->term_id );
            ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 dienst <?=$t->name?>">
                    <div class="dienst_wrapper" style="background-image: url('<?php echo $service_image['url']; ?>');">
                        <div class="overlay" style="background-color:<?php the_field('color','term_' . $t->term_id );?>;"></div>
                        <h3><?=$t->name?></h3>
                        <a href="<?= get_field('page_link','term_' . $t->term_id ); ?>" class="coverlink"></a>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>

<?php
    $about_us_image = get_field('about_us_image');
?>
<section id="about-us" class="about-us right" style="background-image: url('<?php echo $about_us_image['url']; ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div data-aos="fade-left" class="about-us-wrapper bg-white">
                    <h3><?php the_field('about_us_title'); ?></h3>
                    <?php the_field('about_us_content'); ?>
                    <a href="<?php the_field('about_us_button_link'); ?>" class="button"><i class="icon-tool"></i> <?php the_field('about_us_button_text'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $communicatie_image = get_field('communicatie_image');
?>
<section id="communication" class="communication">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 data-aos="fade-up"><?php the_field('communicatie_title'); ?></h2>
            </div>
            <div class="col-xs-12">
                <div data-aos="fade-up" data-aos-delay="100" class="text_wrapper">
                    <?php the_field('communicatie_content'); ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div data-aos="fade-up" data-aos-delay="200" class="communcation_image" style="background-image: url('<?php echo $communicatie_image['url']; ?>');">
                    <h4><?php the_field('communication_image_text'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slider ptn">
    <div class="main-carousel">
        <?php
            if ( have_rows('slider') ) :
                $i = 0;
                while ( have_rows('slider') ) :
                    the_row();
                    if ( $i != 0 && ($i % 2 == 0 || $i % 6 > 4)):
                        ?>
                            </div>
                        <?php
                    endif;
                    if ( $i % 2 == 0 || $i % 6 > 4 ):
                        ?>
                            <div class="carousel-cell">
                        <?php
                    endif;
                    $slider_image = get_sub_field('slider_image');

                    ?>
                        <div class="image style-<?=$i%6?>" style="background-image: url('<?php echo $slider_image['url']; ?>');"></div>
                    <?php
                    $i++;
                endwhile;
                ?>
                </div>
                <?php
            endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
