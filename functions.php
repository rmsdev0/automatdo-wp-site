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

    if (is_page_template('page-contact.php')) {
        wp_enqueue_style(
            'automatdo-contact',
            AUTOMATDO_URI . '/assets/css/contact.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-contact-js',
            AUTOMATDO_URI . '/assets/js/contact.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
    }

    if (is_page_template('page-about.php')) {
        wp_enqueue_style(
            'automatdo-about',
            AUTOMATDO_URI . '/assets/css/about.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
    }

    if (is_page_template('page-faq.php')) {
        wp_enqueue_style(
            'automatdo-faq',
            AUTOMATDO_URI . '/assets/css/faq.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-faq-js',
            AUTOMATDO_URI . '/assets/js/faq.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
    }

    if (is_page_template('page-features.php')) {
        wp_enqueue_style(
            'automatdo-features',
            AUTOMATDO_URI . '/assets/css/features.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-features-js',
            AUTOMATDO_URI . '/assets/js/features.js',
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

    // Voice Demo Widget (front page only)
    if (is_front_page()) {
        wp_enqueue_style(
            'automatdo-voice-demo',
            AUTOMATDO_URI . '/assets/css/voice-demo.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
        );
        wp_enqueue_script(
            'automatdo-voice-demo',
            AUTOMATDO_URI . '/assets/js/voice-demo.js',
            array('automatdo-landing'),
            AUTOMATDO_VERSION,
            true
        );
        // Detect local development environment
        $is_local = strpos(home_url(), '.local') !== false || strpos(home_url(), 'localhost') !== false;
        $ws_endpoint = $is_local
            ? 'ws://localhost:8000/browser-voice-agent'
            : 'wss://app.automatdo.com/browser-voice-agent';

        wp_localize_script('automatdo-voice-demo', 'voiceDemoConfig', array(
            'wsEndpoint' => $ws_endpoint,
            'themeUrl'   => AUTOMATDO_URI,
            'audioProcessorUrl' => AUTOMATDO_URI . '/assets/js/audio-processor.js',
        ));
    }
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
    if (is_404()) {
        $classes[] = 'error-404';
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
 * Add Microsoft Clarity tracking
 */
function automatdo_add_clarity_tracking() {
    ?>
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "v10uiil25q");
    </script>
    <?php
}
add_action('wp_head', 'automatdo_add_clarity_tracking', 2);

/**
 * Include blog post importer (run once)
 */
require_once AUTOMATDO_DIR . '/import-posts.php';

/**
 * =============================================================================
 * SEO ENHANCEMENTS
 * =============================================================================
 */

/**
 * Add Article Schema (JSON-LD) for blog posts
 * Outputs structured data for better search engine understanding
 */
function automatdo_article_schema() {
    if (!is_singular('post')) {
        return;
    }

    $post_id = get_the_ID();
    $post = get_post($post_id);
    $author_id = $post->post_author;

    // Get featured image
    $image_url = '';
    $image_width = '';
    $image_height = '';
    if (has_post_thumbnail($post_id)) {
        $image_id = get_post_thumbnail_id($post_id);
        $image_data = wp_get_attachment_image_src($image_id, 'full');
        if ($image_data) {
            $image_url = $image_data[0];
            $image_width = $image_data[1];
            $image_height = $image_data[2];
        }
    } else {
        // Fallback to default OG image
        $image_url = AUTOMATDO_URI . '/assets/images/og-image.jpg';
        $image_width = 1200;
        $image_height = 630;
    }

    // Get categories
    $categories = get_the_category($post_id);
    $category_names = array();
    foreach ($categories as $category) {
        $category_names[] = $category->name;
    }

    // Build schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => get_the_title($post_id),
        'description' => get_the_excerpt($post_id) ?: wp_trim_words(get_the_content(), 30, '...'),
        'image' => array(
            '@type' => 'ImageObject',
            'url' => $image_url,
            'width' => $image_width,
            'height' => $image_height,
        ),
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author_meta('display_name', $author_id),
            'url' => get_author_posts_url($author_id),
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => 'Automatdo',
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => AUTOMATDO_URI . '/assets/images/icon.png',
            ),
        ),
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink($post_id),
        ),
        'wordCount' => str_word_count(strip_tags($post->post_content)),
        'articleSection' => !empty($category_names) ? $category_names[0] : 'Blog',
        'keywords' => implode(', ', $category_names),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}
add_action('wp_head', 'automatdo_article_schema', 5);

/**
 * Add BreadcrumbList Schema (JSON-LD)
 * Outputs breadcrumb structured data for blog posts
 */
function automatdo_breadcrumb_schema() {
    if (!is_singular('post')) {
        return;
    }

    $post_id = get_the_ID();
    $categories = get_the_category($post_id);

    $breadcrumbs = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url('/'),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Blog',
                'item' => home_url('/blog/'),
            ),
        ),
    );

    // Add category if exists
    if (!empty($categories)) {
        $breadcrumbs['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $categories[0]->name,
            'item' => get_category_link($categories[0]->term_id),
        );

        $breadcrumbs['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 4,
            'name' => get_the_title($post_id),
            'item' => get_permalink($post_id),
        );
    } else {
        $breadcrumbs['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 3,
            'name' => get_the_title($post_id),
            'item' => get_permalink($post_id),
        );
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}
add_action('wp_head', 'automatdo_breadcrumb_schema', 5);

