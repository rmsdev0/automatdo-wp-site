    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white_logo_no_background.png" alt="<?php bloginfo('name'); ?>" height="28">
                    <?php endif; ?>
                    <p><?php echo esc_html(get_bloginfo('description') ?: 'AI-powered voice agents for enterprise contact centers, TPV verification, and customer service.'); ?></p>
                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Product</h4>
                        <a href="<?php echo home_url('/features'); ?>">Features</a>
                        <a href="<?php echo home_url('/#solutions'); ?>">Solutions</a>
                        <a href="<?php echo home_url('/#pricing'); ?>">Pricing</a>
                    </div>
                    <div class="footer-column">
                        <h4>Solutions</h4>
                        <a href="<?php echo home_url('/solutions/tpv/'); ?>">TPV Verification</a>
                        <a href="/">Contact Centers</a>
                        <a href="<?php echo home_url('/solutions/home-services/'); ?>">Home Services</a>
                        <a href="<?php echo home_url('/solutions/fitness/'); ?>">Fitness & Wellness</a>
                    </div>
                    <div class="footer-column">
                        <h4>Company</h4>
                        <a href="/about/">About</a>
                        <a href="<?php echo home_url('/blog/'); ?>">Blog</a>
                        <a href="<?php echo home_url('/contact/'); ?>">Contact</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <div class="footer-legal">
                    <?php if (get_privacy_policy_url()) : ?>
                        <a href="<?php echo get_privacy_policy_url(); ?>">Privacy Policy</a>
                    <?php else : ?>
                        <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
