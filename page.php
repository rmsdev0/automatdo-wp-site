<?php
/**
 * Default Page Template
 * Used for standard WordPress pages like Privacy Policy, Terms of Service, etc.
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content" class="legal-page">
        <!-- Page Header -->
        <section class="legal-header">
            <div class="section-container">
                <div class="legal-header-content">
                    <h1 class="legal-title"><?php the_title(); ?></h1>
                    <?php if (get_the_modified_date() !== get_the_date()) : ?>
                        <p class="legal-updated">Last updated: <?php echo get_the_modified_date('F j, Y'); ?></p>
                    <?php else : ?>
                        <p class="legal-updated">Effective: <?php echo get_the_date('F j, Y'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Page Content -->
        <section class="legal-content">
            <div class="section-container">
                <div class="legal-body">
                    <?php
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </section>

        <!-- Back to Home CTA -->
        <section class="legal-cta">
            <div class="section-container">
                <div class="legal-cta-content">
                    <p>Have questions about our policies?</p>
                    <a href="<?php echo home_url('/contact'); ?>" class="btn-primary">
                        <span>Contact Us</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
?>
