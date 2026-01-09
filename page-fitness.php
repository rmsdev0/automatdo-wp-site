<?php
/**
 * Template Name: Fitness Solution
 * Description: Fitness & Wellness solution page
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content">

        <!-- Hero Section - Full viewport with diagonal energy -->
        <section class="fit-hero">
            <div class="fit-hero-content">
                <div class="fit-hero-badge">
                    <span class="pulse-dot"></span>
                    <span>Fitness & Wellness</span>
                </div>

                <h1 class="fit-hero-title">
                    <span class="title-word">Every</span>
                    <span class="title-word">Call.</span>
                    <span class="title-word accent">Answered.</span>
                </h1>

                <p class="fit-hero-subtitle">
                    Your front desk is slammed. Phones are ringing. Leads are walking out the door.
                    <strong>Not anymore.</strong>
                </p>

                <div class="fit-hero-cta">
                    <a href="#demo" class="btn-primary btn-large">
                        <span>Start Capturing Leads</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Phone Mockup -->
            <div class="fit-hero-phone">
                <div class="phone-frame">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="phone-header">
                            <span class="phone-time">9:41</span>
                            <div class="phone-icons">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="phone-call-ui">
                            <div class="caller-pulse"></div>
                            <div class="caller-avatar">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <circle cx="16" cy="12" r="6" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 28c0-5.523 4.477-10 10-10s10 4.477 10 10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <span class="caller-name">Incoming Call</span>
                            <span class="caller-label">New Lead - Tour Inquiry</span>
                            <div class="call-actions">
                                <button class="call-decline">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>
                                <button class="call-accept">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="phone-ai-badge">
                            <span class="ai-pulse"></span>
                            <span>AI Agent Ready</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagonal cut -->
            <div class="hero-diagonal"></div>
        </section>

        <!-- Impact Numbers - Massive typography -->
        <section class="fit-impact">
            <div class="impact-scroll">
                <div class="impact-stat">
                    <span class="impact-number" data-value="40">0</span>
                    <span class="impact-unit">%</span>
                    <span class="impact-label">of gym calls go unanswered after hours</span>
                </div>
                <div class="impact-divider">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M24 8v32M8 24h32" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="impact-stat">
                    <span class="impact-number" data-value="67">0</span>
                    <span class="impact-unit">%</span>
                    <span class="impact-label">of callers won't leave a voicemail</span>
                </div>
                <div class="impact-divider">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M12 36L36 12M36 12H16M36 12v20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="impact-stat gold">
                    <span class="impact-currency">$</span>
                    <span class="impact-number" data-value="1200">0</span>
                    <span class="impact-label">average annual value per missed lead</span>
                </div>
            </div>
        </section>

        <!-- The Problem - Visual Timeline -->
        <section class="fit-problem">
            <div class="problem-container">
                <h2 class="problem-title">The Spiral</h2>
                <p class="problem-intro">Every missed call starts a chain reaction</p>

                <div class="problem-timeline">
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M26 12.92v4a2 2 0 01-2.18 2 15.79 15.79 0 01-6.88-2.45 15.5 15.5 0 01-4.77-4.77 15.79 15.79 0 01-2.45-6.91A2 2 0 0111.69 3h4" stroke="currentColor" stroke-width="2"/>
                                <path d="M22 3l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M26 7h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-time">5:47 PM</span>
                            <h3>Phone rings during rush hour</h3>
                            <p>Front desk is helping 3 members. Phone goes to voicemail.</p>
                        </div>
                    </div>

                    <div class="timeline-connector">
                        <div class="connector-line"></div>
                        <div class="connector-arrow"></div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon warning">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M8 24l16-16M24 24L8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-time">5:48 PM</span>
                            <h3>Caller hangs up</h3>
                            <p>67% of callers won't leave a message. They call your competitor.</p>
                        </div>
                    </div>

                    <div class="timeline-connector">
                        <div class="connector-line"></div>
                        <div class="connector-arrow"></div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon danger">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <circle cx="16" cy="16" r="12" stroke="currentColor" stroke-width="2"/>
                                <path d="M16 10v6M16 20v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-time">Lost</span>
                            <h3>$1,200+ lifetime value gone</h3>
                            <p>That was a prospect ready to buy. Now they're someone else's member.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagonal transition -->
            <div class="problem-diagonal"></div>
        </section>

        <!-- The Solution - Bold Split -->
        <section class="fit-solution">
            <div class="solution-split">
                <div class="solution-left">
                    <span class="solution-tag">The Fix</span>
                    <h2 class="solution-title">
                        AI that answers<br>
                        <span class="accent">before they hang up</span>
                    </h2>
                    <p class="solution-desc">
                        Our voice agents pick up instantly. They know your membership tiers,
                        class schedules, and pricing. They book tours directly into your calendar.
                        24/7. Zero hold time.
                    </p>
                    <a href="#demo" class="btn-primary btn-large">See It In Action</a>
                </div>
                <div class="solution-right">
                    <div class="solution-card">
                        <div class="solution-card-header">
                            <span class="card-status live">
                                <span class="status-pulse"></span>
                                Live Demo
                            </span>
                        </div>
                        <div class="solution-conversation">
                            <div class="convo-message ai">
                                <span class="convo-label">AI Agent</span>
                                <p>"Thanks for calling FitLife Gym! I'm here to help. Are you interested in learning about memberships, or would you like to schedule a tour?"</p>
                            </div>
                            <div class="convo-message caller">
                                <span class="convo-label">Caller</span>
                                <p>"I wanted to ask about your monthly rates and maybe book a tour for tomorrow?"</p>
                            </div>
                            <div class="convo-message ai">
                                <span class="convo-label">AI Agent</span>
                                <p>"I'd be happy to help with both. We have three membership options starting at $29/month. I have tour slots available tomorrow at 10am, 2pm, and 5pm. Which works best for you?"</p>
                            </div>
                            <div class="convo-typing">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="solution-card-footer">
                            <div class="footer-stat">
                                <span class="footer-number">1:23</span>
                                <span class="footer-label">Call Duration</span>
                            </div>
                            <div class="footer-stat">
                                <span class="footer-number success">Booked</span>
                                <span class="footer-label">Tour Status</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features - Stacked Accordion Style -->
        <section class="fit-features">
            <div class="features-header">
                <span class="section-tag">Capabilities</span>
                <h2>Everything your front desk does.<br><span class="accent">Without the hold music.</span></h2>
            </div>

            <div class="features-stack">
                <div class="feature-row" data-feature="booking">
                    <div class="feature-number">01</div>
                    <div class="feature-main">
                        <h3>Instant Tour Booking</h3>
                        <p>Syncs with Google Calendar, Outlook, or your gym software. Books tours on the spot while capturing all lead details.</p>
                    </div>
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect x="8" y="10" width="32" height="28" rx="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 18h32M16 6v8M32 6v8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M20 28l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="feature-row" data-feature="coverage">
                    <div class="feature-number">02</div>
                    <div class="feature-main">
                        <h3>24/7 Coverage</h3>
                        <p>Midnight inquiry? Saturday at 6am? Your AI agent never sleeps, never takes breaks, and never sends anyone to voicemail.</p>
                    </div>
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="16" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 14v10l6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>

                <div class="feature-row" data-feature="knowledge">
                    <div class="feature-number">03</div>
                    <div class="feature-main">
                        <h3>Membership Intelligence</h3>
                        <p>Trained on your pricing, tiers, class schedules, and amenities. Answers questions accurately and recommends the right fit.</p>
                    </div>
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M24 8L12 14v8c0 10 5 17 12 20 7-3 12-10 12-20v-8L24 8z" stroke="currentColor" stroke-width="2"/>
                            <path d="M18 24l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="feature-row" data-feature="transfer">
                    <div class="feature-number">04</div>
                    <div class="feature-main">
                        <h3>Smart Transfers</h3>
                        <p>Complex situation? The AI briefs your staff before transferring so they get full context. No starting over.</p>
                    </div>
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <circle cx="16" cy="16" r="6" stroke="currentColor" stroke-width="2"/>
                            <circle cx="32" cy="32" r="6" stroke="currentColor" stroke-width="2"/>
                            <path d="M20 20l8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M32 20l-4 4M28 20h4v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="feature-row" data-feature="analytics">
                    <div class="feature-number">05</div>
                    <div class="feature-main">
                        <h3>Lead Analytics</h3>
                        <p>Track every call, every booking, every conversion. Know your peak times, common questions, and lead sources.</p>
                    </div>
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M8 36l10-12 8 6 14-18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M32 12h8v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Who It's For - Horizontal Scroll -->
        <section class="fit-audience">
            <div class="audience-header">
                <span class="section-tag">Who We Serve</span>
                <h2>From boutique studios to franchise empires</h2>
            </div>

            <div class="audience-scroll-container">
                <div class="audience-scroll">
                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <rect x="12" y="18" width="32" height="20" rx="2" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 26h4M44 26h4M8 30h4M44 30h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="28" cy="28" r="5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <h3>Big Box Gyms</h3>
                        <p>High-volume locations with constant phone traffic. Handle the overflow without adding headcount.</p>
                    </div>

                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="20" r="8" stroke="currentColor" stroke-width="2"/>
                                <path d="M16 44c0-6.627 5.373-12 12-12s12 5.373 12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M36 14l4-4M36 26l4 4M20 14l-4-4M20 26l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3>Yoga & Pilates</h3>
                        <p>Class bookings, package inquiries, and schedule questions answered with zen-like patience.</p>
                    </div>

                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <path d="M28 12l12 6v10c0 8-5 14-12 16-7-2-12-8-12-16V18l12-6z" stroke="currentColor" stroke-width="2"/>
                                <path d="M22 28l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>CrossFit & HIIT</h3>
                        <p>Trial class bookings, WOD questions, and membership info delivered with intensity.</p>
                    </div>

                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="28" r="16" stroke="currentColor" stroke-width="2"/>
                                <path d="M28 18v10l7 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="28" cy="28" r="3" fill="currentColor"/>
                            </svg>
                        </div>
                        <h3>Cycling Studios</h3>
                        <p>Class reservations, bike preferences, and waitlist management on autopilot.</p>
                    </div>

                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <path d="M28 10l-3 8h-8l6.5 5-2.5 8 7-5 7 5-2.5-8 6.5-5h-8l-3-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <circle cx="28" cy="38" r="8" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <h3>Wellness & Spa</h3>
                        <p>Appointment scheduling, service info, and a calming voice that matches your brand.</p>
                    </div>

                    <div class="audience-card">
                        <div class="audience-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <path d="M18 18l6 6M32 18l-6 6M18 38l6-6M32 38l-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="28" cy="28" r="4" stroke="currentColor" stroke-width="2"/>
                                <rect x="12" y="12" width="32" height="32" rx="4" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <h3>Martial Arts</h3>
                        <p>Trial class scheduling, program info, and belt-level questions handled with discipline.</p>
                    </div>
                </div>
            </div>

            <div class="scroll-hint">
                <span>Scroll to explore</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </section>

        <!-- Single Testimonial - Big Impact -->
        <section class="fit-testimonial">
            <div class="testimonial-container">
                <div class="testimonial-quote">
                    <svg class="quote-mark" width="64" height="64" viewBox="0 0 64 64" fill="none">
                        <path d="M14 40c-2.2 0-4-1.8-4-4v-8c0-6.6 5.4-12 12-12h2v8h-2c-2.2 0-4 1.8-4 4v4h6v8H14zm28 0c-2.2 0-4-1.8-4-4v-8c0-6.6 5.4-12 12-12h2v8h-2c-2.2 0-4 1.8-4 4v4h6v8H42z" fill="currentColor"/>
                    </svg>
                    <blockquote>
                        We went from missing 40% of after-hours calls to <span class="highlight">capturing every single one</span>.
                        Last month, the AI booked 47 tours that would have gone to voicemail. That's potentially
                        <span class="highlight">$56,000 in annual membership revenue</span> we would have lost.
                    </blockquote>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">SL</div>
                    <div class="author-info">
                        <span class="author-name">Beta User</span>
                        <span class="author-role">Owner, Multi-Location Fitness Center</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section - Full Width Bold -->
        <section class="fit-cta" id="demo">
            <div class="cta-diagonal-bg"></div>
            <div class="cta-content">
                <h2 class="cta-title">
                    Stop losing leads.<br>
                    <span class="accent">Start today.</span>
                </h2>
                <p class="cta-subtitle">
                    15-minute demo. See exactly how AI handles your gym's calls.
                </p>

                <form class="fit-form" id="demo-form">
                    <div class="form-grid">
                        <div class="form-field">
                            <input type="text" id="firstname" name="firstname" required placeholder=" ">
                            <label for="firstname">First Name</label>
                        </div>
                        <div class="form-field">
                            <input type="text" id="lastname" name="lastname" required placeholder=" ">
                            <label for="lastname">Last Name</label>
                        </div>
                        <div class="form-field">
                            <input type="email" id="email" name="email" required placeholder=" ">
                            <label for="email">Work Email</label>
                        </div>
                        <div class="form-field">
                            <input type="text" id="company" name="company" required placeholder=" ">
                            <label for="company">Gym / Studio Name</label>
                        </div>
                        <div class="form-field">
                            <input type="tel" id="phone" name="phone" placeholder=" ">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="form-field">
                            <select id="locations" name="locations" required>
                                <option value="" disabled selected></option>
                                <option value="1">1 location</option>
                                <option value="2-5">2-5 locations</option>
                                <option value="6-20">6-20 locations</option>
                                <option value="20+">20+ locations</option>
                            </select>
                            <label for="locations">Number of Locations</label>
                        </div>
                    </div>

                    <!-- Hidden field to indicate Fitness interest -->
                    <input type="hidden" name="use_case" value="Fitness / Gym Operations">
                    <!-- Honeypot field -->
                    <div style="position: absolute; left: -9999px;" aria-hidden="true">
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Get Your Demo</span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <p class="form-disclaimer">
                        No credit card required. See results in 15 minutes.
                    </p>
                </form>
            </div>
        </section>

    </main>

<?php
get_footer();
