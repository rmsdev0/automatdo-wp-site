<?php
/**
 * Template Name: Solutions Page
 * Description: Interactive demo experience showcasing the full Automatdo platform
 *
 * @package Automatdo
 */

get_header();
?>

<main id="main-content" class="solutions-page solutions-demo-experience">

    <!-- Compact Hero -->
    <section class="solutions-hero-compact">
        <div class="section-container">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                <span>Interactive Platform Demo</span>
            </div>
            <h1 class="hero-title">
                <span class="title-line">Experience the</span>
                <span class="title-line title-accent">Complete Platform</span>
            </h1>
            <p class="hero-subtitle">
                Explore our CRM, voice agents, compliance tools, and more.
                Try everything before you commit.
            </p>
        </div>
        <div class="hero-glow"></div>
    </section>

    <!-- Tab Navigation -->
    <nav class="solutions-tabs" id="solutions-tabs">
        <div class="tabs-container">
            <div class="tabs-track">
                <button class="tab-btn active" data-tab="crm" data-step="1">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    <span class="tab-label">CRM Demo</span>
                    <span class="tab-number">01</span>
                </button>
                <button class="tab-btn" data-tab="voice" data-step="2">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                        </svg>
                    </span>
                    <span class="tab-label">Voice Demo</span>
                    <span class="tab-number">02</span>
                </button>
                <button class="tab-btn" data-tab="compliance" data-step="3">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </span>
                    <span class="tab-label">Compliance</span>
                    <span class="tab-number">03</span>
                </button>
                <button class="tab-btn" data-tab="sms" data-step="4">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </span>
                    <span class="tab-label">SMS Flow</span>
                    <span class="tab-number">04</span>
                </button>
                <button class="tab-btn" data-tab="campaigns" data-step="5">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </span>
                    <span class="tab-label">Campaigns</span>
                    <span class="tab-number">05</span>
                </button>
            </div>
            <div class="tabs-indicator"></div>
        </div>
    </nav>

    <!-- Tab Panels Container -->
    <div class="solutions-panels" id="solutions-panels">

        <!-- Panel 1: CRM Demo -->
        <section class="solutions-panel active" id="panel-crm" data-panel="crm">
            <div class="panel-container">
                <div class="panel-header">
                    <div class="panel-info">
                        <h2 class="panel-title">Customer Data Setup</h2>
                        <p class="panel-desc">Configure the demo customer profile. The voice agent will reference this data during your call.</p>
                    </div>
                    <div class="panel-cta">
                        <span class="cta-hint">Ready to hear your data in action?</span>
                        <a href="#demo" class="btn-contextual">Talk to Sales</a>
                    </div>
                </div>

                <!-- Industry Selector -->
                <div class="industry-selector">
                    <span class="selector-label">Select Industry</span>
                    <div class="industry-tabs">
                        <button class="industry-tab active" data-industry="tpv">
                            <span class="ind-icon">⚡</span>
                            <span class="ind-name">Energy TPV</span>
                        </button>
                        <button class="industry-tab" data-industry="fitness">
                            <span class="ind-icon">💪</span>
                            <span class="ind-name">Fitness</span>
                        </button>
                        <button class="industry-tab" data-industry="home-services">
                            <span class="ind-icon">🏠</span>
                            <span class="ind-name">Home Services</span>
                        </button>
                        <button class="industry-tab" data-industry="contact-center">
                            <span class="ind-icon">🎧</span>
                            <span class="ind-name">Contact Center</span>
                        </button>
                    </div>
                </div>

                <!-- CRM Card -->
                <div class="crm-demo-card">
                    <div class="crm-card-inner">
                        <!-- Customer Profile Section -->
                        <div class="crm-section crm-profile">
                            <div class="crm-avatar" id="crm-avatar">
                                <span class="avatar-initials">MR</span>
                            </div>
                            <div class="crm-primary-fields">
                                <div class="field-group field-name">
                                    <label class="field-label">Customer Name</label>
                                    <div class="field-row">
                                        <input type="text" class="field-input" id="crm-firstName" value="Maria" placeholder="First Name">
                                        <input type="text" class="field-input" id="crm-lastName" value="Rodriguez" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Phone Number</label>
                                    <input type="tel" class="field-input" id="crm-phone" value="(512) 555-0147" placeholder="Phone">
                                    <span class="field-hint">Demo number - agent will reference this</span>
                                </div>
                            </div>
                        </div>

                        <!-- Industry-specific Fields -->
                        <div class="crm-section crm-details">
                            <h3 class="section-label">Account Details</h3>
                            <div class="details-grid" id="crm-details-grid">
                                <!-- Populated by JS based on industry -->
                            </div>
                        </div>

                        <!-- Interaction History -->
                        <div class="crm-section crm-history">
                            <h3 class="section-label">Recent Interactions</h3>
                            <div class="history-timeline" id="crm-history">
                                <!-- Populated by JS -->
                            </div>
                        </div>

                        <!-- SMS Toggle -->
                        <div class="crm-section crm-sms-toggle">
                            <div class="toggle-card">
                                <div class="toggle-info">
                                    <span class="toggle-icon">📱</span>
                                    <div class="toggle-text">
                                        <span class="toggle-title">Enable Real SMS</span>
                                        <span class="toggle-desc">Receive actual SMS confirmations during the demo</span>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="sms-toggle">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="real-phone-input" id="real-phone-container" style="display: none;">
                                <label class="field-label">Your Phone Number</label>
                                <input type="tel" class="field-input" id="crm-realPhone" placeholder="Enter your real phone number">
                                <span class="field-hint">We'll send you real SMS messages during the demo</span>
                            </div>
                        </div>
                    </div>

                    <!-- Start Demo Button -->
                    <div class="crm-actions">
                        <button class="btn-start-demo" id="btn-start-voice-demo">
                            <span class="btn-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="5 3 19 12 5 21 5 3"/>
                                </svg>
                            </span>
                            <span class="btn-text">Start Demo Call</span>
                            <span class="btn-arrow">→</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Panel 2: Voice Demo -->
        <section class="solutions-panel" id="panel-voice" data-panel="voice">
            <div class="panel-container">
                <div class="panel-header">
                    <div class="panel-info">
                        <h2 class="panel-title">Live Voice Demo</h2>
                        <p class="panel-desc">Experience a real AI voice conversation. The agent knows your customer data.</p>
                    </div>
                    <div class="panel-cta">
                        <span class="cta-hint">Want this for your calls?</span>
                        <a href="#demo" class="btn-contextual">Get Started</a>
                    </div>
                </div>

                <!-- Customer Context Bar -->
                <div class="voice-context-bar" id="voice-context-bar">
                    <div class="context-customer">
                        <span class="context-avatar" id="voice-avatar">MR</span>
                        <div class="context-info">
                            <span class="context-name" id="voice-customer-name">Maria Rodriguez</span>
                            <span class="context-meta" id="voice-customer-meta">TPV Verification • ENR-2024-9847</span>
                        </div>
                    </div>
                    <button class="context-edit" id="btn-edit-crm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        <span>Edit Data</span>
                    </button>
                </div>

                <!-- Voice Demo Widget Area -->
                <div class="voice-demo-area">
                    <div class="voice-demo-widget" id="voice-demo-widget">
                        <!-- Provider Toggle -->
                        <div class="voice-providers">
                            <button class="provider-btn active" data-provider="openai">
                                <span class="provider-name">OpenAI</span>
                                <span class="provider-model">GPT-4o Realtime</span>
                            </button>
                            <button class="provider-btn" data-provider="xai">
                                <span class="provider-name">xAI</span>
                                <span class="provider-model">Grok Voice</span>
                            </button>
                        </div>

                        <!-- Visualizer -->
                        <div class="voice-visualizer" id="voice-visualizer">
                            <div class="visualizer-orb">
                                <div class="orb-ring orb-ring-1"></div>
                                <div class="orb-ring orb-ring-2"></div>
                                <div class="orb-ring orb-ring-3"></div>
                                <div class="orb-core"></div>
                            </div>
                            <div class="visualizer-bars">
                                <!-- Generated by JS -->
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="voice-status" id="voice-status">
                            <span class="status-text">Ready to connect</span>
                        </div>

                        <!-- Transcript -->
                        <div class="voice-transcript" id="voice-transcript">
                            <div class="transcript-placeholder">
                                <span>Conversation will appear here...</span>
                            </div>
                        </div>

                        <!-- Controls -->
                        <div class="voice-controls">
                            <button class="voice-btn voice-btn-start" id="voice-btn-start">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                </svg>
                                <span>Start Conversation</span>
                            </button>
                            <div class="voice-active-controls" style="display: none;">
                                <button class="voice-btn voice-btn-mute" id="voice-btn-mute">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                    </svg>
                                </button>
                                <button class="voice-btn voice-btn-end" id="voice-btn-end">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                    <span>End Call</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post-Call Prompt (hidden initially) -->
                <div class="post-call-prompt" id="post-call-prompt" style="display: none;">
                    <div class="prompt-content">
                        <div class="prompt-icon">✓</div>
                        <h3 class="prompt-title">Call Completed</h3>
                        <p class="prompt-text">See how compliance scoring and SMS confirmation work.</p>
                        <button class="btn-view-compliance" id="btn-view-compliance">
                            View Compliance Report
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Panel 3: Compliance -->
        <section class="solutions-panel" id="panel-compliance" data-panel="compliance">
            <div class="panel-container">
                <div class="panel-header">
                    <div class="panel-info">
                        <h2 class="panel-title">Compliance Dashboard</h2>
                        <p class="panel-desc">Every call is automatically scored for quality and regulatory compliance.</p>
                    </div>
                    <div class="panel-cta">
                        <span class="cta-hint">Need compliance automation?</span>
                        <a href="#demo" class="btn-contextual">Learn More</a>
                    </div>
                </div>

                <div class="compliance-dashboard">
                    <!-- Score Card -->
                    <div class="compliance-score-card">
                        <div class="score-ring">
                            <svg viewBox="0 0 120 120">
                                <circle class="score-bg" cx="60" cy="60" r="54"/>
                                <circle class="score-fill" cx="60" cy="60" r="54" id="compliance-score-ring"/>
                            </svg>
                            <div class="score-value">
                                <span class="score-number" id="compliance-score">96</span>
                                <span class="score-label">Score</span>
                            </div>
                        </div>
                        <div class="score-status">
                            <span class="status-badge passed">PASSED</span>
                            <span class="status-text">All requirements met</span>
                        </div>
                    </div>

                    <!-- Checkpoints -->
                    <div class="compliance-checkpoints">
                        <h3 class="section-label">Verification Checkpoints</h3>
                        <div class="checkpoints-list">
                            <div class="checkpoint completed" data-checkpoint="identity">
                                <div class="checkpoint-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </div>
                                <div class="checkpoint-info">
                                    <span class="checkpoint-name">Identity Verification</span>
                                    <span class="checkpoint-detail">Customer confirmed: Maria Rodriguez</span>
                                </div>
                                <span class="checkpoint-time">0:12</span>
                            </div>
                            <div class="checkpoint completed" data-checkpoint="recording">
                                <div class="checkpoint-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </div>
                                <div class="checkpoint-info">
                                    <span class="checkpoint-name">Recording Disclosure</span>
                                    <span class="checkpoint-detail">Acknowledged at timestamp</span>
                                </div>
                                <span class="checkpoint-time">0:18</span>
                            </div>
                            <div class="checkpoint completed" data-checkpoint="terms">
                                <div class="checkpoint-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </div>
                                <div class="checkpoint-info">
                                    <span class="checkpoint-name">Service Terms Confirmed</span>
                                    <span class="checkpoint-detail">12-Month Fixed Rate @ 8.5¢/kWh</span>
                                </div>
                                <span class="checkpoint-time">1:34</span>
                            </div>
                            <div class="checkpoint completed" data-checkpoint="authorization">
                                <div class="checkpoint-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </div>
                                <div class="checkpoint-info">
                                    <span class="checkpoint-name">Final Authorization</span>
                                    <span class="checkpoint-detail">Verbal consent recorded</span>
                                </div>
                                <span class="checkpoint-time">2:08</span>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Trail -->
                    <div class="compliance-audit">
                        <div class="audit-header">
                            <h3 class="section-label">Audit Trail</h3>
                            <button class="btn-export" id="btn-export-report">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="7 10 12 15 17 10"/>
                                    <line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>
                                Export Report
                            </button>
                        </div>
                        <div class="audit-meta">
                            <div class="meta-item">
                                <span class="meta-label">Call ID</span>
                                <span class="meta-value">TPV-2025-0201-0847</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Duration</span>
                                <span class="meta-value">2:34</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Recording</span>
                                <span class="meta-value recording">
                                    <span class="rec-dot"></span>
                                    Stored Securely
                                </span>
                            </div>
                        </div>
                        <div class="audit-timeline">
                            <div class="timeline-event">
                                <span class="event-time">0:00</span>
                                <span class="event-text">Call initiated - TPV verification workflow started</span>
                            </div>
                            <div class="timeline-event">
                                <span class="event-time">0:05</span>
                                <span class="event-text">Recording disclosure played and acknowledged</span>
                            </div>
                            <div class="timeline-event">
                                <span class="event-time">0:12</span>
                                <span class="event-text">Identity verified: "Yes, this is Maria Rodriguez"</span>
                            </div>
                            <div class="timeline-event">
                                <span class="event-time">0:34</span>
                                <span class="event-text">Current provider confirmed: Incumbent Electric Co.</span>
                            </div>
                            <div class="timeline-event">
                                <span class="event-time">1:15</span>
                                <span class="event-text">New plan details read and confirmed</span>
                            </div>
                            <div class="timeline-event">
                                <span class="event-time">2:08</span>
                                <span class="event-text">Final authorization received - Enrollment confirmed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate -->
                    <div class="compliance-certificate">
                        <div class="cert-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <div class="cert-content">
                            <span class="cert-title">Compliance Certificate</span>
                            <span class="cert-text">This call meets all regulatory requirements per FCC 47 CFR Part 64</span>
                            <span class="cert-id">Verification ID: V-2025-0847-AX</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Panel 4: SMS Flow -->
        <section class="solutions-panel" id="panel-sms" data-panel="sms">
            <div class="panel-container">
                <div class="panel-header">
                    <div class="panel-info">
                        <h2 class="panel-title">SMS Confirmation Flow</h2>
                        <p class="panel-desc">Voice calls trigger automatic SMS confirmations and follow-ups.</p>
                    </div>
                    <div class="panel-cta">
                        <span class="cta-hint">Ready to automate SMS?</span>
                        <a href="#demo" class="btn-contextual">See Pricing</a>
                    </div>
                </div>

                <div class="sms-demo-layout">
                    <!-- Phone Mockup -->
                    <div class="sms-phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="sms-header">
                                    <span class="sms-contact">Automatdo</span>
                                    <span class="sms-number">+1 (800) 555-AUTO</span>
                                </div>
                                <div class="sms-conversation" id="sms-conversation">
                                    <!-- Messages populated by JS -->
                                </div>
                                <div class="sms-input-area">
                                    <div class="sms-reply-buttons" id="sms-reply-buttons">
                                        <!-- Reply buttons populated by JS -->
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-bar"></div>
                        </div>
                    </div>

                    <!-- Flow Diagram -->
                    <div class="sms-flow-diagram">
                        <h3 class="section-label">Integration Flow</h3>
                        <div class="flow-steps">
                            <div class="flow-step completed" data-flow-step="1">
                                <div class="flow-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81"/>
                                    </svg>
                                </div>
                                <span class="flow-label">Voice Call</span>
                            </div>
                            <div class="flow-connector active"></div>
                            <div class="flow-step active" data-flow-step="2">
                                <div class="flow-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                    </svg>
                                </div>
                                <span class="flow-label">SMS Sent</span>
                            </div>
                            <div class="flow-connector"></div>
                            <div class="flow-step" data-flow-step="3">
                                <div class="flow-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>
                                <span class="flow-label">CRM Updated</span>
                            </div>
                        </div>

                        <div class="flow-status" id="flow-status">
                            <span class="status-step">Step 2 of 3</span>
                            <span class="status-desc">Waiting for customer response...</span>
                        </div>

                        <button class="btn-reset-sms" id="btn-reset-sms">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 4v6h-6"/>
                                <path d="M1 20v-6h6"/>
                                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                            </svg>
                            Reset Demo
                        </button>
                    </div>

                    <!-- Real SMS Status -->
                    <div class="sms-real-status" id="sms-real-status" style="display: none;">
                        <div class="real-sms-badge">
                            <span class="badge-icon">📱</span>
                            <span class="badge-text">Real SMS Enabled</span>
                        </div>
                        <p class="real-sms-info">Messages will be sent to your phone at <span id="real-sms-number"></span></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Panel 5: Campaigns -->
        <section class="solutions-panel" id="panel-campaigns" data-panel="campaigns">
            <div class="panel-container">
                <div class="panel-header">
                    <div class="panel-info">
                        <h2 class="panel-title">Campaign Dashboard</h2>
                        <p class="panel-desc">Scale your outreach with automated voice and SMS campaigns.</p>
                    </div>
                    <div class="panel-cta">
                        <span class="cta-hint">Ready to scale?</span>
                        <a href="#demo" class="btn-contextual">Book Demo</a>
                    </div>
                </div>

                <div class="campaigns-dashboard">
                    <!-- Active Campaigns -->
                    <div class="campaigns-grid">
                        <div class="campaign-card featured">
                            <div class="campaign-header">
                                <div class="campaign-status running">
                                    <span class="status-dot"></span>
                                    Running
                                </div>
                                <span class="campaign-type">Voice + SMS</span>
                            </div>
                            <h3 class="campaign-name">Spring Renewal Outreach</h3>
                            <p class="campaign-desc">Re-engage customers with expiring memberships</p>

                            <div class="campaign-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="--progress: 67%"></div>
                                </div>
                                <span class="progress-text">67% Complete</span>
                            </div>

                            <div class="campaign-stats">
                                <div class="stat">
                                    <span class="stat-value" data-animate="2340">0</span>
                                    <span class="stat-label">Contacts</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value" data-animate="89" data-suffix="%">0</span>
                                    <span class="stat-label">Answer Rate</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value" data-animate="342">0</span>
                                    <span class="stat-label">Conversions</span>
                                </div>
                            </div>
                        </div>

                        <div class="campaign-card">
                            <div class="campaign-header">
                                <div class="campaign-status scheduled">
                                    <span class="status-dot"></span>
                                    Scheduled
                                </div>
                                <span class="campaign-type">SMS Only</span>
                            </div>
                            <h3 class="campaign-name">Win-Back Campaign</h3>
                            <p class="campaign-desc">Re-activate churned customers with special offers</p>

                            <div class="campaign-schedule">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <span>Starts Feb 1, 2025</span>
                            </div>

                            <div class="campaign-stats">
                                <div class="stat">
                                    <span class="stat-value">890</span>
                                    <span class="stat-label">Contacts</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value">--</span>
                                    <span class="stat-label">Answer Rate</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value">--</span>
                                    <span class="stat-label">Conversions</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Stats Ticker -->
                    <div class="campaigns-live-stats">
                        <div class="live-header">
                            <span class="live-indicator">
                                <span class="live-dot"></span>
                                Live Activity
                            </span>
                            <span class="live-time">Today</span>
                        </div>
                        <div class="live-grid">
                            <div class="live-stat">
                                <span class="live-value" data-animate="1247">0</span>
                                <span class="live-label">Calls Made</span>
                            </div>
                            <div class="live-stat">
                                <span class="live-value" data-animate="892">0</span>
                                <span class="live-label">SMS Sent</span>
                            </div>
                            <div class="live-stat">
                                <span class="live-value" data-animate="156">0</span>
                                <span class="live-label">Appointments</span>
                            </div>
                            <div class="live-stat">
                                <span class="live-value" data-animate="94" data-suffix="%">0</span>
                                <span class="live-label">Success Rate</span>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Builder Preview -->
                    <div class="campaign-builder-preview">
                        <h3 class="section-label">Campaign Builder</h3>
                        <div class="builder-flow">
                            <div class="builder-node">
                                <div class="node-icon">👥</div>
                                <span class="node-label">Select Audience</span>
                                <span class="node-value">Expiring in 30 days</span>
                            </div>
                            <div class="builder-arrow">→</div>
                            <div class="builder-node">
                                <div class="node-icon">📞</div>
                                <span class="node-label">Choose Channel</span>
                                <span class="node-value">Voice + SMS</span>
                            </div>
                            <div class="builder-arrow">→</div>
                            <div class="builder-node">
                                <div class="node-icon">📝</div>
                                <span class="node-label">Set Script</span>
                                <span class="node-value">Renewal Offer</span>
                            </div>
                            <div class="builder-arrow">→</div>
                            <div class="builder-node node-launch">
                                <div class="node-icon">🚀</div>
                                <span class="node-label">Launch</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Journey Progress Indicator -->
    <div class="journey-progress" id="journey-progress">
        <div class="progress-track">
            <div class="progress-step completed" data-step="1">
                <span class="step-marker">1</span>
                <span class="step-label">Setup</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="2">
                <span class="step-marker">2</span>
                <span class="step-label">Voice</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="3">
                <span class="step-marker">3</span>
                <span class="step-label">Compliance</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="4">
                <span class="step-marker">4</span>
                <span class="step-label">SMS</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="5">
                <span class="step-marker">5</span>
                <span class="step-label">Campaigns</span>
            </div>
        </div>
    </div>

    <!-- Mobile Wizard Navigation -->
    <div class="mobile-wizard-nav" id="mobile-wizard-nav">
        <button class="wizard-btn wizard-prev" id="wizard-prev" disabled>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Back</span>
        </button>
        <div class="wizard-indicator">
            <span class="wizard-current" id="wizard-current">1</span>
            <span class="wizard-sep">/</span>
            <span class="wizard-total">5</span>
        </div>
        <button class="wizard-btn wizard-next" id="wizard-next">
            <span>Next</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    <!-- Journey Completion Modal -->
    <div class="journey-complete-modal" id="journey-complete-modal">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <h2 class="modal-title">You've Explored Everything!</h2>
            <p class="modal-text">Ready to transform your customer conversations with Automatdo?</p>
            <div class="modal-actions">
                <a href="#demo" class="btn-primary-large">
                    <span>Book Your Demo</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <button class="btn-secondary-modal" id="modal-keep-exploring">
                    Keep Exploring
                </button>
            </div>
        </div>
    </div>

    <!-- Summary Feature Cards -->
    <section class="solutions-summary" id="solutions-summary">
        <div class="section-container">
            <div class="section-header">
                <span class="section-tag">Platform Overview</span>
                <h2 class="section-title">Everything in One Place</h2>
            </div>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                        </svg>
                    </div>
                    <h3>Voice Agents</h3>
                    <p>Sub-300ms AI responses, 50+ languages</p>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Smart CRM</h3>
                    <p>Auto-transcription, customer insights</p>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3>Compliance</h3>
                    <p>TPV automation, audit trails</p>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <h3>SMS Integration</h3>
                    <p>Automated confirmations & follow-ups</p>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <h3>Campaigns</h3>
                    <p>Scalable outbound, smart scheduling</p>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <path d="M3 9h18M9 21V9"/>
                        </svg>
                    </div>
                    <h3>Integrations</h3>
                    <p>Salesforce, HubSpot, custom APIs</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <?php get_template_part('template-parts/section', 'cta'); ?>

</main>

<?php get_footer(); ?>
