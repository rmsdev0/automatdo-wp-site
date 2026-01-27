<?php
/**
 * Main Index Template (Blog listing fallback)
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Blog Header -->
        <header class="blog-header">
            <div class="blog-header-container">
                <span class="section-tag">Blog</span>
                <h1 class="blog-title">Insights & Resources</h1>
                <p class="blog-subtitle">Expert perspectives on AI voice technology, TPV compliance, and contact center automation.</p>
            </div>
        </header>

        <!-- Blog Posts -->
        <section class="blog-posts">
            <div class="posts-container">
                <?php if (have_posts()) : ?>

                    <!-- Category Filter (optional) -->
                    <div class="category-filters">
                        <a class="category-filter active" data-category="all" href="<?php echo esc_url(home_url('/blog/')); ?>">All Posts</a>
                        <?php
                        $categories = get_categories(array('hide_empty' => true));
                        foreach ($categories as $category) :
                        ?>
                            <a class="category-filter" data-category="<?php echo esc_attr($category->slug); ?>" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content', 'card'); ?>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '&larr; Previous',
                            'next_text' => 'Next &rarr;',
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    <div class="no-posts">
                        <h2>No posts found</h2>
                        <p>Check back soon for new content.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

<?php get_footer(); ?>
