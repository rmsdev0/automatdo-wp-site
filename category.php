<?php
/**
 * Category Archive Template
 *
 * @package Automatdo
 */

get_header();

$category = get_queried_object();
$category_name = isset($category->name) ? $category->name : 'Category';
$category_description = isset($category->description) ? $category->description : '';
?>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Category Header -->
        <section class="blog-header">
            <div class="blog-header-container">
                <span class="section-tag">Category</span>
                <h1 class="blog-title"><?php echo esc_html($category_name); ?></h1>
                <?php if ($category_description) : ?>
                    <p class="blog-subtitle"><?php echo wp_kses_post($category_description); ?></p>
                <?php else : ?>
                    <p class="blog-subtitle">Browse articles in <?php echo esc_html($category_name); ?>.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Category Posts -->
        <section class="blog-posts-section">
            <div class="section-container">
                <?php if (have_posts()) : ?>
                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content', 'card'); ?>
                        <?php endwhile; ?>
                    </div>

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
