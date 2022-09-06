<?php
/**
 * The header for our theme home page
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Charitro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div class="scroll-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'charitro'); ?></a>
    <!-- Start Main Header -->
    <header id="main-header" class="main-header">
        <div class="menu-header">
            <div class="container">
                <div class="main-menu">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-3">
                            <div class="logo">
                                <?php charitro_logo();?>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <!--Main Menu-->
                            <div class="main-menu-navigation">
                                <nav class="navigation-main-area ul-li">
                                    <?php
                                    echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                                        wp_nav_menu( array(
                                                'container' => false,
                                                'echo' => false,
                                                'menu_id' => 'main-nav',
                                                'theme_location' => 'primary',
                                                'fallback_cb'=> 'charitro_no_main_nav',
                                                'items_wrap' => '<ul>%3$s</ul>',
                                            )
                                        ));
                                    ?>
                                </nav>
                            </div>
                            <!-- Start Mobile Menu -->
                            <div class="mobile_menu position-relative">
                                <div class="mobile_menu_button open_mobile_menu">
                                    <i class="fas fa-bars"></i>
                                </div>
                                <div class="mobile_menu_wrap">
                                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                                    <div class="mobile_menu_content">
                                        <div class="mobile_menu_close open_mobile_menu">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="m-brand-logo">
                                            <?php charitro_logo();?>
                                        </div>
                                        <nav class="mobile-main-navigation  clearfix ul-li">
                                            <?php
                                            echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                                                wp_nav_menu( array(
                                                        'container' => false,
                                                        'echo' => false,
                                                        'menu_id' => 'm-main-nav',
                                                        'theme_location' => 'primary',
                                                        'fallback_cb'=> 'charitro_no_main_nav',
                                                        'items_wrap' => '<ul class="navbar-nav text-capitalize clearfix">%3$s</ul>',
                                                    )
                                                ));
                                            ?>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                            <!-- End Mobile Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>