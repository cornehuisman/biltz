<?php
/**
 * Template Name: Diensten detail
 */

get_header();
?>

<?php
    $category = get_field('service_categorie');
    $color = get_field('color', 'term_'.$category->term_id);
    $header_image = get_field('header_image');
?>
<header class="header" style="background-image: url('<?php echo $header_image['url']; ?>');">
    <div class="header_overlay" style="background-color: <?php echo $color; ?>;"></div>
    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 pull-right">
        <div data-aos="fade-left" class="header_wrapper_right bg-white">
            <h1><?php the_title(); ?></h1>
            <?php the_field('header_content'); ?>
        </div>
    </div>
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('
                <p data-aos="fade-up" id="breadcrumb">','</p>
            ');
        }
    ?>
</header>

<section class="usps">
    <div class="container-fluid pdrm">
        <div class="row">
            <?php
                if ( have_rows('usps') ) :
                    $i = 0;
                    while ( have_rows('usps') ) :
                        $i++;
                        the_row();
                        ?>
                            <?php
                                $usp_image = get_sub_field('usp_image');
                            ?>
                            <div data-aos="fade-up" data-aos-delay="<?php echo $i; ?>00" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="usp" style="background-image: url('<?php echo $usp_image['url']; ?>');">
                                    <div class="usp_wrapper">
                                        <h4><?php the_sub_field('usp_title'); ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<section class="intro ptn">
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

<section class="images ptn">
    <div class="service_images_wrapper">
        <?php
            if ( have_rows('service_images') ) :
                while ( have_rows('service_images') ) :
                    the_row();

                    $service_image = get_sub_field('service_image');
                    ?>
                        <div class="service_image" style="background-image: url('<?php echo $service_image['url']; ?>');"></div>
                    <?php
                endwhile;
            endif;
        ?>
    </div>
</section>

<section class="projects ptn mbmin">
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
