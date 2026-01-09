<?php
/**
 * Single Post Template
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content">
        <?php while (have_posts()) : the_post(); ?>

        <!-- Article Header -->
        <header class="article-header">
            <div class="article-header-container">
                <nav class="article-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo home_url('/blog/'); ?>">Blog</a>
                    <span>/</span>
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        echo '<span>' . esc_html($categories[0]->name) . '</span>';
                    }
                    ?>
                </nav>

                <h1 class="article-title"><?php the_title(); ?></h1>

                <?php if (has_excerpt()) : ?>
                <p class="article-excerpt"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <div class="article-meta">
                    <div class="article-author">
                        <div class="author-avatar"><?php echo automatdo_get_author_initials(); ?></div>
                        <div class="author-info">
                            <span class="author-name"><?php the_author(); ?></span>
                            <span class="author-role"><?php echo get_the_author_meta('description') ?: 'Automatdo Team'; ?></span>
                        </div>
                    </div>
                    <div class="article-stats">
                        <span><?php echo get_the_date('F j, Y'); ?></span>
                        <span><?php echo automatdo_reading_time(); ?> min read</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Article Content -->
        <article class="article-content-section">
            <div class="article-content">
                <?php the_content(); ?>

                <!-- Article CTA -->
                <div class="article-cta">
                    <h3>Ready to automate your TPV verification?</h3>
                    <p>See how Automatdo's AI voice agents can reduce costs and improve compliance.</p>
                    <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary btn-large">
                        <span>Book a Demo</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <?php endwhile; ?>

        <!-- Related Posts -->
        <?php
        $categories = get_the_category();
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }

            $related_posts = new WP_Query(array(
                'category__in'   => $category_ids,
                'post__not_in'   => array(get_the_ID()),
                'posts_per_page' => 3,
                'orderby'        => 'rand',
            ));

            if ($related_posts->have_posts()) :
        ?>
        <section class="related-posts">
            <div class="related-posts-container">
                <header class="related-posts-header">
                    <h2 class="related-posts-title">Related Articles</h2>
                </header>
                <div class="related-posts-grid">
                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                        <?php get_template_part('template-parts/content', 'card'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
            endif;
            wp_reset_postdata();
        }
        ?>
    </main>

<?php get_footer(); ?>
