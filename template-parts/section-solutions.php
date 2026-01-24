<?php
/**
 * Template part for Solutions section
 *
 * @package Automatdo
 */
?>

<section class="solutions" id="solutions">
    <div class="section-container">
        <div class="section-header">
            <span class="section-tag">Solutions</span>
            <h2 class="section-title">Built for your industry</h2>
            <p class="section-subtitle">
                Specialized AI agents tailored to your specific workflows and compliance requirements.
            </p>
        </div>

        <div class="solutions-tabs">
            <button class="solution-tab active" data-tab="tpv">
                <span class="tab-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                <span>Third-Party Verification</span>
            </button>
            <button class="solution-tab" data-tab="fitness">
                <span class="tab-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M6.5 6.5v11M17.5 6.5v11M6.5 12h11M3.5 8.5v7M20.5 8.5v7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span>Fitness & Wellness</span>
            </button>
            <button class="solution-tab" data-tab="home">
                <span class="tab-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 21V9l9-6 9 6v12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21v-6h6v6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                <span>Home Services</span>
            </button>
            <button class="solution-tab" data-tab="contact">
                <span class="tab-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                <span>Contact Centers</span>
            </button>
        </div>

        <div class="solutions-content">
            <!-- TPV Panel -->
            <div class="solution-panel active" id="panel-tpv">
                <div class="solution-info">
                    <h3>Third-Party Verification</h3>
                    <p>
                        Fully automated TPV calls for energy enrollment, telecom activations,
                        and financial authorizations. Our AI agents follow your exact script,
                        capture required confirmations, and provide complete audit trails.
                    </p>
                    <ul class="solution-features">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Regulatory compliant recording</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Customizable verification flows</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Real-time outcome dashboards</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Webhook integration for CRM sync</span>
                        </li>
                    </ul>
                    <a href="/solutions/tpv" class="btn-primary">Get Started with TPV</a>
                </div>
                <div class="solution-visual">
                    <div class="tpv-mockup">
                        <div class="tpv-header">
                            <span class="tpv-status verified">Verified</span>
                            <span class="tpv-id">Order #ENR-2024-8847</span>
                        </div>
                        <div class="tpv-questions">
                            <div class="tpv-question answered">
                                <span class="q-number">1</span>
                                <span class="q-text">Customer confirmed name</span>
                                <span class="q-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="tpv-question answered">
                                <span class="q-number">2</span>
                                <span class="q-text">Service address verified</span>
                                <span class="q-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="tpv-question answered">
                                <span class="q-number">3</span>
                                <span class="q-text">Rate plan acknowledged</span>
                                <span class="q-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="tpv-question answered">
                                <span class="q-number">4</span>
                                <span class="q-text">Authorization confirmed</span>
                                <span class="q-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fitness Panel -->
            <div class="solution-panel" id="panel-fitness">
                <div class="solution-info">
                    <h3>Fitness & Wellness</h3>
                    <p>
                        Handle membership inquiries, class bookings, and tour scheduling
                        automatically. Our AI agents know your class schedules, membership
                        tiers, and can answer common questions 24/7.
                    </p>
                    <ul class="solution-features">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Class schedule integration</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Membership inquiry handling</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Tour booking automation</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>After-hours message taking</span>
                        </li>
                    </ul>
                    <a href="/solutions/fitness" class="btn-primary">Explore Fitness Solutions</a>
                </div>
                <div class="solution-visual">
                    <div class="fitness-mockup">
                        <div class="gym-card">
                            <div class="gym-header">New Tour Scheduled</div>
                            <div class="gym-details">
                                <div class="detail-row">
                                    <span class="detail-label">Name</span>
                                    <span class="detail-value">Sarah Johnson</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Time</span>
                                    <span class="detail-value">Tomorrow, 2:00 PM</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Interest</span>
                                    <span class="detail-value">Premium Membership</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Home Services Panel -->
            <div class="solution-panel" id="panel-home">
                <div class="solution-info">
                    <h3>Home Services</h3>
                    <p>
                        Capture service requests, qualify leads, and dispatch technicians.
                        Our agents understand HVAC, plumbing, and electrical terminology
                        and can handle emergency prioritization.
                    </p>
                    <ul class="solution-features">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Emergency call prioritization</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Job detail capture</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Dispatch window scheduling</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>CRM integration</span>
                        </li>
                    </ul>
                    <a href="/solutions/home-services" class="btn-primary">Learn More</a>
                </div>
                <div class="solution-visual">
                    <div class="home-mockup">
                        <div class="job-card">
                            <div class="job-priority emergency">Emergency</div>
                            <div class="job-type">HVAC - No Heat</div>
                            <div class="job-info">
                                <span>123 Main St</span>
                                <span>Dispatch: Today 4-6 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Centers Panel -->
            <div class="solution-panel" id="panel-contact">
                <div class="solution-info">
                    <h3>Contact Centers</h3>
                    <p>
                        Scale your support team without scaling costs. Our AI agents handle
                        tier-1 inquiries, qualify leads, and seamlessly transfer to humans
                        when needed.
                    </p>
                    <ul class="solution-features">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Intelligent call routing</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Real-time QA scoring</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Sentiment analysis</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Performance dashboards</span>
                        </li>
                    </ul>
                    <a href="#demo" class="btn-primary">See Contact Center Demo</a>
                </div>
                <div class="solution-visual">
                    <div class="contact-mockup">
                        <div class="metrics-row">
                            <div class="metric">
                                <span class="metric-value">847</span>
                                <span class="metric-label">Calls Today</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">94%</span>
                                <span class="metric-label">AI Resolved</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">4.8</span>
                                <span class="metric-label">Avg Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
