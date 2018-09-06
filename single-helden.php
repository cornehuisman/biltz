<?php
    get_header();

    $hero_image = get_the_post_thumbnail_url();
?>

<section class="single_hero">
    <div data-aos="fade-down" class="single_hero-close visible-xs" style="background-color: <?php the_field('heros_color'); ?>;">
        <a href="javascript: window.history.go(-1)">Sluiten <span><i></i><i></i></span></a>
    </div>
    <div data-aos="fade-right" class="single_hero-image" style="background-image: url('<?php echo $hero_image; ?>');"></div>
    <div class="single_hero-content">
        <div data-aos="fade-up" class="single_hero-text">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="single_hero-title" style="background-color: <?php the_field('heros_color'); ?>;">
        <p><?php the_title(); ?></p>
    </div>
    <div data-aos="fade-down" class="single_hero-close hidden-xs">
        <a href="javascript: window.history.go(-1)">Sluiten <span><i></i><i></i></span></a>
    </div>
</section>

<?php
    get_footer();
?>
