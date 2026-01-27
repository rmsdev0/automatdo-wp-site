<?php
/**
 * Template Name: Features Page
 * Description: Comprehensive features showcase with scroll-triggered animations
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content" class="features-page">

        <!-- Hero Section -->
        <section class="features-hero">
            <div class="features-hero-bg">
                <div class="hero-grid"></div>
                <div class="hero-glow hero-glow-1"></div>
                <div class="hero-glow hero-glow-2"></div>
            </div>
            <div class="section-container">
                <div class="features-hero-content">
                    <span class="section-tag">Platform</span>
                    <h1 class="features-hero-title">
                        <span class="title-line">Everything You Need to</span>
                        <span class="title-line title-gradient">Scale Voice Operations</span>
                    </h1>
                    <p class="features-hero-subtitle">
                        Enterprise-grade AI voice infrastructure with real-time intelligence,
                        seamless integrations, and built-in compliance.
                    </p>
                    <div class="features-hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-value">24/7</span>
                            <span class="hero-stat-label">Always Available</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-value">50+</span>
                            <span class="hero-stat-label">Languages</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-value">99.9%</span>
                            <span class="hero-stat-label">Uptime SLA</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Spotlight Features -->
        <section class="spotlight-features">
            <div class="section-container">

                <!-- Spotlight 1: Real-Time Voice Engine -->
                <div class="spotlight-feature" data-spotlight="voice-engine">
                    <div class="spotlight-content">
                        <div class="spotlight-badge">Core Technology</div>
                        <h2 class="spotlight-title">Real-Time Voice Engine</h2>
                        <p class="spotlight-desc">
                            Powered by GPT-4o Realtime, our voice engine delivers natural, interruption-friendly
                            conversations with sub-300ms latency. Callers experience seamless interactions that
                            feel genuinely human.
                        </p>
                        <ul class="spotlight-features-list">
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Natural turn-taking with barge-in support</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Voice activity detection (VAD) with configurable thresholds</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Multiple AI providers: OpenAI GPT-4o, xAI Grok</span>
                            </li>
                        </ul>
                    </div>
                    <div class="spotlight-visual">
                        <div class="voice-engine-viz">
                            <div class="viz-waveform">
                                <div class="waveform-track">
                                    <svg viewBox="0 0 400 80" preserveAspectRatio="none">
                                        <path class="wave-line wave-line-1" d="M0,40 Q50,20 100,40 T200,40 T300,40 T400,40" fill="none" stroke="url(#waveGrad1)" stroke-width="2"/>
                                        <path class="wave-line wave-line-2" d="M0,40 Q50,60 100,40 T200,40 T300,40 T400,40" fill="none" stroke="url(#waveGrad2)" stroke-width="2"/>
                                        <defs>
                                            <linearGradient id="waveGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:var(--accent-primary);stop-opacity:0.3"/>
                                                <stop offset="50%" style="stop-color:var(--accent-primary);stop-opacity:1"/>
                                                <stop offset="100%" style="stop-color:var(--accent-primary);stop-opacity:0.3"/>
                                            </linearGradient>
                                            <linearGradient id="waveGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:var(--accent-secondary);stop-opacity:0.2"/>
                                                <stop offset="50%" style="stop-color:var(--accent-secondary);stop-opacity:0.8"/>
                                                <stop offset="100%" style="stop-color:var(--accent-secondary);stop-opacity:0.2"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div class="viz-metrics">
                                <div class="metric-card">
                                    <span class="metric-label">Latency</span>
                                    <span class="metric-value"><span class="counter" data-target="287">0</span>ms</span>
                                </div>
                                <div class="metric-card">
                                    <span class="metric-label">Accuracy</span>
                                    <span class="metric-value"><span class="counter" data-target="98">0</span>%</span>
                                </div>
                                <div class="metric-card">
                                    <span class="metric-label">Active</span>
                                    <span class="metric-value status-active">
                                        <span class="status-dot"></span>
                                        Live
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spotlight 2: Multi-Language Intelligence -->
                <div class="spotlight-feature spotlight-reverse" data-spotlight="multilingual">
                    <div class="spotlight-content">
                        <div class="spotlight-badge">Global Reach</div>
                        <h2 class="spotlight-title">Multi-Language Intelligence</h2>
                        <p class="spotlight-desc">
                            Serve customers in their native language without hiring multilingual staff.
                            Our AI seamlessly switches between 50+ languages mid-conversation based on
                            caller preference.
                        </p>
                        <ul class="spotlight-features-list">
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Automatic language detection</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Single phone number for all languages</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Cultural context awareness</span>
                            </li>
                        </ul>
                    </div>
                    <div class="spotlight-visual">
                        <div class="language-viz">
                            <div class="language-globe">
                                <div class="globe-ring globe-ring-1"></div>
                                <div class="globe-ring globe-ring-2"></div>
                                <div class="globe-ring globe-ring-3"></div>
                                <div class="globe-center">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="language-tags">
                                <span class="lang-tag" style="--delay: 0s">English</span>
                                <span class="lang-tag" style="--delay: 0.1s">Español</span>
                                <span class="lang-tag" style="--delay: 0.2s">中文</span>
                                <span class="lang-tag" style="--delay: 0.3s">Français</span>
                                <span class="lang-tag" style="--delay: 0.4s">Deutsch</span>
                                <span class="lang-tag" style="--delay: 0.5s">日本語</span>
                                <span class="lang-tag" style="--delay: 0.6s">العربية</span>
                                <span class="lang-tag" style="--delay: 0.7s">Português</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spotlight 3: Scheduling Assistance -->
                <div class="spotlight-feature" data-spotlight="scheduling">
                    <div class="spotlight-content">
                        <div class="spotlight-badge">Automation</div>
                        <h2 class="spotlight-title">Intelligent Scheduling</h2>
                        <p class="spotlight-desc">
                            Let AI handle the back-and-forth of appointment booking. Our agents check
                            real-time availability, negotiate times, and confirm appointments directly
                            on your calendar while you focus on what matters.
                        </p>
                        <ul class="spotlight-features-list">
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Real-time calendar sync (Google, Outlook, GoHighLevel)</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Smart time negotiation with callers</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Automatic confirmations via SMS & email</span>
                            </li>
                        </ul>
                    </div>
                    <div class="spotlight-visual">
                        <div class="scheduling-viz">
                            <div class="calendar-widget">
                                <div class="calendar-header">
                                    <span class="calendar-month">January 2026</span>
                                    <div class="calendar-nav">
                                        <button aria-label="Previous month">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                                        </button>
                                        <button aria-label="Next month">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="calendar-grid">
                                    <div class="calendar-day">20</div>
                                    <div class="calendar-day has-slots">21</div>
                                    <div class="calendar-day has-slots">22</div>
                                    <div class="calendar-day booked">23</div>
                                    <div class="calendar-day has-slots">24</div>
                                    <div class="calendar-day today">25</div>
                                    <div class="calendar-day">26</div>
                                </div>
                            </div>
                            <div class="scheduling-slots">
                                <div class="slot-row">
                                    <span class="slot-time">9:00 AM</span>
                                    <span class="slot-status">Available</span>
                                    <span class="slot-badge available">Open</span>
                                </div>
                                <div class="slot-row">
                                    <span class="slot-time">10:30 AM</span>
                                    <span class="slot-status">John D. - Consultation</span>
                                    <span class="slot-badge booked">Booked</span>
                                </div>
                                <div class="slot-row">
                                    <span class="slot-time">2:00 PM</span>
                                    <span class="slot-status">Sarah M. - Follow-up</span>
                                    <span class="slot-badge confirmed">Confirmed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spotlight 4: Analytics & Insights -->
                <div class="spotlight-feature spotlight-reverse" data-spotlight="analytics">
                    <div class="spotlight-content">
                        <div class="spotlight-badge">Insights</div>
                        <h2 class="spotlight-title">Analytics & Intelligence</h2>
                        <p class="spotlight-desc">
                            Real-time dashboards with sentiment analysis, call scoring, and automated QA.
                            Every conversation becomes actionable data to improve your operations.
                        </p>
                        <ul class="spotlight-features-list">
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Real-time sentiment tracking</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Automatic call transcription & classification</span>
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Missed conversation tracking</span>
                            </li>
                        </ul>
                    </div>
                    <div class="spotlight-visual">
                        <div class="analytics-viz">
                            <div class="analytics-dashboard">
                                <div class="dash-header">
                                    <span class="dash-title">Call Analytics</span>
                                    <span class="dash-badge">Live</span>
                                </div>
                                <div class="dash-chart">
                                    <div class="chart-bars">
                                        <div class="chart-bar" style="--height: 65%"><span>Mon</span></div>
                                        <div class="chart-bar" style="--height: 85%"><span>Tue</span></div>
                                        <div class="chart-bar" style="--height: 70%"><span>Wed</span></div>
                                        <div class="chart-bar active" style="--height: 95%"><span>Thu</span></div>
                                        <div class="chart-bar" style="--height: 60%"><span>Fri</span></div>
                                    </div>
                                </div>
                                <div class="dash-metrics">
                                    <div class="dash-metric">
                                        <span class="dm-label">Sentiment</span>
                                        <span class="dm-value positive">+92%</span>
                                    </div>
                                    <div class="dash-metric">
                                        <span class="dm-label">Resolution</span>
                                        <span class="dm-value">87%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Feature Grid Section -->
        <section class="feature-grid-section">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-tag">Capabilities</span>
                    <h2 class="section-title">Complete Platform Features</h2>
                    <p class="section-subtitle">
                        Everything you need to deploy, manage, and scale AI voice operations.
                    </p>
                </div>

                <!-- Category Tabs -->
                <div class="feature-categories">
                    <button class="category-tab active" data-category="automation">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                        </svg>
                        <span>Automation</span>
                    </button>
                    <button class="category-tab" data-category="integrations">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 16v1a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2m5.66 0H14a2 2 0 0 1 2 2v3.34l1 1L23 7v10l-6-4"/>
                        </svg>
                        <span>Integrations</span>
                    </button>
                    <button class="category-tab" data-category="compliance">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>Compliance</span>
                    </button>
                    <button class="category-tab" data-category="developer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="16 18 22 12 16 6"/>
                            <polyline points="8 6 2 12 8 18"/>
                        </svg>
                        <span>Developer</span>
                    </button>
                </div>

                <!-- Feature Grids -->
                <div class="feature-grids">

                    <!-- Automation Features -->
                    <div class="feature-grid active" data-category="automation">
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <h3>Smart Scheduling</h3>
                            <p>Direct calendar integration with Google, Outlook, and GoHighLevel. Book appointments automatically.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                            </div>
                            <h3>SMS Notifications</h3>
                            <p>Automated confirmations, reminders, and follow-ups via Twilio SMS integration.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </div>
                            <h3>Email Automation</h3>
                            <p>SendGrid-powered email notifications for call summaries, follow-ups, and alerts.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                                </svg>
                            </div>
                            <h3>Custom Flow Builder</h3>
                            <p>YAML-based conversation flows with conditional logic, branching, and custom actions.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <h3>Warm Transfers</h3>
                            <p>Seamless handoff to human agents with full conversation context and caller history.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                    <line x1="12" y1="19" x2="12" y2="23"/>
                                    <line x1="8" y1="23" x2="16" y2="23"/>
                                </svg>
                            </div>
                            <h3>Call Recording</h3>
                            <p>Automatic call recording with secure storage, transcription, and searchable archives.</p>
                        </div>
                    </div>

                    <!-- Integrations Features -->
                    <div class="feature-grid" data-category="integrations">
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/>
                                </svg>
                            </div>
                            <h3>Twilio</h3>
                            <p>Native telephony integration for inbound/outbound calls, SMS, and call control.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <h3>Google Calendar</h3>
                            <p>Real-time availability checking and direct appointment booking.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <h3>Outlook Calendar</h3>
                            <p>Microsoft 365 integration for enterprise scheduling workflows.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                </svg>
                            </div>
                            <h3>GoHighLevel</h3>
                            <p>Full CRM integration for lead management and marketing automation.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                                </svg>
                            </div>
                            <h3>Webhooks</h3>
                            <p>Real-time event delivery to your systems for custom integrations.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                                </svg>
                            </div>
                            <h3>CRM Sync</h3>
                            <p>Automatic data sync to Salesforce, HubSpot, and custom CRM systems.</p>
                        </div>
                    </div>

                    <!-- Compliance Features -->
                    <div class="feature-grid" data-category="compliance">
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            </div>
                            <h3>TPV Compliance</h3>
                            <p>Built-in third-party verification engine with policy management and audit trails.</p>
                            <a href="<?php echo home_url('/tpv'); ?>" class="feature-link">Learn more</a>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <h3>Data Encryption</h3>
                            <p>AES-256 encryption at rest and TLS 1.3 in transit for all data.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>
                            </div>
                            <h3>Audit Logging</h3>
                            <p>Complete audit trails for all call events, actions, and data access.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <h3>Retention Policies</h3>
                            <p>Configurable data retention with automatic deletion for compliance.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="8.5" cy="7" r="4"/>
                                    <line x1="20" y1="8" x2="20" y2="14"/>
                                    <line x1="23" y1="11" x2="17" y2="11"/>
                                </svg>
                            </div>
                            <h3>Multi-Org Isolation</h3>
                            <p>Complete data separation between organizations with role-based access.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                                </svg>
                            </div>
                            <h3>Consent Management</h3>
                            <p>Capture and track customer consent for recordings and data processing.</p>
                        </div>
                    </div>

                    <!-- Developer Features -->
                    <div class="feature-grid" data-category="developer">
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="16 18 22 12 16 6"/>
                                    <polyline points="8 6 2 12 8 18"/>
                                </svg>
                            </div>
                            <h3>REST API</h3>
                            <p>Full API access for call management, analytics, and configuration.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                                </svg>
                            </div>
                            <h3>WebSocket Streaming</h3>
                            <p>Real-time bidirectional audio streaming at 8kHz and 16kHz.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </div>
                            <h3>Tool Registry</h3>
                            <p>Extensible tool system with JSON schema definitions for custom actions.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                    <line x1="8" y1="21" x2="16" y2="21"/>
                                    <line x1="12" y1="17" x2="12" y2="21"/>
                                </svg>
                            </div>
                            <h3>Browser Demo SDK</h3>
                            <p>Embed voice demos directly in your website with our JavaScript SDK.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                            </div>
                            <h3>YAML Flows</h3>
                            <p>Define conversation flows with YAML configuration files.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-item-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="4" y1="21" x2="4" y2="14"/>
                                    <line x1="4" y1="10" x2="4" y2="3"/>
                                    <line x1="12" y1="21" x2="12" y2="12"/>
                                    <line x1="12" y1="8" x2="12" y2="3"/>
                                    <line x1="20" y1="21" x2="20" y2="16"/>
                                    <line x1="20" y1="12" x2="20" y2="3"/>
                                    <line x1="1" y1="14" x2="7" y2="14"/>
                                    <line x1="9" y1="8" x2="15" y2="8"/>
                                    <line x1="17" y1="16" x2="23" y2="16"/>
                                </svg>
                            </div>
                            <h3>Custom Prompts</h3>
                            <p>Full control over AI behavior with customizable system prompts.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Industry Solutions -->
        <section class="industry-solutions">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-tag">Solutions</span>
                    <h2 class="section-title">Built for Your Industry</h2>
                    <p class="section-subtitle">
                        Pre-configured toolboxes and workflows for high-volume operations.
                    </p>
                </div>

                <div class="industry-cards">
                    <a href="<?php echo home_url('/tpv'); ?>" class="industry-card">
                        <div class="industry-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3>Third-Party Verification</h3>
                        <p>Compliant TPV for energy, telecom, and regulated industries.</p>
                        <span class="industry-link">
                            Learn more
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                    <a href="<?php echo home_url('/fitness'); ?>" class="industry-card">
                        <div class="industry-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/>
                                <line x1="16" y1="8" x2="2" y2="22"/>
                                <line x1="17.5" y1="15" x2="9" y2="15"/>
                            </svg>
                        </div>
                        <h3>Fitness & Wellness</h3>
                        <p>Member inquiries, class bookings, and tour scheduling.</p>
                        <span class="industry-link">
                            Learn more
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                    <a href="<?php echo home_url('/home-services'); ?>" class="industry-card">
                        <div class="industry-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <h3>Home Services</h3>
                        <p>Emergency dispatch, job scheduling, and service coordination.</p>
                        <span class="industry-link">
                            Learn more
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                    <div class="industry-card industry-card-contact">
                        <div class="industry-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/>
                                <path d="M15 7a2 2 0 1 1 2 2"/>
                                <path d="M15 17h.01"/>
                            </svg>
                        </div>
                        <h3>Contact Center</h3>
                        <p>Multi-product support with smart routing and escalation.</p>
                        <span class="industry-link">
                            Coming soon
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Integration Partners -->
        <section class="integrations-section">
            <div class="section-container">
                <div class="integrations-header">
                    <span class="section-tag">Ecosystem</span>
                    <h2 class="section-title">Seamless Integrations</h2>
                    <p class="section-subtitle">
                        Connect with the tools you already use.
                    </p>
                </div>

                <div class="integrations-grid">
                    <!-- Google Calendar - Calendar with colored event dots -->
                    <div class="integration-item">
                        <div class="integration-logo google-calendar">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="6" y="8" width="28" height="26" rx="3" fill="currentColor"/>
                                <rect x="6" y="8" width="28" height="7" rx="3" fill="var(--accent-primary)"/>
                                <rect x="11" y="5" width="3" height="6" rx="1" fill="currentColor"/>
                                <rect x="26" y="5" width="3" height="6" rx="1" fill="currentColor"/>
                                <rect x="11" y="19" width="4" height="4" rx="1" fill="#4285f4"/>
                                <rect x="18" y="19" width="4" height="4" rx="1" fill="#34a853"/>
                                <rect x="25" y="19" width="4" height="4" rx="1" fill="#fbbc05"/>
                                <rect x="11" y="26" width="4" height="4" rx="1" fill="#ea4335"/>
                                <rect x="18" y="26" width="4" height="4" rx="1" fill="#4285f4"/>
                            </svg>
                        </div>
                        <span>Google Calendar</span>
                    </div>
                    <!-- Outlook - Calendar with blue accent -->
                    <div class="integration-item">
                        <div class="integration-logo outlook">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="6" y="8" width="28" height="26" rx="3" fill="currentColor"/>
                                <rect x="6" y="8" width="28" height="7" rx="3" fill="#0078d4"/>
                                <rect x="11" y="5" width="3" height="6" rx="1" fill="currentColor"/>
                                <rect x="26" y="5" width="3" height="6" rx="1" fill="currentColor"/>
                                <path d="M14 22l6 4 6-4v8H14v-8z" fill="#0078d4" opacity="0.7"/>
                                <path d="M14 22l6-3 6 3-6 4-6-4z" fill="#0078d4"/>
                            </svg>
                        </div>
                        <span>Outlook</span>
                    </div>
                    <!-- Twilio - Red circle with dots pattern -->
                    <div class="integration-item">
                        <div class="integration-logo twilio">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="15" fill="#f22f46"/>
                                <circle cx="14" cy="14" r="3" fill="white"/>
                                <circle cx="26" cy="14" r="3" fill="white"/>
                                <circle cx="14" cy="26" r="3" fill="white"/>
                                <circle cx="26" cy="26" r="3" fill="white"/>
                            </svg>
                        </div>
                        <span>Twilio</span>
                    </div>
                    <!-- SendGrid - Paper airplane -->
                    <div class="integration-item">
                        <div class="integration-logo sendgrid">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M6 20l28-12-8 12 8 12L6 20z" fill="#1a82e2"/>
                                <path d="M6 20l20 0-8-12L6 20z" fill="#1a82e2" opacity="0.7"/>
                                <path d="M26 20l-8 12 8-12z" fill="#1a82e2" opacity="0.5"/>
                            </svg>
                        </div>
                        <span>SendGrid</span>
                    </div>
                    <!-- Salesforce - Cloud shape -->
                    <div class="integration-item">
                        <div class="integration-logo salesforce">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M16.5 12c-2.5 0-4.5 1.8-5 4.2-2.8.5-5 3-5 6 0 3.3 2.7 6 6 6h18c2.8 0 5-2.2 5-5 0-2.5-1.8-4.5-4.2-4.9-.3-3.9-3.5-7-7.5-7-1.8 0-3.5.7-4.8 1.8-.8-.7-1.9-1.1-3-1.1z" fill="#00a1e0"/>
                            </svg>
                        </div>
                        <span>Salesforce</span>
                    </div>
                    <!-- HubSpot - Sprocket gear -->
                    <div class="integration-item">
                        <div class="integration-logo hubspot">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="5" fill="#ff7a59"/>
                                <circle cx="20" cy="20" r="2" fill="var(--bg-primary)"/>
                                <rect x="18" y="6" width="4" height="6" rx="1" fill="#ff7a59"/>
                                <rect x="18" y="28" width="4" height="6" rx="1" fill="#ff7a59"/>
                                <rect x="6" y="18" width="6" height="4" rx="1" fill="#ff7a59"/>
                                <rect x="28" y="18" width="6" height="4" rx="1" fill="#ff7a59"/>
                                <rect x="8.5" y="8.5" width="4" height="5" rx="1" fill="#ff7a59" transform="rotate(45 10.5 11)"/>
                                <rect x="26.5" y="8.5" width="4" height="5" rx="1" fill="#ff7a59" transform="rotate(-45 28.5 11)"/>
                                <rect x="8.5" y="26.5" width="4" height="5" rx="1" fill="#ff7a59" transform="rotate(-45 10.5 29)"/>
                                <rect x="26.5" y="26.5" width="4" height="5" rx="1" fill="#ff7a59" transform="rotate(45 28.5 29)"/>
                            </svg>
                        </div>
                        <span>HubSpot</span>
                    </div>
                    <!-- GoHighLevel - Growth chart arrow -->
                    <div class="integration-item">
                        <div class="integration-logo gohighlevel">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="6" y="28" width="6" height="6" rx="1" fill="#1dc9a0"/>
                                <rect x="14" y="22" width="6" height="12" rx="1" fill="#1dc9a0"/>
                                <rect x="22" y="16" width="6" height="18" rx="1" fill="#1dc9a0"/>
                                <path d="M28 12l6-4v8l-6-4z" fill="#1dc9a0"/>
                                <path d="M10 24l8-6 8-6" stroke="#1dc9a0" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span>GoHighLevel</span>
                    </div>
                    <!-- Custom APIs - Code brackets -->
                    <div class="integration-item">
                        <div class="integration-logo custom-api">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M14 10l-8 10 8 10" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M26 10l8 10-8 10" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23 6l-6 28" stroke="var(--accent-primary)" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span>Custom APIs</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Automatdo -->
        <section class="why-section">
            <div class="section-container">
                <div class="why-grid">
                    <div class="why-content">
                        <span class="section-tag">Why Automatdo</span>
                        <h2 class="section-title">Built Different</h2>
                        <p class="why-desc">
                            We're not another chatbot company adding voice. We built voice-first from day one,
                            designed for the complex, high-stakes conversations your business depends on.
                        </p>
                    </div>
                    <div class="why-points">
                        <div class="why-point">
                            <div class="why-point-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                                </svg>
                            </div>
                            <div class="why-point-content">
                                <h3>Real-Time, Not Batch</h3>
                                <p>Sub-300ms responses. No awkward pauses or "processing" delays.</p>
                            </div>
                        </div>
                        <div class="why-point">
                            <div class="why-point-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                                </svg>
                            </div>
                            <div class="why-point-content">
                                <h3>Industry-Specific</h3>
                                <p>Pre-built toolboxes that understand your domain's terminology and workflows.</p>
                            </div>
                        </div>
                        <div class="why-point">
                            <div class="why-point-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            </div>
                            <div class="why-point-content">
                                <h3>Compliance Built In</h3>
                                <p>TPV, HIPAA, PCI-DSS compliance from architecture, not afterthought.</p>
                            </div>
                        </div>
                        <div class="why-point">
                            <div class="why-point-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div class="why-point-content">
                                <h3>Human Backup</h3>
                                <p>Seamless escalation to your team when AI reaches its limits.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="features-cta">
            <div class="section-container">
                <div class="cta-card features-cta-card">
                    <div class="cta-content">
                        <h2 class="cta-title">Ready to scale your voice operations?</h2>
                        <p class="cta-subtitle">
                            See how Automatdo can handle your calls with a personalized demo.
                        </p>
                    </div>
                    <div class="cta-actions">
                        <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary btn-large">
                            <span>Book a Demo</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="<?php echo home_url('/contact'); ?>" class="btn-secondary btn-large">Contact Sales</a>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php
get_footer();
?>
