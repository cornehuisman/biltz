<?php
    /**
     * Template Name: Downloads
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

<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 data-aos="fade-up"><?php the_field('intro_title'); ?></h2>
                <div data-aos="fade-up" data-aos-delay="100" class="text_wrapper column_count">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="downloads">
    <div class="container">
        <div class="row">
            <?php if ( have_rows('files') ) :
                    $i = 0;
                    while ( have_rows('files') ) :
                        $i++;
                        the_row();
                        $file = get_sub_field('file');
                        ?>
                            <div data-aos="fade-up" data-aos-delay="<?php echo $i; ?>00" class="col-md-4 col-sm-6 col-xs-12">
                                <a href="<?php echo $file['url']; ?>" target="_blank">
                                    <div class="file">
                                        <div class="file_icon">
                                            <i class="icon-file"></i>
                                        </div>
                                        <h4><?php the_sub_field('file_title'); ?></h4>
                                    </div>
                                </a>
                            </div>
                        <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>
</section>

<section class="projects pbn">
    <div class="container-fluid pdrm">
        <div class="row">
            <div class="col-xs-12">
                <div class="content_wrapper_small">
                    <h3 data-aos="fade-up"><?php the_field('project_title'); ?></h3>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <?php the_field('project_content'); ?>
                    </div>
                </div>
            </div>
            <?php
                $terms = get_terms( 'projecten-categories', array(
                    "hide_empty" => false
                ) );
                shuffle($terms);
                for( $i=0; $i<2; $i++){
                    $t = $terms[$i];
                    if ( $i == 2) {
                        break;
                    }
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
