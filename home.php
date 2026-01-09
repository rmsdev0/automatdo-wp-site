<?php
/**
 * Blog listing template (home.php)
 * Matches the original static site design
 *
 * @package Automatdo
 */

get_header();

// Get all posts for featured post selection
$featured_query = new WP_Query(array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => '_is_featured',
            'compare' => 'EXISTS',
        ),
    ),
));

// If no featured post set, get the most recent
if (!$featured_query->have_posts()) {
    $featured_query = new WP_Query(array(
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

// Get categories for filter
$categories = get_categories(array('hide_empty' => true));
?>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Blog Header -->
        <section class="blog-header">
            <div class="blog-header-container">
                <div class="blog-header-content">
                    <span class="section-tag">Resources</span>
                    <h1 class="blog-title">Insights & Guides</h1>
                    <p class="blog-subtitle">
                        Expert resources on TPV verification, AI voice technology, regulatory compliance,
                        and operational efficiency for energy retailers and enterprise teams.
                    </p>
                </div>

                <!-- Category Filter -->
                <div class="blog-filters">
                    <button class="filter-btn active" data-filter="all">All Posts</button>
                    <?php foreach ($categories as $category) : ?>
                        <button class="filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                            <?php echo esc_html($category->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php if ($featured_query->have_posts()) : $featured_query->the_post();
            $featured_categories = get_the_category();
            $featured_category_name = $featured_categories ? $featured_categories[0]->name : 'Uncategorized';
            $featured_category_slug = $featured_categories ? $featured_categories[0]->slug : 'uncategorized';
        ?>
        <!-- Featured Post -->
        <section class="featured-post-section">
            <div class="section-container">
                <article class="featured-post" data-category="<?php echo esc_attr($featured_category_slug); ?>">
                    <a href="<?php the_permalink(); ?>" class="featured-post-link">
                        <div class="featured-post-image">
                            <div class="featured-post-gradient"></div>
                            <span class="featured-badge">Featured Guide</span>
                        </div>
                        <div class="featured-post-content">
                            <div class="post-meta">
                                <span class="post-category"><?php echo esc_html($featured_category_name); ?></span>
                                <span class="post-date"><?php echo get_the_date('F Y'); ?></span>
                                <span class="post-read-time"><?php echo automatdo_reading_time(); ?> min read</span>
                            </div>
                            <h2 class="featured-post-title"><?php the_title(); ?></h2>
                            <p class="featured-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
                            <span class="read-more">
                                Read the full guide
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                </article>
            </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>

        <!-- Blog Posts Grid -->
        <section class="blog-posts-section">
            <div class="section-container">
                <?php
                // Get remaining posts (exclude featured if it exists)
                $featured_id = $featured_query->have_posts() ? $featured_query->posts[0]->ID : 0;
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                $posts_query = new WP_Query(array(
                    'posts_per_page' => 9,
                    'paged' => $paged,
                    'post_status' => 'publish',
                    'post__not_in' => $featured_id ? array($featured_id) : array(),
                ));

                if ($posts_query->have_posts()) :
                ?>
                <div class="posts-grid">
                    <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                        <?php get_template_part('template-parts/content', 'card'); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Load More / Pagination -->
                <div class="load-more-container">
                    <?php
                    $total_posts = $posts_query->found_posts + ($featured_id ? 1 : 0);
                    $shown_posts = min($posts_query->post_count + ($featured_id ? 1 : 0), $total_posts);
                    ?>
                    <p class="posts-count">Showing <?php echo $shown_posts; ?> articles</p>

                    <?php if ($posts_query->max_num_pages > 1) : ?>
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $posts_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '&larr; Previous',
                            'next_text' => 'Next &rarr;',
                        ));
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php else : ?>
                <div class="no-posts">
                    <h2>No posts found</h2>
                    <p>Check back soon for new content.</p>
                </div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </section>

        <!-- Newsletter CTA -->
        <section class="blog-cta">
            <div class="section-container">
                <div class="blog-cta-card">
                    <div class="blog-cta-content">
                        <h2>Stay ahead of TPV compliance</h2>
                        <p>Get the latest insights on regulatory changes, AI technology, and operational best practices delivered to your inbox.</p>
                    </div>
                    <div class="blog-cta-action">
                        <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary btn-large">
                            <span>Book a Demo</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>
