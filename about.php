<?php
    /*
        Template name: Over ons
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
    <?php
        $intro_image = get_field('intro_image');
    ?>
    <div class="intro_image_wrapper">
        <div class="object-fit__container">
            <img class="intro_image" src="<?php echo $intro_image['url']; ?>" alt="<?php the_field('intro_title'); ?>">
        </div>
        <p data-aos="fade-left" data-aos-delay="400">Het kantoor</p>
    </div>
</section>


<section id="team" class="pdrm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="team_content_wrapper">
                    <h2 data-aos="fade-up"><?php the_field('team_title'); ?></h2>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
                <?php
                      $args = array(
                          'post_type'         => 'team',
                          'posts_per_page'    => -1,
                          'order'              => 'ASC'
                      );
                      $myposts = get_posts($args);
                      $i = 1;
                      foreach ($myposts as $post) : setup_postdata($post);
                      $i++;
                      $team_image = get_the_post_thumbnail_url();
                ?>
                    <div data-aos="fade-up" data-aos-delay="<?php echo $i; ?>00" class="col-lg-3 col-md-4 col-sm-6 col-xs-12 teammember">
                        <div class="team_image">
                            <div class="object-fit__container" title="<?php the_title(); ?>">
                                <img src="<?php echo $team_image; ?>" alt="<?php the_title(); ?>"/>
                            </div>
                            <div class="title_wrapper white">
                                <h4><?php the_title(); ?></h4>
                                <h5><?php the_field('team_function'); ?></h5>
                            </div>
                        </div>
                        <div class="team_content">
                        </div>
                    </div>
                <?php
                    endforeach;
                    wp_reset_postdata();
                ?>
        </div>
    </div>
</section>

<section class="services pbn">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="content_wrapper_small">
                    <h3 data-aos="fade-up"><?php the_field('service_title'); ?></h3>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <?php the_field('service_content'); ?>
                    </div>
                </div>
            </div>
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

<?php get_footer(); ?>
