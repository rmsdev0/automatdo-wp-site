<?php
/**
 * 404 Error Page Template
 *
 * @package Automatdo
 */

get_header();
?>

<style>
    /* 404 Page Specific Styles */
    .error-section {
        position: relative;
        z-index: 10;
        min-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 8rem 2rem 4rem;
        text-align: center;
    }

    .error-container {
        position: relative;
        max-width: 600px;
    }

    /* Floating particles container */
    .particles {
        position: absolute;
        inset: -100px;
        pointer-events: none;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--accent-primary);
        border-radius: 50%;
        opacity: 0;
        animation: particleFloat 4s ease-in-out infinite;
    }

    .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 20%; top: 80%; animation-delay: 0.5s; }
    .particle:nth-child(3) { left: 80%; top: 30%; animation-delay: 1s; }
    .particle:nth-child(4) { left: 90%; top: 70%; animation-delay: 1.5s; }
    .particle:nth-child(5) { left: 50%; top: 10%; animation-delay: 2s; }
    .particle:nth-child(6) { left: 30%; top: 60%; animation-delay: 2.5s; }
    .particle:nth-child(7) { left: 70%; top: 90%; animation-delay: 3s; }
    .particle:nth-child(8) { left: 5%; top: 50%; animation-delay: 3.5s; }

    @keyframes particleFloat {
        0%, 100% {
            opacity: 0;
            transform: translateY(0) scale(0);
        }
        10% {
            opacity: 0.8;
            transform: translateY(0) scale(1);
        }
        90% {
            opacity: 0.8;
            transform: translateY(-60px) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-70px) scale(0);
        }
    }

    /* Main 404 number with shimmer effect */
    .error-code {
        position: relative;
        font-family: var(--font-display);
        font-size: clamp(8rem, 25vw, 14rem);
        font-weight: 500;
        line-height: 1;
        margin-bottom: 1.5rem;
        background: linear-gradient(
            135deg,
            var(--accent-tertiary) 0%,
            var(--accent-primary) 25%,
            var(--accent-light) 50%,
            var(--accent-primary) 75%,
            var(--accent-tertiary) 100%
        );
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s ease-in-out infinite, fadeInScale 0.8s ease-out backwards;
        cursor: default;
        user-select: none;
    }

    .error-code::after {
        content: '404';
        position: absolute;
        inset: 0;
        font-family: inherit;
        font-size: inherit;
        font-weight: inherit;
        background: linear-gradient(
            135deg,
            transparent 0%,
            rgba(240, 208, 120, 0.3) 50%,
            transparent 100%
        );
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmerOverlay 3s ease-in-out infinite;
        animation-delay: 0.5s;
    }

    @keyframes shimmer {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    @keyframes shimmerOverlay {
        0%, 100% {
            background-position: 200% 50%;
        }
        50% {
            background-position: -100% 50%;
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Glow effect behind the number */
    .error-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, var(--accent-glow-strong) 0%, transparent 70%);
        filter: blur(60px);
        opacity: 0.6;
        animation: glowPulse 4s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes glowPulse {
        0%, 100% {
            opacity: 0.4;
            transform: translate(-50%, -50%) scale(1);
        }
        50% {
            opacity: 0.7;
            transform: translate(-50%, -50%) scale(1.1);
        }
    }

    .error-title {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 500;
        margin-bottom: 1rem;
        animation: fadeInUp 0.6s ease-out 0.2s backwards;
    }

    .error-message {
        color: var(--text-secondary);
        font-size: 1.125rem;
        max-width: 400px;
        margin: 0 auto 2rem;
        line-height: 1.7;
        animation: fadeInUp 0.6s ease-out 0.3s backwards;
    }

    .error-cta {
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }

    .error-links {
        margin-top: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }

    .error-links a {
        color: var(--text-tertiary);
        text-decoration: none;
        font-size: 0.9375rem;
        font-weight: 500;
        transition: color var(--transition-fast);
        position: relative;
    }

    .error-links a::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
        transition: width var(--transition-base);
    }

    .error-links a:hover {
        color: var(--text-primary);
    }

    .error-links a:hover::after {
        width: 100%;
    }

    /* Divider dots between links */
    .error-links span.divider {
        width: 4px;
        height: 4px;
        background: var(--border-medium);
        border-radius: 50%;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .error-section {
            padding: 7rem 1.5rem 3rem;
            min-height: calc(100vh - 150px);
        }

        .error-links {
            gap: 1.5rem;
        }

        .error-links span.divider {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .error-code {
            font-size: 6rem;
        }

        .error-title {
            font-size: 1.5rem;
        }

        .error-message {
            font-size: 1rem;
        }

        .particles {
            display: none;
        }
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .error-code,
        .error-code::after,
        .error-glow,
        .particle {
            animation: none;
        }

        .error-code {
            background-position: 0% 50%;
        }

        .error-glow {
            opacity: 0.5;
        }
    }
</style>

<!-- Main Content -->
<main id="main-content">
    <section class="error-section">
        <div class="error-container">
            <!-- Floating particles -->
            <div class="particles" aria-hidden="true">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>

            <!-- Glow effect -->
            <div class="error-glow" aria-hidden="true"></div>

            <!-- 404 Number -->
            <div class="error-code" aria-label="<?php esc_attr_e('Error 404', 'automatdo'); ?>">404</div>

            <h1 class="error-title"><?php esc_html_e('Page Not Found', 'automatdo'); ?></h1>
            <p class="error-message">
                <?php esc_html_e("The page you're looking for doesn't exist or has been moved to a new location.", 'automatdo'); ?>
            </p>

            <div class="error-cta">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary btn-large">
                    <span><?php esc_html_e('Back to Home', 'automatdo'); ?></span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="error-links">
                <a href="<?php echo esc_url(home_url('/#features')); ?>"><?php esc_html_e('Features', 'automatdo'); ?></a>
                <span class="divider" aria-hidden="true"></span>
                <a href="<?php echo esc_url(home_url('/#solutions')); ?>"><?php esc_html_e('Solutions', 'automatdo'); ?></a>
                <span class="divider" aria-hidden="true"></span>
                <a href="<?php echo esc_url(home_url('/#demo')); ?>"><?php esc_html_e('Contact Us', 'automatdo'); ?></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
