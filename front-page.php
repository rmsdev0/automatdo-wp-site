<?php
/**
 * Front Page Template
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Hero Section -->
    <main id="main-content">
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-container">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                <span>Global Multi-Language Support</span>
            </div>

            <h1 class="hero-title" id="hero-title">
                <span class="title-line">AI Voice Agents</span>
                <span class="title-line title-gradient">That Actually Work</span>
            </h1>

            <p class="hero-subtitle">
                Enterprise-grade AI voice agents custom built for customer service, Third-Party Verification,
                and contact centers. <br>Crafted for your business.
            </p>

            <div class="hero-cta">
                <a href="#demo" class="btn-primary btn-large">
                    <span>Book a Demo</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <button type="button" class="btn-secondary btn-large voice-demo-trigger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                        <line x1="12" y1="19" x2="12" y2="23"/>
                        <line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                    <span>Try Automatdo Voice Now</span>
                </button>
            </div>

            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">10,000+ Calls</span>
                    <span class="stat-label">Handled for Our Clients</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-number">50+ Languages</span>
                    <span class="stat-label">On a Single Number</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-number">Zero Hold Times</span>
                    <span class="stat-label">24/7 Availability</span>
                </div>
            </div>
        </div>

        <!-- Hero Visual -->
        <div class="hero-visual">
            <div class="visual-container">
                <div class="visual-glow"></div>
                <div class="visual-card">
                    <div class="card-header">
                        <div class="card-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="card-title">Live Agent Call</span>
                    </div>
                    <div class="card-content">
                        <div class="waveform">
                            <div class="wave-bar" style="--height: 40%"></div>
                            <div class="wave-bar" style="--height: 70%"></div>
                            <div class="wave-bar" style="--height: 55%"></div>
                            <div class="wave-bar" style="--height: 85%"></div>
                            <div class="wave-bar" style="--height: 45%"></div>
                            <div class="wave-bar" style="--height: 90%"></div>
                            <div class="wave-bar" style="--height: 60%"></div>
                            <div class="wave-bar" style="--height: 75%"></div>
                            <div class="wave-bar" style="--height: 50%"></div>
                            <div class="wave-bar" style="--height: 80%"></div>
                            <div class="wave-bar" style="--height: 65%"></div>
                            <div class="wave-bar" style="--height: 45%"></div>
                        </div>
                        <div class="transcript">
                            <div class="transcript-line agent">
                                <span class="speaker">AI Agent</span>
                                <span class="text">"Thank you for calling. I can help you schedule an appointment today."</span>
                            </div>
                            <div class="transcript-line customer">
                                <span class="speaker">Customer</span>
                                <span class="text">"I'd like to book for tomorrow afternoon."</span>
                            </div>
                            <div class="transcript-line agent typing">
                                <span class="speaker">AI Agent</span>
                                <span class="text">"I have availability at 2 PM or 4 PM. Which works better?"</span>
                                <span class="cursor"></span>
                            </div>
                        </div>
                        <div class="card-status">
                            <span class="status-dot"></span>
                            <span>Processing with GPT-Realtime</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logos Section -->
    <section class="logos">
        <div class="logos-container">
            <p class="logos-title">Engineered for high-volume operations</p>
            <div class="logos-track">
                <div class="logos-slide">
                    <div class="logo-item">Health & Fitness</div>
                    <div class="logo-item">Home Services</div>
                    <div class="logo-item">Enterprise TPV</div>
                    <div class="logo-item">Community Solar</div>
                    <div class="logo-item">Deregulated Energy</div>
                    <div class="logo-item">Contact Center</div>
                    <div class="logo-item">Customer Service</div>
                    <div class="logo-item">Storage Facilities</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-container">
            <div class="section-header">
                <span class="section-tag">Features</span>
                <h2 class="section-title">Voice Intelligence at Scale<br></h2>
                <p class="section-subtitle">
                    From instant scheduling to deep analytics, get total control over your voice operations without the headcount.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card feature-large">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M16 4C9.373 4 4 9.373 4 16s5.373 12 12 12 12-5.373 12-12S22.627 4 16 4z" stroke="currentColor" stroke-width="2"/>
                            <path d="M13 12l6 4-6 4V12z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Real Time Voice Engine</h3>
                    <p class="feature-desc">
                        Natural, interruption-friendly conversations with sub-second latency. Instantly switches between 50+ languages on a single number.
                    </p>
                    <div class="feature-visual voice-visual">
                        <div class="voice-wave">
                            <svg viewBox="0 0 200 60" preserveAspectRatio="none">
                                <path class="wave-path" d="M0,30 Q25,10 50,30 T100,30 T150,30 T200,30" fill="none" stroke="url(#waveGradient)" stroke-width="3"/>
                                <defs>
                                    <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" style="stop-color:#f0d078"/>
                                        <stop offset="50%" style="stop-color:#d4a530"/>
                                        <stop offset="100%" style="stop-color:#b8912a"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <circle cx="16" cy="16" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 10v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Smart Scheduling</h3>
                    <p class="feature-desc">
                        Agents negotiate times, check availability across Google/Outlook/GoHighLevel,
                        and book appointments directly onto your calendar while you sleep.
                    </p>
                </div>

                <div class="feature-card feature-large">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M16 4v4M16 24v4M4 16h4M24 16h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="16" cy="16" r="6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Intelligent Routing & Transfer</h3>
                    <p class="feature-desc">
                        Context-aware call routing based on customer history, agent expertise, and
                        real-time availability. Seamless warm transfers when human help is needed.
                    </p>
                    <div class="feature-visual routing-visual">
                        <div class="routing-diagram">
                            <div class="routing-node node-caller">Caller</div>
                            <div class="routing-line line-1"></div>
                            <div class="routing-node node-ai">AI Agent</div>
                            <div class="routing-fork">
                                <div class="routing-branch">
                                    <div class="routing-line line-2"></div>
                                    <div class="routing-node node-human">Human</div>
                                </div>
                                <div class="routing-branch">
                                    <div class="routing-line line-3"></div>
                                    <div class="routing-node node-resolved">Resolved</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M4 24l7-7 5 5 12-12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20 8h8v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Analytics & QA</h3>
                    <p class="feature-desc">
                        Real-time dashboards, sentiment analysis, and automated call scoring.
                        Coach your team with AI-powered insights.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Section -->
    <?php get_template_part('template-parts/section', 'solutions'); ?>

    <!-- Social Proof Stats Banner -->
    <section class="social-proof-banner" aria-label="Company achievements">
        <div class="social-proof-container">
            <p class="social-proof-lead">Join the businesses that trust Automatdo</p>
            <div class="social-proof-stats">
                <div class="proof-stat">
                    <span class="proof-stat-number">10,000+</span>
                    <span class="proof-stat-label">Calls Automated</span>
                </div>
                <div class="proof-stat-divider" aria-hidden="true"></div>
                <div class="proof-stat">
                    <span class="proof-stat-number">500+</span>
                    <span class="proof-stat-label">Appointments Scheduled</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <?php get_template_part('template-parts/section', 'testimonials'); ?>

    <!-- CTA Section -->
    <?php get_template_part('template-parts/section', 'cta'); ?>

    </main>

<?php get_footer(); ?>
