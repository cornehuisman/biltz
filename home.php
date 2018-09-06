<?php
/**
 * Template Name: Home
 */

get_header();

$header_image = get_field('header_image');
?>

<header class="header">
    <div class="header__slider">
        <?php
        if( have_rows('slider_header') ):
            while( have_rows('slider_header') ): the_row();
                $image = get_sub_field('image');
                $button = get_sub_field('button');
                $link = get_sub_field('title_next_button');
                ?>
                <div class="header__slide">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-7 header__image__wrapper">
                                <div class="header__image" style="background-image: url('<?php echo $image['url']; ?>')"></div>
                            </div>
                            <div class="col-md-offset-6 col-md-6">
                                <div class="header__wrapper">
                                    <h1><?php the_sub_field('title'); ?><span><?php the_sub_field('title_small'); ?></span></h1>
                                    <h3><?php the_sub_field('subtitle'); ?></h3>
                                    <div class="header__buttons">
                                        <?php
                                        if( $button ):
                                            ?>
                                            <a href="<?php echo $button['url']; ?>" class="button button-transparent"><?php echo $button['title']; ?></a>
                                            <?php
                                        endif;
                                        ?>
                                        <?php
                                        if( $link ):
                                            ?>
                                            <a href="<?php echo $link['url']; ?>" class="link"><?php echo $link['title']; ?></a>
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</header>

<section class="quote">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="clip-text" data-aos="fade-up" data-aos-delay="200">
                    <p><?php the_field('quote_title'); ?></p>
                    <?php
                    $quote_button = get_field('quote_button');
                    ?>
                    <a href="<?php echo $quote_button['url']; ?>" class="button button-transparent"><?php echo $quote_button['title']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="intro" id="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <?php
                    $intro_image = get_field('intro_image');
                ?>
                <img data-aos="zoom-in" data-aos-delay="400" class="intro_image" src="<?php echo $intro_image['url']; ?>" alt="<?php the_field('intro_title'); ?>">
            </div>
            <div class="col-md-8 col-xs-12">
                <h5 data-aos="fade-up" class="subtitle"><?php the_field('intro_subtitle'); ?></h5>
                <h2  data-aos="fade-up"><?php the_field('intro_title'); ?></h2>
                <div data-aos="fade-up">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section> -->

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
    $block_image = get_field('block_image');
    $block_button = get_field('block_button');
?>
<section class="makemyblock" style="background-image: url('<?php echo $block_image['url']; ?>');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div data-aos="fade-right" class="makemyblock__wrapper">
                    <h3><?php the_field('block_title'); ?> <span><?php the_field('block_second_title'); ?></span></h3>
                    <a href="<?php echo $block_button['url']; ?>" class="button"><?php echo $block_button['title']; ?></a>
                </div>
            </div>
            <div class="col-xs-12 makemyblock__link">
                <a href="">makemyblock.nl</a>
            </div>
        </div>
    </div>
</section>

<!-- <?php
    $about_us_image = get_field('about_us_image');
?>
<section id="about-us" class="about-us" style="background-image: url('<?php echo $about_us_image['url']; ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div data-aos="fade-right" class="about-us-wrapper bg-white">
                    <h3><?php the_field('about_us_title'); ?></h3><img class="logo" src="<?= get_template_directory_uri()?>/assets/img/logo.svg" alt="Logo"/>
                    <?php the_field('about_us_content'); ?>
                    <a href="<?php the_field('button_link_about'); ?>" class="button"><i class="icon-tool"></i> <?php the_field('button_text_about'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="projects pbn pdrm">
    <div class="container-fluid">
        <div class="row">
            <div class="content_wrapper">
                <div class="col-lg-9 col-sm-10 col-xs-12">
                    <h3 data-aos="fade-right"><?php the_field('project_title'); ?></h3>
                    <div data-aos="fade-up">
                        <?php the_field('project_content'); ?>
                    </div>
                    <a href="<?php the_field('button_link_project'); ?>" class="button-vertical visible-xs"><i class="icon-group"></i> <?php the_field('button_text_project'); ?></a>
                </div>
                <a href="<?php the_field('button_link_project'); ?>" class="button-vertical hidden-xs"><i class="icon-group"></i> <?php the_field('button_text_project'); ?></a>
            </div>
        </div>
        <div class="projects_wrapper">
            <?php
                $args = array(
                    'post_type'         => 'projecten',
                    'posts_per_page'    => 2,
                );
                $myposts = get_posts($args);

                foreach ($myposts as $post) : setup_postdata($post);
                $project_image = get_the_post_thumbnail_url();
            ?>
                <div class="project" data-aos="fade-up" data-aos-delay="300" style="background-image: url('<?php echo $project_image; ?>');">
                    <div class="project_hover"></div>
                    <div class="project_title_wrapper">
                        <h4><?php the_title(); ?></h4>
                    </div>
                    <div class="project_title_wrapper_hover">
                        <h4 class="project_hover">Bekijk project <i class="icon-arrow"></i></h4>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="coverlink"></a>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<section class="heros pdrm">
    <div class="container-fluid">
        <div class="content_wrapper row">
            <a href="<?php the_field('button_link_heros'); ?>" class="button-vertical hidden-xs"><i class="icon-hero"></i> <?php the_field('button_text_heros'); ?></a>
            <div class="col-lg-6 col-md-7 col-sm-10 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                <h5 data-aos="fade-down" class="subtitle"><?php the_field('hero_subtitle'); ?></h5>
                <h3 data-aos="fade-right"><?php the_field('heros_title'); ?></h3>
                <div data-aos="fade-up">
                    <?php the_field('heros_content'); ?>
                </div>
                <a href="<?php the_field('button_link_heros'); ?>" class="button-vertical visible-xs"><i class="icon-hero"></i> <?php the_field('button_text_heros'); ?></a>
            </div>
        </div>
        <div class="hero_wrapper">
            <?php
                $args = array(
                    'post_type'         => 'helden',
                    'posts_per_page'    => 4,
                );
                $myposts = get_posts($args);
                $i = 0;
                foreach ($myposts as $post) : setup_postdata($post);
                $i++;
                $heros_image = get_the_post_thumbnail_url();
            ?>
            <div data-aos="fade-up" data-aos-delay="300" class="col-lg-3 col-sm-6 col-xs-6">
                <div class="hero" style="background-image: url('<?php echo $heros_image; ?>');">
                    <div class="hero_title_wrapper" style="background-color: <?php the_field('heros_color'); ?>;">
                        <h4><?php the_title(); ?></h4>
                    </div>
                    <div class="hero_title_wrapper_hover" style="background-color: <?php the_field('heros_color'); ?>;">
                        <h4>Bekijk deze held</h4>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="coverlink"></a>
                </div>
                <div class="content" style="color: <?php the_field('heros_color'); ?>;">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endforeach; wp_reset_postdata(); ?>
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

<script type="text/javascript">
    jQuery( document ).ready(function($) {
        //Smooth scroll
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
                || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                   if (target.length) {
                     $('html,body').animate({
                         scrollTop: target.offset().top - 80
                    }, 500);
                    return false;
                }
            }
        });
    });
</script>
<?php get_footer();?>
