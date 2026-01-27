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

    // Author page stylesheet
    if (is_author()) {
        wp_enqueue_style(
            'automatdo-author',
            AUTOMATDO_URI . '/assets/css/author.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
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

    // Legal pages (Privacy Policy, Terms, etc.) - pages using default page.php template
    if (is_page() && !is_page_template()) {
        wp_enqueue_style(
            'automatdo-legal',
            AUTOMATDO_URI . '/assets/css/legal.css',
            array('automatdo-landing'),
            AUTOMATDO_VERSION
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

/**
 * Add Person Schema (JSON-LD) for author pages - E-E-A-T optimization
 * Outputs structured data for better search engine understanding of author expertise
 */
function automatdo_author_schema() {
    if (!is_author()) {
        return;
    }

    $author_id = get_queried_object_id();
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_bio = get_the_author_meta('description', $author_id);
    $author_url = get_the_author_meta('user_url', $author_id);
    $author_email = get_the_author_meta('user_email', $author_id);

    // Get author's post count for expertise indicator
    $post_count = count_user_posts($author_id, 'post', true);

    // Get author's first post for experience timeline
    $first_post = get_posts(array(
        'author' => $author_id,
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC',
        'post_status' => 'publish',
    ));

    // Build Person schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $author_name,
        'url' => get_author_posts_url($author_id),
        'description' => $author_bio ?: 'Contributing writer at Automatdo, covering AI voice technology and enterprise automation solutions.',
        'worksFor' => array(
            '@type' => 'Organization',
            'name' => 'Automatdo',
            'url' => home_url('/'),
        ),
        'jobTitle' => 'Content Contributor',
    );

    // Build sameAs array with website and social links
    $same_as = array();
    if ($author_url) {
        $same_as[] = $author_url;
    }

    // Add social media links to sameAs
    $twitter = get_user_meta($author_id, 'automatdo_twitter', true);
    $linkedin = get_user_meta($author_id, 'automatdo_linkedin', true);
    $facebook = get_user_meta($author_id, 'automatdo_facebook', true);
    $youtube = get_user_meta($author_id, 'automatdo_youtube', true);

    if ($twitter) $same_as[] = $twitter;
    if ($linkedin) $same_as[] = $linkedin;
    if ($facebook) $same_as[] = $facebook;
    if ($youtube) $same_as[] = $youtube;

    if (!empty($same_as)) {
        $schema['sameAs'] = $same_as;
    }

    // Add image if gravatar is available
    $avatar_url = get_avatar_url($author_id, array('size' => 256));
    if ($avatar_url) {
        $schema['image'] = $avatar_url;
    }

    // Add knowledge graph hints for expertise
    $schema['knowsAbout'] = array(
        'AI Voice Agents',
        'Enterprise Automation',
        'Third-Party Verification',
        'Contact Center Technology',
        'Business Process Automation',
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";

    // Also output ProfilePage schema for the page itself
    $profile_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'ProfilePage',
        'name' => $author_name . ' - Author at Automatdo',
        'url' => get_author_posts_url($author_id),
        'mainEntity' => array(
            '@type' => 'Person',
            'name' => $author_name,
        ),
        'breadcrumb' => array(
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
                array(
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $author_name,
                    'item' => get_author_posts_url($author_id),
                ),
            ),
        ),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($profile_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}
add_action('wp_head', 'automatdo_author_schema', 5);

/**
 * Customize author archive base to live under /blog/author/
 */
function automatdo_set_author_base() {
    global $wp_rewrite;
    $front = trim((string) $wp_rewrite->front, '/');
    $wp_rewrite->author_base = $front ? 'author' : 'blog/author';
}
add_action('init', 'automatdo_set_author_base');

/**
 * Redirect legacy /author/ URLs to the new author base
 */
function automatdo_redirect_author_base() {
    if (!is_author()) {
        return;
    }

    $author_id = get_queried_object_id();
    if (!$author_id) {
        return;
    }

    $target = get_author_posts_url($author_id);
    $current = home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    if ($target && $current && untrailingslashit($current) !== untrailingslashit($target)) {
        wp_safe_redirect($target, 301);
        exit;
    }
}
add_action('template_redirect', 'automatdo_redirect_author_base');

/**
 * =============================================================================
 * AUTHOR SOCIAL MEDIA FIELDS
 * =============================================================================
 */

/**
 * Add custom social media fields to user profile in wp-admin
 */
function automatdo_user_social_fields($user) {
    ?>
    <h3>Author Display Settings</h3>
    <table class="form-table">
        <tr>
            <th><label for="automatdo_job_title">Job Title</label></th>
            <td>
                <input type="text" name="automatdo_job_title" id="automatdo_job_title"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'automatdo_job_title', true)); ?>"
                       class="regular-text" placeholder="e.g. Founder & CEO, Content Writer, etc." />
                <p class="description">Short title displayed on blog posts (keeps the byline clean)</p>
            </td>
        </tr>
    </table>

    <h3>Author Page SEO</h3>
    <table class="form-table">
        <tr>
            <th><label for="automatdo_meta_description">Meta Description</label></th>
            <td>
                <textarea name="automatdo_meta_description" id="automatdo_meta_description"
                          rows="3" cols="50" class="large-text"
                          placeholder="A brief description of the author for search engines (150-160 characters recommended)"><?php echo esc_textarea(get_user_meta($user->ID, 'automatdo_meta_description', true)); ?></textarea>
                <p class="description">
                    This description appears in search engine results for your author page.
                    <span id="meta-char-count"></span>
                </p>
                <script>
                    (function() {
                        var textarea = document.getElementById('automatdo_meta_description');
                        var counter = document.getElementById('meta-char-count');
                        function updateCount() {
                            var len = textarea.value.length;
                            var color = len > 160 ? '#d63638' : (len > 140 ? '#dba617' : '#00a32a');
                            counter.innerHTML = '<span style="color:' + color + '">' + len + '/160 characters</span>';
                        }
                        textarea.addEventListener('input', updateCount);
                        updateCount();
                    })();
                </script>
            </td>
        </tr>
    </table>

    <h3>Social Media Profiles</h3>
    <p class="description">Add your social media profile URLs. These will be displayed on your author page.</p>
    <table class="form-table">
        <tr>
            <th><label for="automatdo_twitter">X (Twitter)</label></th>
            <td>
                <input type="url" name="automatdo_twitter" id="automatdo_twitter"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'automatdo_twitter', true)); ?>"
                       class="regular-text" placeholder="https://x.com/username" />
                <p class="description">Your X (formerly Twitter) profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="automatdo_linkedin">LinkedIn</label></th>
            <td>
                <input type="url" name="automatdo_linkedin" id="automatdo_linkedin"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'automatdo_linkedin', true)); ?>"
                       class="regular-text" placeholder="https://linkedin.com/in/username" />
                <p class="description">Your LinkedIn profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="automatdo_facebook">Facebook</label></th>
            <td>
                <input type="url" name="automatdo_facebook" id="automatdo_facebook"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'automatdo_facebook', true)); ?>"
                       class="regular-text" placeholder="https://facebook.com/username" />
                <p class="description">Your Facebook profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="automatdo_youtube">YouTube</label></th>
            <td>
                <input type="url" name="automatdo_youtube" id="automatdo_youtube"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'automatdo_youtube', true)); ?>"
                       class="regular-text" placeholder="https://youtube.com/@channel" />
                <p class="description">Your YouTube channel URL</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'automatdo_user_social_fields');
