<?php
    /*
        Template name: Contact
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
    <div data-aos="fade-up" class="header_image" style="background-image: url('<?php echo $header_image['url']; ?>');"></div>
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('
                <p data-aos="fade-up" data-aos-deley="150" id="breadcrumb">','</p>
            ');
        }
    ?>
</header>

<section class="contact">
    <div class="container">
        <div class="row">
            <div data-aos="fade-up" class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <?php echo do_shortcode('[contact-form-7 id="301" title="Contactformulier"]'); ?>
            </div>
            <div data-aos="fade-up" data-aos-delay="100" class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 contact_data">
                <a class="logo" href="<?php echo site_url(); ?>"><img src="<?= get_template_directory_uri()?>/assets/img/logo.svg" alt="Logo"/></a>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php
    $company_image = get_field('route_image');
?>
<section id="route" class="route right" style="background-image: url('<?php echo $company_image['url']; ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div data-aos="fade-left" class="route-wrapper bg-white">
                    <h3><?php the_field('route_title'); ?></h3>
                    <?php the_field('route_content'); ?>
                    <a href="<?php the_field('route_button_link'); ?>" target="_blank" class="button"> <?php the_field('route_button_text'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>
