<?php

get_header();

$header_image = get_the_post_thumbnail_url();

$id = get_the_id();
?>
<header class="header third" style="background-image: url('<?php echo $header_image; ?>');"></header>
<div class="breadcrumb">
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('
            <p id="breadcrumb">','</p>
            ');
        }
    ?>
</div>

<section class="textbox">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
                <div class="textbox_title">
                    <h2 data-aos="fade-up"><?php the_title(); ?></h2>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$header_image = get_field('screen_image');
?>
<div class="header">
    <div class="header__wrapper__second">
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
</div>

<section class="images ptm pbm">
    <div class="service_images_wrapper">
        <?php
            if ( have_rows('makemyblock_images') ) :
                while ( have_rows('makemyblock_images') ) :
                    the_row();

                    $makemyblock_image = get_sub_field('makemyblock_image');
                    ?>
                        <div class="service_image" style="background-image: url('<?php echo $makemyblock_image['url']; ?>');"></div>
                    <?php
                endwhile;
            endif;
        ?>
    </div>
</section>

<section class="related">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 related__head">
                <h2>Gerelateerde ideeën</h2>
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

<?php get_footer(); ?>
