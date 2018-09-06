<?php
/**
 * Template Name: Projects
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
                <p data-aos="fade-up" data-aos-deley="200" id="breadcrumb">','</p>
            ');
        }
    ?>
</header>

<section id="projects" class="projects ptn">
    <div class="container-fluid">
        <div class="row">

            <div class="zz-lazyload-search">
                <div class="col-xs-12">
                    <div class="toggle-filter">
                        <span>Filteren</span> <i class="icon-filter pull-right"></i>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-deley="250" class="col-xs-12 filters  filter">
                    <div class="filter-wrapper">
                        <div class="row">
                            <input type="hidden" name="projecten-loader" value="1" />
                            <div class="col-xs-12">
                                <?php
                                    $terms = get_terms( array(
                                        'taxonomy' => 'projecten-categories',
                                    ));
                                    $all_ids = array();
                                    foreach ($terms as $t ) {
                                        $all_ids[] = $t->term_id;
                                    }
                                    $term = isset($_REQUEST['filter'])?$_REQUEST['filter']:'';
                                ?>

                                <label>
                                    <input type="radio" name="category" value="" checked/>
                                    <span class="alles"><i class="icon-group"></i> Alle projecten</span>
                                </label>
                                <?php
                                    foreach ($terms as $t) {
                                        ?>
                                            <label>
                                                <input type="radio" name="category" value="<?=$t->term_id?>" <?=$term->slug=='des'?'checked="checked"':''?> />
                                                <span class="<?=$t->name?>"><?=$t->name?></span>
                                            </label>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="zz-lazyload-container" class="template-projecten">
                    <!-- LOADED BY AJAX -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
