<?php
/**
 * Template Name: Solutions Page
 * Description: Comprehensive solutions showcase with industry-specific voice demos
 *
 * @package Automatdo
 */

get_header();
?>

<main id="main-content" class="solutions-page">

    <!-- Hero Section -->
    <section class="solutions-hero">
        <div class="section-container">
            <div class="solutions-hero-content">
                <span class="section-tag">Complete Voice AI Platform</span>
                <h1 class="solutions-hero-title">
                    <span class="title-line">From Voice to Value</span>
                    <span class="title-line title-gradient">Complete Business Solutions</span>
                </h1>
                <p class="solutions-hero-subtitle">
                    Transform your customer interactions with an integrated voice AI ecosystem. 
                    Handle calls, manage relationships, and scale operations—all in one platform.
                </p>
                <div class="solutions-hero-cta">
                    <a href="#solutions-grid" class="btn-primary btn-large">
                        <span>Explore Solutions</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#demo" class="btn-secondary btn-large">
                        <span>Book a Demo</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Hero Visual - Solutions Hub -->
        <div class="solutions-hero-visual">
            <div class="solutions-hub">
                <div class="hub-row hub-top">
                    <div class="hub-node">
                        <span class="hub-icon">🎙️</span>
                        <span class="hub-label">Voice Agents</span>
                    </div>
                </div>
                <div class="hub-row hub-middle">
                    <div class="hub-node">
                        <span class="hub-icon">🧠</span>
                        <span class="hub-label">CRM</span>
                    </div>
                    <div class="hub-center">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 32c0-4.4 3.6-8 8-8s8 3.6 8 8-3.6 8-8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M32 20v8M32 36v8M20 32h8M36 32h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span class="hub-center-label">Automatdo</span>
                    </div>
                    <div class="hub-node">
                        <span class="hub-icon">📞</span>
                        <span class="hub-label">Campaigns</span>
                    </div>
                </div>
                <div class="hub-row hub-bottom">
                    <div class="hub-node">
                        <span class="hub-icon">✅</span>
                        <span class="hub-label">Compliance</span>
                    </div>
                    <div class="hub-node">
                        <span class="hub-icon">📢</span>
                        <span class="hub-label">Marketing</span>
                    </div>
                    <div class="hub-node">
                        <span class="hub-icon">🔗</span>
                        <span class="hub-label">Integrations</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Grid -->
    <section class="solutions-grid-section" id="solutions-grid">
        <div class="section-container">
            <div class="section-header">
                <span class="section-tag">Solutions</span>
                <h2 class="section-title">Everything You Need to Scale</h2>
                <p class="section-subtitle">
                    Six integrated solutions that work together to transform your customer experience.
                </p>
            </div>

            <div class="solutions-grid">
                <!-- Solution 1: Realtime Voice Agents -->
                <div class="solution-card" data-solution="voice-agents">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16 4C9.373 4 4 9.373 4 16s5.373 12 12 12 12-5.373 12-12S22.627 4 16 4z" stroke="currentColor" stroke-width="2"/>
                                <path d="M13 12l6 4-6 4V12z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="solution-number">01</span>
                    </div>
                    <h3 class="solution-title">Realtime Voice Agents</h3>
                    <p class="solution-desc">
                        Handle customer calls 24/7 with AI agents that sound human, understand context, and resolve issues without wait times.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Sub-300ms response time</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Natural interruption handling</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>50+ languages supported</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="voice-agent-mockup">
                            <div class="mockup-header">
                                <span class="mockup-status active">● Live Call</span>
                                <span class="mockup-time">2:34</span>
                            </div>
                            <div class="mockup-transcript">
                                <div class="transcript-bubble agent">
                                    <span class="bubble-speaker">AI Agent</span>
                                    <span class="bubble-text">I can help you schedule that appointment for tomorrow afternoon.</span>
                                </div>
                                <div class="transcript-bubble customer">
                                    <span class="bubble-speaker">Customer</span>
                                    <span class="bubble-text">Great, 2 PM works for me.</span>
                                </div>
                            </div>
                            <div class="mockup-waveform">
                                <div class="waveform-bar" style="--height: 30%"></div>
                                <div class="waveform-bar" style="--height: 60%"></div>
                                <div class="waveform-bar" style="--height: 45%"></div>
                                <div class="waveform-bar" style="--height: 80%"></div>
                                <div class="waveform-bar" style="--height: 55%"></div>
                                <div class="waveform-bar" style="--height: 90%"></div>
                                <div class="waveform-bar" style="--height: 40%"></div>
                                <div class="waveform-bar" style="--height: 70%"></div>
                            </div>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="contact-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>

                <!-- Solution 2: Intelligent CRM -->
                <div class="solution-card" data-solution="crm">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16 2L2 9l14 7 14-7-14-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 23l14 7 14-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 16l14 7 14-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="solution-number">02</span>
                    </div>
                    <h3 class="solution-title">Intelligent CRM</h3>
                    <p class="solution-desc">
                        Every call automatically builds rich customer profiles. Your agents remember every conversation and make smarter decisions.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Automatic call transcription</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Conversation history tracking</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Predictive customer insights</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="crm-mockup">
                            <div class="crm-profile">
                                <div class="crm-avatar">JD</div>
                                <div class="crm-info">
                                    <span class="crm-name">John Davis</span>
                                    <span class="crm-meta">Premium Member • 12 calls</span>
                                </div>
                            </div>
                            <div class="crm-timeline">
                                <div class="timeline-item">
                                    <span class="timeline-date">Today</span>
                                    <span class="timeline-event">Scheduled HVAC maintenance</span>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-date">Jan 15</span>
                                    <span class="timeline-event">Asked about upgrade options</span>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-date">Jan 8</span>
                                    <span class="timeline-event">Emergency repair request</span>
                                </div>
                            </div>
                            <div class="crm-tags">
                                <span class="crm-tag">VIP</span>
                                <span class="crm-tag">HVAC</span>
                                <span class="crm-tag">Maintenance</span>
                            </div>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="home-services">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>

                <!-- Solution 3: Campaign Management -->
                <div class="solution-card" data-solution="campaigns">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M22 8l-8 8-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12" stroke="currentColor" stroke-width="2"/>
                                <circle cx="24" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <span class="solution-number">03</span>
                    </div>
                    <h3 class="solution-title">Campaign Management</h3>
                    <p class="solution-desc">
                        Automate inbound and outbound call campaigns at scale. Handle thousands of calls simultaneously without adding headcount.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Unlimited concurrent calls</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Smart scheduling & routing</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Real-time campaign analytics</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="campaign-mockup">
                            <div class="campaign-header">
                                <span class="campaign-title">Spring Outreach</span>
                                <span class="campaign-status active">Running</span>
                            </div>
                            <div class="campaign-stats">
                                <div class="c-stat">
                                    <span class="c-stat-value">1,247</span>
                                    <span class="c-stat-label">Calls Today</span>
                                </div>
                                <div class="c-stat">
                                    <span class="c-stat-value">89%</span>
                                    <span class="c-stat-label">Answer Rate</span>
                                </div>
                                <div class="c-stat">
                                    <span class="c-stat-value">342</span>
                                    <span class="c-stat-label">Conversions</span>
                                </div>
                            </div>
                            <div class="campaign-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 67%"></div>
                                </div>
                                <span class="progress-text">67% Complete</span>
                            </div>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="contact-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>

                <!-- Solution 4: Compliance & Scoring -->
                <div class="solution-card" data-solution="compliance">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="solution-number">04</span>
                    </div>
                    <h3 class="solution-title">Compliance & Scoring</h3>
                    <p class="solution-desc">
                        Built-in quality assurance and regulatory compliance. Automatic call scoring, sentiment analysis, and complete audit trails.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>TPV & regulatory compliance</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Automated QA scoring</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Complete audit trails</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="compliance-mockup">
                            <div class="compliance-header">
                                <span class="compliance-title">Call Quality Score</span>
                                <span class="compliance-score">94/100</span>
                            </div>
                            <div class="compliance-checks">
                                <div class="check-item passed">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Identity verified</span>
                                </div>
                                <div class="check-item passed">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Consent recorded</span>
                                </div>
                                <div class="check-item passed">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Terms acknowledged</span>
                                </div>
                                <div class="check-item passed">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Authorization confirmed</span>
                                </div>
                            </div>
                            <div class="compliance-recording">
                                <span class="recording-indicator">●</span>
                                <span>Recording stored securely</span>
                            </div>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="tpv">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>

                <!-- Solution 5: Outbound Marketing -->
                <div class="solution-card" data-solution="marketing">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M28 16l-8-8v5H4v6h16v5l8-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="24" cy="8" r="3" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <span class="solution-number">05</span>
                    </div>
                    <h3 class="solution-title">Outbound Marketing</h3>
                    <p class="solution-desc">
                        Proactive voice and SMS campaigns that match what customers previously called about. Turn one-time callers into loyal customers.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Voice + SMS campaigns</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Behavior-based targeting</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Automated follow-up sequences</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="marketing-mockup">
                            <div class="marketing-message">
                                <div class="message-header">
                                    <span class="message-type">SMS</span>
                                    <span class="message-time">Just now</span>
                                </div>
                                <div class="message-content">
                                    Hi Sarah! You asked about our premium membership last week. 
                                    We have a special offer ending tomorrow. Want me to schedule 
                                    a quick call to discuss?
                                </div>
                            </div>
                            <div class="marketing-reply">
                                <span class="reply-text">Yes, tomorrow at 2pm works!</span>
                            </div>
                            <div class="marketing-automation">
                                <span class="automation-badge">✓ Auto-scheduled</span>
                            </div>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="fitness">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>

                <!-- Solution 6: CRM Integration -->
                <div class="solution-card" data-solution="integration">
                    <div class="solution-card-header">
                        <div class="solution-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M8 12h16M8 16h16M8 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <rect x="4" y="4" width="24" height="24" rx="2" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <span class="solution-number">06</span>
                    </div>
                    <h3 class="solution-title">CRM Integration</h3>
                    <p class="solution-desc">
                        Seamlessly connect with your existing tools. Sync with Salesforce, HubSpot, GoHighLevel, and custom CRMs in real-time.
                    </p>
                    <ul class="solution-benefits">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Real-time bidirectional sync</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Native calendar integration</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Custom webhook support</span>
                        </li>
                    </ul>
                    <div class="solution-visual">
                        <div class="integration-mockup">
                            <div class="integration-center">
                                <div class="center-icon">⚡</div>
                                <span class="center-label">Automatdo</span>
                            </div>
                            <div class="integration-connections">
                                <div class="integration-item">
                                    <span class="int-logo">📅</span>
                                    <span class="int-name">Google Calendar</span>
                                </div>
                                <div class="integration-item">
                                    <span class="int-logo">📧</span>
                                    <span class="int-name">Salesforce</span>
                                </div>
                                <div class="integration-item">
                                    <span class="int-logo">📊</span>
                                    <span class="int-name">HubSpot</span>
                                </div>
                                <div class="integration-item">
                                    <span class="int-logo">📱</span>
                                    <span class="int-name">Twilio</span>
                                </div>
                            </div>
                            <svg class="integration-lines" viewBox="0 0 300 200">
                                <line x1="150" y1="100" x2="80" y2="40"/>
                                <line x1="150" y1="100" x2="220" y2="40"/>
                                <line x1="150" y1="100" x2="80" y2="160"/>
                                <line x1="150" y1="100" x2="220" y2="160"/>
                            </svg>
                        </div>
                    </div>
                    <button class="solution-demo-btn" data-agent="contact-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                        <span>Try Live Demo</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="section-container">
            <div class="section-header">
                <span class="section-tag">How It Works</span>
                <h2 class="section-title">From First Call to Loyal Customer</h2>
                <p class="section-subtitle">
                    See how all six solutions work together to create seamless customer experiences.
                </p>
            </div>

            <div class="workflow-steps">
                <div class="workflow-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Customer Calls</h3>
                        <p>Voice Agent answers instantly, 24/7, in their preferred language</p>
                    </div>
                    <div class="step-visual">
                        <div class="step-icon">📞</div>
                    </div>
                </div>

                <div class="workflow-connector"></div>

                <div class="workflow-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>CRM Enriches</h3>
                        <p>Agent instantly sees customer history and personalizes the conversation</p>
                    </div>
                    <div class="step-visual">
                        <div class="step-icon">🧠</div>
                    </div>
                </div>

                <div class="workflow-connector"></div>

                <div class="workflow-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Issue Resolved</h3>
                        <p>Agent books appointments, answers questions, or escalates intelligently</p>
                    </div>
                    <div class="step-visual">
                        <div class="step-icon">✅</div>
                    </div>
                </div>

                <div class="workflow-connector"></div>

                <div class="workflow-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Smart Follow-up</h3>
                        <p>Automated campaigns nurture relationships and drive repeat business</p>
                    </div>
                    <div class="step-visual">
                        <div class="step-icon">🔄</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="solutions-stats-banner">
        <div class="section-container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-value">10,000+</span>
                    <span class="stat-label">Calls Automated</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">94%</span>
                    <span class="stat-label">Customer Satisfaction</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">50+</span>
                    <span class="stat-label">Languages Supported</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">24/7</span>
                    <span class="stat-label">Always Available</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <?php get_template_part('template-parts/section', 'cta'); ?>

</main>

<?php get_footer(); ?>