<?php
/**
 * Automatdo Theme Functions
 *
 * @package Automatdo
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('AUTOMATDO_VERSION', '1.0.0');
define('AUTOMATDO_DIR', get_template_directory());
define('AUTOMATDO_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function automatdo_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 28,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary'    => __('Primary Menu', 'automatdo'),
        'footer'     => __('Footer Menu', 'automatdo'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'automatdo_setup');

/**
 * Enqueue Scripts and Styles
 */
function automatdo_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'automatdo-fonts',
        'https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'automatdo-landing',
        AUTOMATDO_URI . '/assets/css/landing.css',
        array('automatdo-fonts'),
        AUTOMATDO_VERSION
    );

    // Blog stylesheet (only on blog pages)
    if (is_singular('post') || is_home() || is_archive() || is_category()) {
        wp_enqueue_style(
            'automatdo-blog',
            AUTOMATDO_URI . '/assets/css/blog.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-blog-js',
            AUTOMATDO_URI . '/assets/js/blog.js',
            array(),
            AUTOMATDO_VERSION,
            true
        );
    }

    // Solution page stylesheets (conditionally loaded based on page template)
    if (is_page_template('page-tpv.php')) {
        wp_enqueue_style(
            'automatdo-tpv',
            AUTOMATDO_URI . '/assets/css/tpv.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-tpv-js',
            AUTOMATDO_URI . '/assets/js/tpv.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
    }

    if (is_page_template('page-fitness.php')) {
        wp_enqueue_style(
            'automatdo-fitness',
            AUTOMATDO_URI . '/assets/css/fitness.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-fitness-js',
            AUTOMATDO_URI . '/assets/js/fitness.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
    }

    if (is_page_template('page-home-services.php')) {
        wp_enqueue_style(
            'automatdo-home-services',
            AUTOMATDO_URI . '/assets/css/home-services.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-home-services-js',
            AUTOMATDO_URI . '/assets/js/home-services.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
    }

    // Main JavaScript
    wp_enqueue_script(
        'automatdo-landing',
        AUTOMATDO_URI . '/assets/js/landing.js',
        array(),
        AUTOMATDO_VERSION,
        true
    );

    // Pass data to JavaScript
    wp_localize_script('automatdo-landing', 'automatdoData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('automatdo_nonce'),
        'homeUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'automatdo_scripts');

/**
 * Add preconnect for Google Fonts
 */
function automatdo_preconnect_google_fonts($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'automatdo_preconnect_google_fonts', 10, 2);

/**
 * Custom excerpt length
 */
function automatdo_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'automatdo_excerpt_length');

/**
 * Custom excerpt more
 */
function automatdo_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'automatdo_excerpt_more');

/**
 * Calculate reading time for posts
 */
function automatdo_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return max(1, $reading_time);
}

/**
 * Get author initials
 */
function automatdo_get_author_initials($author_name = null) {
    $name = $author_name ?: get_the_author();
    $parts = explode(' ', $name);
    $initials = '';
    foreach ($parts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    return substr($initials, 0, 2);
}

/**
 * Add custom body classes
 */
function automatdo_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    if (is_singular('post')) {
        $classes[] = 'single-post';
    }
    return $classes;
}
add_filter('body_class', 'automatdo_body_classes');

/**
 * Disable Gutenberg editor for front page (optional - remove if you want Gutenberg)
 */
function automatdo_disable_gutenberg_front_page($use_block_editor, $post) {
    if ($post->ID === (int) get_option('page_on_front')) {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'automatdo_disable_gutenberg_front_page', 10, 2);

/**
 * Register widget areas
 */
function automatdo_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'automatdo'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in the footer.', 'automatdo'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'automatdo_widgets_init');

/**
 * Add theme color meta tag
 */
function automatdo_theme_color_meta() {
    echo '<meta name="theme-color" content="#d4a530">' . "\n";
    echo '<meta name="msapplication-TileColor" content="#d4a530">' . "\n";
}
add_action('wp_head', 'automatdo_theme_color_meta', 1);

/**
 * Include blog post importer (run once)
 */
require_once AUTOMATDO_DIR . '/import-posts.php';