add_action('edit_user_profile', 'automatdo_user_social_fields');

/**
 * Save custom social media fields and meta description
 */
function automatdo_save_user_social_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Save job title
    if (isset($_POST['automatdo_job_title'])) {
        update_user_meta($user_id, 'automatdo_job_title', sanitize_text_field($_POST['automatdo_job_title']));
    }

    // Save meta description
    if (isset($_POST['automatdo_meta_description'])) {
        update_user_meta($user_id, 'automatdo_meta_description', sanitize_textarea_field($_POST['automatdo_meta_description']));
    }

    // Save social fields
    $social_fields = array('automatdo_twitter', 'automatdo_linkedin', 'automatdo_facebook', 'automatdo_youtube');

    foreach ($social_fields as $field) {
        if (isset($_POST[$field])) {
            update_user_meta($user_id, $field, esc_url_raw($_POST[$field]));
        }
    }
}
add_action('personal_options_update', 'automatdo_save_user_social_fields');
add_action('edit_user_profile_update', 'automatdo_save_user_social_fields');

/**
 * Output author meta description for author archive pages
 */
function automatdo_author_meta_description() {
    if (!is_author()) {
        return;
    }

    $author_id = get_queried_object_id();
    $meta_description = get_user_meta($author_id, 'automatdo_meta_description', true);

    // Fallback to bio excerpt if no custom meta description
    if (empty($meta_description)) {
        $author_bio = get_the_author_meta('description', $author_id);
        if ($author_bio) {
            $meta_description = wp_trim_words(wp_strip_all_tags($author_bio), 25, '...');
        } else {
            $author_name = get_the_author_meta('display_name', $author_id);
            $meta_description = 'Read articles by ' . $author_name . ' on the Automatdo blog. Insights on AI voice agents and enterprise automation.';
        }
    }

    if ($meta_description) {
        echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
    }
}
add_action('wp_head', 'automatdo_author_meta_description', 1);

/**
 * Get author social links
 * Returns an array of social media links for the given author
 */
function automatdo_get_author_social_links($author_id) {
    $social_links = array();

    $twitter = get_user_meta($author_id, 'automatdo_twitter', true);
    if ($twitter) {
        $social_links['twitter'] = array(
            'url' => $twitter,
            'label' => 'X',
            'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        );
    }

    $linkedin = get_user_meta($author_id, 'automatdo_linkedin', true);
    if ($linkedin) {
        $social_links['linkedin'] = array(
            'url' => $linkedin,
            'label' => 'LinkedIn',
            'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        );
    }

    $facebook = get_user_meta($author_id, 'automatdo_facebook', true);
    if ($facebook) {
        $social_links['facebook'] = array(
            'url' => $facebook,
            'label' => 'Facebook',
            'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        );
    }

    $youtube = get_user_meta($author_id, 'automatdo_youtube', true);
    if ($youtube) {
        $social_links['youtube'] = array(
            'url' => $youtube,
            'label' => 'YouTube',
            'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        );
    }

    return $social_links;
}
