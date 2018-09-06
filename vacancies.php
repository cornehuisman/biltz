<?php
    /*
        Template name: Vacatures
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
                <h2 data-aos="fade-up" data-aos-delay="100"><?php the_field('intro_title'); ?></h2>
                <div data-aos="fade-up" data-aos-delay="200" class="text_wrapper column_count">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="accordion">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel-group" id="accordion">
                    <?php if ( have_rows('vacancies') ) :
                            $i = 0;
                            while ( have_rows('vacancies') ) :
                                $i++;
                                the_row();

                                $id = get_sub_field('vacancie_title');
                                $id = strtolower( $id );
                                $id = explode(' ', $id)[0];
                                ?>
                                    <div data-aos="fade-up" data-aos-delay="<?php echo $i; ?>00" class="panel panel-default">
                                        <a class="panel_head collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $id; ?>"><?php the_sub_field('vacancie_title'); ?> <span class="icon"><i></i><i></i></span></a>
                                        <div id="<?php echo $id; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php the_sub_field('vacancie_content'); ?>
                                                <a href="mailto: info@zekerzichtbaar.nl" class="button">Stuur je CV</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            else:
                        endif;
                    ?>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php get_footer(); ?>
