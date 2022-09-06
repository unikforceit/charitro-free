<?php
/**
 * Charitro functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Charitro
 */

if (!defined('CHARITRO_VERSION')) {
    // Replace the version number of the theme on each release.
    define('CHARITRO_VERSION', '1.0.0');
}

if (!function_exists('charitro_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function charitro_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on charitro, use a find and replace
         * to change 'charitro' to the name of your theme in all the template files.
         */
        load_theme_textdomain('charitro', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary', 'charitro'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'charitro_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 90,
                'width' => 90,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'charitro_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charitro_content_width()
{
    $GLOBALS['content_width'] = apply_filters('charitro_content_width', 640);
}

add_action('after_setup_theme', 'charitro_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function charitro_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'charitro'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'charitro'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );


}

add_action('widgets_init', 'charitro_widgets_init');
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function charitro_fonts_url()
{
    $fonts_url = '';
    $fonts = array();
    $subsets = '';

    if ('off' !== esc_html_x('on', 'Inter font: on or off', 'charitro')) {
        $fonts[] = 'Inter:400,500,600,700,900';
    }
    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function charitro_scripts()
{
    wp_enqueue_style('charitro-fonts', charitro_fonts_url());
    wp_enqueue_style('charitro-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css');
    wp_enqueue_style('charitro-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('charitro-main', get_template_directory_uri() . '/assets/css/charitro.css');
    wp_enqueue_style('charitro-style', get_stylesheet_uri(), array(), CHARITRO_VERSION);
    wp_style_add_data('charitro-style', 'rtl', 'replace');
    wp_enqueue_script('charitro-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), CHARITRO_VERSION, true);
    wp_enqueue_script('charitro-unit', get_template_directory_uri() . '/assets/js/unit.js', array('jquery'), CHARITRO_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'charitro_scripts');
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function charitro_customize_preview_js()
{
    wp_enqueue_script('charitro-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), null, true);
}

add_action('customize_preview_init', 'charitro_customize_preview_js');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Custom comment walker.
require get_template_directory() . '/inc/class-walker-comment.php';

require get_template_directory() . '/inc/plugins.php';
if (class_exists('CSF')) {
    require get_template_directory() . '/inc/options.php';
}