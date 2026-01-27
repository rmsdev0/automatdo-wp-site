<?php
/**
 * Author Archive Template
 *
 * @package Automatdo
 */

get_header();

$author = get_queried_object();
$author_id = isset($author->ID) ? $author->ID : 0;
$author_name = $author_id ? get_the_author_meta('display_name', $author_id) : '';
$author_bio = $author_id ? get_the_author_meta('description', $author_id) : '';
$author_url = $author_id ? get_the_author_meta('user_url', $author_id) : '';
?>

    <!-- Main Content -->
    <main id="main-content" itemscope itemtype="https://schema.org/ProfilePage">
        <!-- Author Header -->
        <section class="blog-header">
            <div class="blog-header-container">
                <span class="section-tag">Author</span>
                <h1 class="blog-title" itemprop="name"><?php echo esc_html($author_name ?: 'Automatdo Team'); ?></h1>
                <?php if ($author_bio) : ?>
                    <p class="blog-subtitle" itemprop="description"><?php echo esc_html($author_bio); ?></p>
                <?php else : ?>
                    <p class="blog-subtitle">Insights and guides from the Automatdo team.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Author Profile -->
        <section class="blog-posts-section" itemprop="mainEntity" itemscope itemtype="https://schema.org/Person">
            <div class="section-container">
                <div class="article-meta">
                    <div class="article-author">
                        <div class="author-avatar">
                            <?php echo get_avatar($author_id, 64); ?>
                        </div>
                        <div class="author-info">
                            <span class="author-name" itemprop="name"><?php echo esc_html($author_name ?: 'Automatdo Team'); ?></span>
                            <?php if ($author_url) : ?>
                                <a class="author-role" href="<?php echo esc_url($author_url); ?>" itemprop="url" rel="noopener">
                                    <?php echo esc_html($author_url); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

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
