<?php
/**
 * Template Name: Makemyblock
 */

get_header();

$args = array(
    'post_type'         => 'makemyblock',
    'orderby'           => 'rand',
    'posts_per_page'    => 1,
);
$myposts = get_posts($args);
foreach ($myposts as $post) : setup_postdata($post);

    $header_image = get_field('screen_image');
    $header_link = get_field('screen_link');
    ?>
    <header class="header">
        <div class="header__slider">
            <div class="header__slide">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7 header__image__wrapper">
                            <div class="header__image" style="background-image: url('<?php echo $header_image['url']; ?>')"></div>
                        </div>
                        <div class="col-md-offset-6 col-md-6">
                            <div class="header__wrapper">
                                <h1><?php the_field('screen_title'); ?><span><?php the_field('screen_title_small'); ?></span></h1>
                                <h3><?php the_field('screen_subtitle'); ?></h3>
                                <div class="header__buttons">
                                    <?php
                                    if( $header_link ):
                                        ?>
                                        <a href="<?php echo $header_link['url']; ?>" class="link"><?php echo $header_link['title']; ?></a>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php 
endforeach; 
wp_reset_postdata(); 
?>

<section class="quote bg-black white pbn">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="clip-text white" data-aos="fade-up" data-aos-delay="200">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="shapes">
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
        <div class="shape__item"></div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <div class="row">
            <div data-aos="fade-up" class="col-lg-7 col-md-8 col-sm-8 col-xs-12">
                <?php echo do_shortcode('[contact-form-7 id="534" title="Ideeen"]'); ?>
            </div>
            <div data-aos="fade-up" data-aos-delay="100" class="col-lg-offset-1 col-md-4 col-sm-4 col-xs-12 contact_data">
                <h2><?php the_field('form_title'); ?></h2>
                <?php the_field('form_content'); ?>
            </div>
        </div>
    </div>
</section>

<section class="related">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 related__head">
                <h2><?php the_field('related_title'); ?></h2>
            </div>
            <?php
            $args = array(
                'post_type'         => 'makemyblock',
                'orderby'           => 'rand',
                'posts_per_page'    => 3,
            );
            $myposts = get_posts($args);
            foreach ($myposts as $post) : setup_postdata($post);
            
                $related_image = get_the_post_thumbnail_url();
                ?>
                <div class="col-md-4 related__item">
                    <div class="related__item__inner">
                        <a href="<?php the_permalink(); ?>">
                            <div class="related__item__image" style="background-image: url('<?php echo $related_image; ?>')"></div>
                            <h4><?php the_title(); ?></h4>
                            <i class="icon-arrow"></i>
                        </a>
                    </div>
                </div>
                <?php 
            endforeach; 
            wp_reset_postdata(); 
            ?>
        </div>
    </div>
</section>

<?php get_footer();?>
