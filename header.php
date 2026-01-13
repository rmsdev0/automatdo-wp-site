<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>

    <?php if (is_front_page()) : ?>
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Automatdo",
        "legalName": "Automatdo, Inc.",
        "url": "<?php echo home_url(); ?>",
        "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/icon.png",
        "description": "AI-powered voice agents for enterprise contact centers, TPV verification, and customer service.",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "US",
            "addressRegion": "MN"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "sales",
            "email": "rschuetz@automatdo.com"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Automatdo AI Voice Agents",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Cloud-based",
        "description": "Enterprise-grade AI voice agents for contact centers, TPV verification, and customer service. Deploy in minutes with sub-700ms latency and 50+ language support.",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD",
            "description": "Contact for pricing"
        },
        "featureList": [
            "Sub-700ms response latency",
            "50+ language support",
            "24/7 availability",
            "Smart scheduling integration",
            "Intelligent call routing",
            "Real-time analytics"
        ],
        "provider": {
            "@type": "Organization",
            "name": "Automatdo"
        }
    }
    </script>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="skip-link"><?php esc_html_e('Skip to main content', 'automatdo'); ?></a>

    <?php if (is_singular('post')) : ?>
    <!-- Reading Progress Bar -->
    <div class="reading-progress" aria-hidden="true">
        <div class="reading-progress-bar"></div>
    </div>
    <?php endif; ?>

    <!-- Gradient Orbs Background -->
    <div class="gradient-orbs" aria-hidden="true">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Noise Overlay -->
    <div class="noise-overlay" aria-hidden="true"></div>

    <!-- Navigation -->
    <nav class="nav<?php echo is_singular('post') || is_home() || is_archive() || is_404() ? ' scrolled' : ''; ?>">
        <div class="nav-container">
            <a href="<?php echo home_url(); ?>" class="nav-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white_logo_no_background.png" alt="<?php bloginfo('name'); ?>" height="28">
                <?php endif; ?>
            </a>

            <div class="nav-links">
                <a href="<?php echo home_url('/#features'); ?>" class="nav-link">Features</a>
                <a href="<?php echo home_url('/#solutions'); ?>" class="nav-link">Solutions</a>
                <a href="<?php echo home_url('/blog/'); ?>" class="nav-link<?php echo is_home() || is_singular('post') || is_archive() ? ' active' : ''; ?>">Blog</a>
                <a href="<?php echo home_url('/contact/'); ?>" class="nav-link">Contact</a>
                <!-- Mobile-only Book a Demo button -->
                <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary btn-primary-mobile">Book a Demo</a>
                <!-- Mobile-only theme toggle -->
                <button class="theme-toggle theme-toggle-mobile" aria-label="<?php esc_attr_e('Toggle theme', 'automatdo'); ?>">
                    <span class="theme-toggle-icon icon-sun">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="10" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 2V4M10 16V18M18 10H16M4 10H2M15.66 4.34L14.24 5.76M5.76 14.24L4.34 15.66M15.66 15.66L14.24 14.24M5.76 5.76L4.34 4.34" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="theme-toggle-icon icon-moon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="theme-toggle-label">Theme</span>
                </button>
            </div>

            <div class="nav-actions">
                <button class="theme-toggle" id="theme-toggle" aria-label="<?php esc_attr_e('Toggle theme', 'automatdo'); ?>">
                    <span class="theme-toggle-icon icon-sun">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="10" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 2V4M10 16V18M18 10H16M4 10H2M15.66 4.34L14.24 5.76M5.76 14.24L4.34 15.66M15.66 15.66L14.24 14.24M5.76 5.76L4.34 4.34" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="theme-toggle-icon icon-moon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary">Book a Demo</a>
            </div>

            <button class="nav-mobile-toggle" aria-label="<?php esc_attr_e('Menu', 'automatdo'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>