/**
 * Default Open Graph image fallback for Yoast
 * Used when posts don't have a featured image
 */
function automatdo_yoast_default_og_image($image) {
    if (empty($image)) {
        return AUTOMATDO_URI . '/assets/images/og-image.jpg';
    }
    return $image;
}
add_filter('wpseo_opengraph_image', 'automatdo_yoast_default_og_image');

/**
 * Default Twitter image fallback for Yoast
 */
function automatdo_yoast_default_twitter_image($image) {
    if (empty($image)) {
        return AUTOMATDO_URI . '/assets/images/og-image.jpg';
    }
    return $image;
}
add_filter('wpseo_twitter_image', 'automatdo_yoast_default_twitter_image');

/**
 * Ensure featured images have alt text
 * Falls back to post title if no alt text is set
 */
function automatdo_ensure_image_alt($attr, $attachment, $size) {
    if (empty($attr['alt'])) {
        // Try to get alt from attachment
        $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

        if (empty($alt)) {
            // Fall back to attachment title
            $alt = $attachment->post_title;
        }

        if (empty($alt)) {
            // Fall back to parent post title if this is a featured image
            $parent_id = $attachment->post_parent;
            if ($parent_id) {
                $alt = get_the_title($parent_id);
            }
        }

        $attr['alt'] = $alt;
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'automatdo_ensure_image_alt', 10, 3);

/**
 * Add last modified date to post meta (for display in templates)
 */
function automatdo_get_last_modified($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $modified = get_the_modified_date('U', $post_id);
    $published = get_the_date('U', $post_id);

    // Only show if modified date is different from published (more than 1 day)
    if (($modified - $published) > 86400) {
        return get_the_modified_date('F j, Y', $post_id);
    }
    return false;
}

/**
 * Enable Yoast breadcrumbs support
 * Add this to your theme where you want breadcrumbs to appear
 */
function automatdo_yoast_breadcrumbs() {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<nav class="yoast-breadcrumb" aria-label="Breadcrumb">', '</nav>');
    }
}

/**
 * Customize Yoast breadcrumb separator
 */
function automatdo_yoast_breadcrumb_separator($separator) {
    return '<span class="breadcrumb-separator">/</span>';
}
add_filter('wpseo_breadcrumb_separator', 'automatdo_yoast_breadcrumb_separator');

/**
 * Add WebSite schema for sitelinks search box
 */
function automatdo_website_schema() {
    if (!is_front_page()) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => get_bloginfo('name'),
        'url' => home_url('/'),
        'description' => get_bloginfo('description'),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => 'Automatdo',
            'logo' => AUTOMATDO_URI . '/assets/images/icon.png',
        ),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}
add_action('wp_head', 'automatdo_website_schema', 5);
