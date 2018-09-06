<!DOCTYPE html>
<html lang="en" class="loading">
<head>
<meta charset="utf-8">
<title ><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php wp_head(); ?>

</head>
<body <?php body_class( 'fade-in-page' ); ?>>

<!-- <div id="loading_screen" style="display: none;">
    <div class="loading_wrapper">
        <img class="burger top" src="<?php echo get_template_directory_uri(); ?>/assets/img/burger_head.jpg" alt="Burger top">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="Biltz logo">
        <img class="burger bottom" src="<?php echo get_template_directory_uri(); ?>/assets/img/burger_bottom.jpg" alt="Burger top">
        <h3>Stay hungry</h3>
    </div>
    <div class="loaded_wrapper">
        <img class="burger" src="<?php echo get_template_directory_uri(); ?>/assets/img/burger_crumbs.png" alt="Burger crumbs">
    </div>
</div> -->

<main class="wrapper">
<?php if ( is_singular('helden') ) : ?>

<?php else: ?>

    <div class="menu_overlay" style="background-image: url('<?= get_template_directory_uri();?>/assets/img/menu_background.jpg');">
        <a class="logo hidden-xs" href="<?php echo site_url(); ?>"><img src="<?= get_template_directory_uri()?>/assets/img/logo.svg" alt="Biltz logo"/></a>
        <div class="hamburger_menu hamburger_menu_close">
            <span>Sluiten</span>
            <div class="hamburger hamburger_menu cross">
                <i></i><i></i>
            </div>
        </div>
        <div class="rsp_menu menu fade-out">
            <h3>Navigeren</h3>
            <ul class="hidden-sm hidden-xs">
                <?php
                    wp_nav_menu(array( 'container' => false, 'theme_location' => 'secondary', 'items_wrap' => '%3$s', 'depth' => 0 ));
                ?>
            </ul>
            <ul class="visible-sm visible-xs">
                <?php
                    wp_nav_menu(array( 'container' => false, 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'depth' => 0 ));
                ?>
                <?php
                    wp_nav_menu(array( 'container' => false, 'theme_location' => 'secondary', 'items_wrap' => '%3$s', 'depth' => 0 ));
                ?>
            </ul>
            <div class="round_black">
                <p><?php echo count( get_field('vacancies', 318) ); ?></p>
            </div>
        </div>
        <div class="rsp_menu_social">
            <a class="facebook" target="_blank" href="<?php the_field('facebook', 'option'); ?>"><i class="icon-facebook"></i></a>
            <a class="twitter" target="_blank" href="<?php the_field('twitter', 'option'); ?>"><i class="icon-twitter"></i></a>
            <a class="linkedin" target="_blank" href="<?php the_field('linkedin', 'option'); ?>"><i class="icon-linkedin"></i></a>
        </div>
    </div>

    <nav class="navbar-fixed-top">
        <div class="container-fluid prn">
            <div class="nav-wrapper bg-white">
                <div class="row">
                    <div class="brand col-lg-3 col-md-3 col-sm-4 col-xs-4">
                        <a class="logo" href="<?php echo site_url(); ?>"><img src="<?= get_template_directory_uri()?>/assets/img/logo.svg" alt="Logo"/></a>
                    </div>
                    <div class="menu col-lg-9 col-md-9 col-sm-8 col-xs-8">
                        <!-- <div class="hamburger_menu hamburger_menu_open">
                            <span class="hidden-xs">Meer</span>
                            <div class="hamburger">
                                <i></i><i></i><i></i>
                            </div>
                        </div> -->
                        <div class="hidden-sm hidden-xs menu-rsp">
                            <?php
                                wp_nav_menu(array( 'container' => false, 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'depth' => 0 ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<?php endif; ?>
