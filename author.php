<?php
/**
 * Author Archive Template
 * E-E-A-T optimized author profile page
 *
 * @package Automatdo
 */

get_header();

$author_id = get_queried_object_id();
$author = get_queried_object();
$author_name = get_the_author_meta('display_name', $author_id);
$author_bio = get_the_author_meta('description', $author_id);
$author_email = get_the_author_meta('user_email', $author_id);
$author_url = get_the_author_meta('user_url', $author_id);
$author_registered = get_the_author_meta('user_registered', $author_id);

// Calculate author stats
$post_count = count_user_posts($author_id, 'post', true);

// Get author's first post date for experience display
$first_post = get_posts(array(
    'author' => $author_id,
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'ASC',
    'post_status' => 'publish',
));
$writing_since = $first_post ? get_the_date('Y', $first_post[0]) : date('Y');
?>

    <main id="main-content">
        <!-- Author Header -->
        <header class="author-header">
            <div class="author-header-container">
                <nav class="author-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo home_url('/'); ?>">Home</a>
                    <span aria-hidden="true">/</span>
                    <a href="<?php echo home_url('/blog/'); ?>">Blog</a>
                    <span aria-hidden="true">/</span>
                    <span aria-current="page">Author</span>
                </nav>

                <div class="author-profile">
                    <div class="author-avatar-large">
                        <?php
                        $avatar = get_avatar($author_id, 120, '', $author_name, array('class' => 'author-gravatar'));
                        if ($avatar) {
                            echo $avatar;
                        }
                        ?>
                        <div class="author-avatar-fallback" aria-hidden="true">
                            <?php echo automatdo_get_author_initials($author_name); ?>
                        </div>
                    </div>

                    <div class="author-profile-content">
                        <h1 class="author-name"><?php echo esc_html($author_name); ?></h1>

                        <?php if ($author_bio) : ?>
                        <p class="author-bio"><?php echo wp_kses_post($author_bio); ?></p>
                        <?php else : ?>
                        <p class="author-bio">Contributing writer at Automatdo, covering AI voice technology and enterprise automation solutions.</p>
                        <?php endif; ?>

                        <div class="author-meta-stats">
                            <div class="author-stat">
                                <span class="stat-value"><?php echo esc_html($post_count); ?></span>
                                <span class="stat-label"><?php echo $post_count === 1 ? 'Article' : 'Articles'; ?></span>
                            </div>
                            <div class="author-stat-divider" aria-hidden="true"></div>
                            <div class="author-stat">
                                <span class="stat-value"><?php echo esc_html($writing_since); ?></span>
                                <span class="stat-label">Writing Since</span>
                            </div>
                        </div>

                        <?php
                        // Get social links
                        $social_links = automatdo_get_author_social_links($author_id);
                        $has_links = $author_url || !empty($social_links);

                        if ($has_links) :
                        ?>
                        <div class="author-links">
                            <?php if ($author_url) : ?>
                            <a href="<?php echo esc_url($author_url); ?>" class="author-link author-website-link" target="_blank" rel="noopener noreferrer" aria-label="Visit website">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                                <span class="link-label">Website</span>
                            </a>
                            <?php endif; ?>

                            <?php foreach ($social_links as $platform => $link) : ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="author-link author-social-link author-social-<?php echo esc_attr($platform); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($link['label']); ?>">
                                <?php echo $link['icon']; ?>
                                <span class="link-label"><?php echo esc_html($link['label']); ?></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Author Articles -->
        <section class="author-articles">
            <div class="author-articles-container">
                <header class="author-articles-header">
                    <h2 class="author-articles-title">
                        Articles by <?php echo esc_html($author_name); ?>
                    </h2>
                    <p class="author-articles-count">
                        <?php echo esc_html($post_count); ?> <?php echo $post_count === 1 ? 'article' : 'articles'; ?> published
                    </p>
                </header>

                <?php if (have_posts()) : ?>
                <div class="author-posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="author-post-card">
                            <a href="<?php the_permalink(); ?>" class="author-post-link">
                                <div class="author-post-content">
                                    <div class="author-post-meta">
                                        <?php
                                        $categories = get_the_category();
                                        if ($categories) :
                                        ?>
                                        <span class="post-category"><?php echo esc_html($categories[0]->name); ?></span>
                                        <?php endif; ?>
                                        <span class="post-date"><?php echo get_the_date('M j, Y'); ?></span>
                                    </div>
                                    <h3 class="author-post-title"><?php the_title(); ?></h3>
                                    <p class="author-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                                    <div class="author-post-footer">
                                        <span class="read-time"><?php echo automatdo_reading_time(); ?> min read</span>
                                        <span class="read-more-arrow" aria-hidden="true">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php
                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                if ($total_pages > 1) :
                ?>
                <nav class="author-pagination" aria-label="Author posts pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $total_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M15 4L9 10L15 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span class="screen-reader-text">Previous</span>',
                        'next_text' => '<span class="screen-reader-text">Next</span><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 4L11 10L5 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'type' => 'list',
                    ));
                    ?>
                </nav>
                <?php endif; ?>

                <?php else : ?>
                <div class="author-no-posts">
                    <p>No articles published yet.</p>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="author-cta">
            <div class="author-cta-container">
                <div class="author-cta-card">
                    <h3>Want to learn more about AI voice agents?</h3>
                    <p>Discover how Automatdo can transform your business communications.</p>
                    <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary">
                        <span>Book a Demo</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>
