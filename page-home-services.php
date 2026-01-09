<?php
/**
 * Template Name: Home Services Solution
 * Description: Home Services solution page (HVAC, Plumbing, Electrical, Cleaning)
 *
 * @package Automatdo
 */

get_header();
?>

    <main>
        <!-- Hero: Split screen - Chaos vs Control -->
        <section class="hs-hero">
            <div class="hero-split">
                <!-- Left: The Chaos -->
                <div class="hero-chaos">
                    <div class="chaos-label">Without Automatdo</div>
                    <div class="chaos-stack">
                        <div class="chaos-item missed-call">
                            <div class="chaos-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                            </div>
                            <div class="chaos-content">
                                <span class="chaos-title">Missed Call</span>
                                <span class="chaos-detail">Emergency - Burst pipe</span>
                                <span class="chaos-time">2:34 AM</span>
                            </div>
                            <div class="chaos-badge urgent">Lost</div>
                        </div>
                        <div class="chaos-item voicemail">
                            <div class="chaos-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="5.5" cy="11.5" r="4.5"/>
                                    <circle cx="18.5" cy="11.5" r="4.5"/>
                                    <line x1="5.5" y1="16" x2="18.5" y2="16"/>
                                </svg>
                            </div>
                            <div class="chaos-content">
                                <span class="chaos-title">Voicemail (Unheard)</span>
                                <span class="chaos-detail">"Hi, I need a quote for..."</span>
                                <span class="chaos-time">Yesterday</span>
                            </div>
                            <div class="chaos-badge stale">3 days old</div>
                        </div>
                        <div class="chaos-item missed-call">
                            <div class="chaos-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                            </div>
                            <div class="chaos-content">
                                <span class="chaos-title">Missed Call</span>
                                <span class="chaos-detail">AC not working - 95F</span>
                                <span class="chaos-time">6:15 PM</span>
                            </div>
                            <div class="chaos-badge urgent">Lost</div>
                        </div>
                        <div class="chaos-item quote">
                            <div class="chaos-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                            </div>
                            <div class="chaos-content">
                                <span class="chaos-title">Quote Request</span>
                                <span class="chaos-detail">Kitchen remodel estimate</span>
                                <span class="chaos-time">Last week</span>
                            </div>
                            <div class="chaos-badge stale">No follow-up</div>
                        </div>
                    </div>
                    <div class="chaos-counter">
                        <span class="counter-number">12</span>
                        <span class="counter-label">missed opportunities this week</span>
                    </div>
                </div>

                <!-- Right: The Control -->
                <div class="hero-control">
                    <div class="control-label">With Automatdo</div>
                    <div class="dispatch-board">
                        <div class="board-header">
                            <span class="board-title">Today's Dispatch</span>
                            <span class="board-live">
                                <span class="live-dot"></span>
                                Live
                            </span>
                        </div>
                        <div class="board-jobs">
                            <div class="job-card completed">
                                <div class="job-status">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </div>
                                <div class="job-info">
                                    <span class="job-type">Emergency Plumbing</span>
                                    <span class="job-address">1847 Oak Street</span>
                                </div>
                                <div class="job-tech">
                                    <span class="tech-avatar">MR</span>
                                    <span class="tech-time">Completed 9:15 AM</span>
                                </div>
                            </div>
                            <div class="job-card active">
                                <div class="job-status pulsing">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                                <div class="job-info">
                                    <span class="job-type">HVAC Maintenance</span>
                                    <span class="job-address">2201 Pine Ave</span>
                                </div>
                                <div class="job-tech">
                                    <span class="tech-avatar">JT</span>
                                    <span class="tech-time">In Progress</span>
                                </div>
                            </div>
                            <div class="job-card scheduled">
                                <div class="job-status">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                </div>
                                <div class="job-info">
                                    <span class="job-type">Electrical Inspection</span>
                                    <span class="job-address">892 Maple Dr</span>
                                </div>
                                <div class="job-tech">
                                    <span class="tech-avatar">KL</span>
                                    <span class="tech-time">2:00 PM Today</span>
                                </div>
                            </div>
                        </div>
                        <div class="board-incoming">
                            <div class="incoming-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                Incoming call...
                            </div>
                            <div class="incoming-action">AI Answering</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-content">
                <h1 class="hs-hero-title">
                    Every call answered.<br>
                    <span class="accent">Every job dispatched.</span>
                </h1>
                <p class="hs-hero-subtitle">
                    AI voice agents that handle emergency calls, book appointments, and manage your dispatch board 24/7. For HVAC, plumbing, electrical, and cleaning services.
                </p>
                <div class="hero-actions">
                    <a href="#demo" class="btn btn-primary btn-lg">See It In Action</a>
                    <a href="#how-it-works" class="btn btn-secondary btn-lg">How It Works</a>
                </div>
            </div>
        </section>

        <!-- Pain Points: The Problem Stack -->
        <section class="hs-problems">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">The Reality</span>
                    <h2 class="section-title">Home services run on calls.<br>Most businesses miss too many.</h2>
                </div>

                <div class="problem-grid">
                    <div class="problem-card">
                        <div class="problem-stat">
                            <span class="stat-number">62%</span>
                            <span class="stat-context">of emergency calls</span>
                        </div>
                        <p class="problem-text">happen outside business hours when no one's there to answer. These customers call your competitor next.</p>
                        <div class="problem-scenario">
                            <span class="scenario-time">2:34 AM</span>
                            <span class="scenario-issue">"My water heater just burst"</span>
                        </div>
                    </div>

                    <div class="problem-card">
                        <div class="problem-stat">
                            <span class="stat-number">$847</span>
                            <span class="stat-context">average job value</span>
                        </div>
                        <p class="problem-text">lost every time a call goes to voicemail. Most callers won't leave a message--they'll just move on.</p>
                        <div class="problem-scenario">
                            <span class="scenario-time">Voicemail</span>
                            <span class="scenario-issue">"Please leave a message..."</span>
                            <span class="scenario-result">*click*</span>
                        </div>
                    </div>

                    <div class="problem-card">
                        <div class="problem-stat">
                            <span class="stat-number">3.2x</span>
                            <span class="stat-context">more calls in peak season</span>
                        </div>
                        <p class="problem-text">overwhelm your team. Summer AC and winter heating surges mean dropped calls when you need them most.</p>
                        <div class="problem-scenario">
                            <span class="scenario-time">July Heat Wave</span>
                            <span class="scenario-issue">47 missed calls in one day</span>
                        </div>
                    </div>

                    <div class="problem-card">
                        <div class="problem-stat">
                            <span class="stat-number">4 hrs</span>
                            <span class="stat-context">average response time</span>
                        </div>
                        <p class="problem-text">for quote follow-ups. By then, 35% of leads have already booked with someone else.</p>
                        <div class="problem-scenario">
                            <span class="scenario-time">Quote Request</span>
                            <span class="scenario-issue">"Still waiting to hear back..."</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Types: Tab Selector -->
        <section class="hs-services">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Built For Your Business</span>
                    <h2 class="section-title">One AI, trained for your service type</h2>
                </div>

                <div class="service-tabs">
                    <button class="service-tab active" data-service="hvac">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                        </svg>
                        <span>HVAC</span>
                    </button>
                    <button class="service-tab" data-service="plumbing">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 3v18M6 8h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6"/>
                        </svg>
                        <span>Plumbing</span>
                    </button>
                    <button class="service-tab" data-service="electrical">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                        </svg>
                        <span>Electrical</span>
                    </button>
                    <button class="service-tab" data-service="cleaning">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 22v-8h4v8M9 22V10h4v12M15 22V6h4v16"/>
                        </svg>
                        <span>Cleaning</span>
                    </button>
                </div>

                <div class="service-panels">
                    <!-- HVAC Panel -->
                    <div class="service-panel active" data-service="hvac">
                        <div class="panel-content">
                            <h3 class="panel-title">HVAC & Climate Control</h3>
                            <p class="panel-description">Handle emergency AC failures, schedule seasonal maintenance, and capture quote requests for new installations.</p>
                            <ul class="panel-features">
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Emergency triage for no-cooling/no-heat calls
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Seasonal maintenance scheduling
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    New system quote qualification
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Filter replacement reminders
                                </li>
                            </ul>
                        </div>
                        <div class="panel-demo">
                            <div class="demo-call">
                                <div class="call-header">
                                    <span class="call-type emergency">Emergency Call</span>
                                    <span class="call-time">Now</span>
                                </div>
                                <div class="call-transcript">
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"Our AC stopped working and it's 95 degrees in here with my elderly mother."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"I understand this is urgent. Let me get a technician to you as soon as possible. Can you confirm your address at 2847 Oak Lane?"</span>
                                    </div>
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"Yes, that's right."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"I have a technician available within 90 minutes. I'm dispatching Mike now and he'll call when he's on his way."</span>
                                    </div>
                                </div>
                                <div class="call-outcome">
                                    <span class="outcome-badge success">Dispatched</span>
                                    <span class="outcome-text">Tech en route, ETA 87 min</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Plumbing Panel -->
                    <div class="service-panel" data-service="plumbing">
                        <div class="panel-content">
                            <h3 class="panel-title">Plumbing Services</h3>
                            <p class="panel-description">Respond to water emergencies immediately, schedule drain cleaning, and qualify leads for bathroom remodels.</p>
                            <ul class="panel-features">
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Water emergency rapid response
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Drain and sewer scheduling
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Water heater replacement quotes
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Bathroom remodel lead capture
                                </li>
                            </ul>
                        </div>
                        <div class="panel-demo">
                            <div class="demo-call">
                                <div class="call-header">
                                    <span class="call-type emergency">Emergency Call</span>
                                    <span class="call-time">2:34 AM</span>
                                </div>
                                <div class="call-transcript">
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"There's water everywhere! A pipe burst under my kitchen sink!"</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"I'm so sorry--let's stop that water first. Can you locate and turn off the shutoff valve under the sink? It's usually a small knob."</span>
                                    </div>
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"Okay, I found it. The water stopped."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"Perfect. I'm dispatching our emergency plumber now. Carlos will be there within 45 minutes. What's the best number to reach you?"</span>
                                    </div>
                                </div>
                                <div class="call-outcome">
                                    <span class="outcome-badge success">Dispatched</span>
                                    <span class="outcome-text">Emergency tech arriving 3:15 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Electrical Panel -->
                    <div class="service-panel" data-service="electrical">
                        <div class="panel-content">
                            <h3 class="panel-title">Electrical Contractors</h3>
                            <p class="panel-description">Handle power outage calls safely, schedule inspections, and qualify leads for panel upgrades and EV charger installations.</p>
                            <ul class="panel-features">
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Safety-first emergency protocols
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Panel upgrade consultations
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    EV charger installation quotes
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Inspection scheduling
                                </li>
                            </ul>
                        </div>
                        <div class="panel-demo">
                            <div class="demo-call">
                                <div class="call-header">
                                    <span class="call-type scheduled">Quote Request</span>
                                    <span class="call-time">4:15 PM</span>
                                </div>
                                <div class="call-transcript">
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"I just got a Tesla and need an EV charger installed in my garage."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"Congratulations on the Tesla! We install Level 2 chargers regularly. Do you know your current panel amperage, or would you like us to assess that during the visit?"</span>
                                    </div>
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"I'm not sure, probably best to have someone look."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"No problem. I can schedule a free assessment. We have Thursday at 10 AM or Friday at 2 PM available this week."</span>
                                    </div>
                                </div>
                                <div class="call-outcome">
                                    <span class="outcome-badge scheduled">Scheduled</span>
                                    <span class="outcome-text">Assessment Thu 10 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cleaning Panel -->
                    <div class="service-panel" data-service="cleaning">
                        <div class="panel-content">
                            <h3 class="panel-title">Cleaning & Maid Services</h3>
                            <p class="panel-description">Book recurring cleaning schedules, handle last-minute requests, and manage rescheduling without phone tag.</p>
                            <ul class="panel-features">
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Recurring schedule management
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Same-day booking for openings
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Move-in/move-out deep cleans
                                </li>
                                <li>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Easy rescheduling
                                </li>
                            </ul>
                        </div>
                        <div class="panel-demo">
                            <div class="demo-call">
                                <div class="call-header">
                                    <span class="call-type scheduled">Booking Call</span>
                                    <span class="call-time">11:20 AM</span>
                                </div>
                                <div class="call-transcript">
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"I need to start weekly cleaning service. We have a 3-bedroom house."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"I'd be happy to set that up. For a 3-bedroom home, our weekly service is $150 per visit. Do you have pets or any specific areas you'd like us to focus on?"</span>
                                    </div>
                                    <div class="transcript-line caller">
                                        <span class="speaker">Caller:</span>
                                        <span class="text">"We have two dogs, so the floors are a priority."</span>
                                    </div>
                                    <div class="transcript-line ai">
                                        <span class="speaker">AI:</span>
                                        <span class="text">"I'll note that--extra attention on floors. What day works best for your weekly visit? We have openings on Tuesdays and Thursdays."</span>
                                    </div>
                                </div>
                                <div class="call-outcome">
                                    <span class="outcome-badge success">Booked</span>
                                    <span class="outcome-text">Weekly - Thursdays 9 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works: Call Flow -->
        <section class="hs-how-it-works" id="how-it-works">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">How It Works</span>
                    <h2 class="section-title">From ring to resolution in seconds</h2>
                </div>

                <div class="flow-container">
                    <div class="flow-step">
                        <div class="step-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="step-number">01</div>
                        <h3 class="step-title">Call Comes In</h3>
                        <p class="step-description">Customer calls your business number. AI answers instantly, 24/7/365--no hold music, no voicemail.</p>
                    </div>

                    <div class="flow-connector">
                        <svg width="40" height="24" viewBox="0 0 40 24">
                            <path d="M0 12 L30 12 M25 6 L35 12 L25 18" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>

                    <div class="flow-step">
                        <div class="step-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 16v-4M12 8h.01"/>
                            </svg>
                        </div>
                        <div class="step-number">02</div>
                        <h3 class="step-title">AI Qualifies</h3>
                        <p class="step-description">Understands if it's an emergency or routine request. Gathers address, issue details, and availability.</p>
                    </div>

                    <div class="flow-connector">
                        <svg width="40" height="24" viewBox="0 0 40 24">
                            <path d="M0 12 L30 12 M25 6 L35 12 L25 18" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>

                    <div class="flow-step">
                        <div class="step-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                                <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                            </svg>
                        </div>
                        <div class="step-number">03</div>
                        <h3 class="step-title">Books or Dispatches</h3>
                        <p class="step-description">Schedules appointments based on real availability, or immediately dispatches for emergencies.</p>
                    </div>

                    <div class="flow-connector">
                        <svg width="40" height="24" viewBox="0 0 40 24">
                            <path d="M0 12 L30 12 M25 6 L35 12 L25 18" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>

                    <div class="flow-step">
                        <div class="step-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <div class="step-number">04</div>
                        <h3 class="step-title">You're Notified</h3>
                        <p class="step-description">Get instant alerts with full call summary. Job appears on your dispatch board, ready to go.</p>
                    </div>
                </div>

                <div class="flow-branches">
                    <div class="branch emergency-branch">
                        <div class="branch-header">
                            <span class="branch-badge emergency">Emergency Path</span>
                        </div>
                        <div class="branch-steps">
                            <span class="branch-step">Urgent triage</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Safety guidance</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Immediate dispatch</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Tech alerted</span>
                        </div>
                    </div>
                    <div class="branch scheduled-branch">
                        <div class="branch-header">
                            <span class="branch-badge scheduled">Scheduled Path</span>
                        </div>
                        <div class="branch-steps">
                            <span class="branch-step">Service needed</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Check availability</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Confirm booking</span>
                            <span class="branch-arrow">-></span>
                            <span class="branch-step">Send reminder</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Results: Dashboard Style -->
        <section class="hs-results">
            <div class="container">
                <div class="results-header">
                    <span class="section-tag">Results</span>
                    <h2 class="section-title">What happens when you stop missing calls</h2>
                </div>

                <div class="results-dashboard">
                    <div class="result-metric primary">
                        <div class="metric-value">
                            <span class="value-number" data-value="100">100</span>
                            <span class="value-unit">%</span>
                        </div>
                        <div class="metric-label">Call Answer Rate</div>
                        <div class="metric-comparison">
                            <span class="comparison-previous">vs. 64% industry average</span>
                        </div>
                    </div>

                    <div class="result-metric">
                        <div class="metric-value">
                            <span class="value-symbol">+</span>
                            <span class="value-number" data-value="31">31</span>
                            <span class="value-unit">%</span>
                        </div>
                        <div class="metric-label">More Jobs Booked</div>
                        <div class="metric-context">Captured from after-hours calls</div>
                    </div>

                    <div class="result-metric">
                        <div class="metric-value">
                            <span class="value-symbol">-</span>
                            <span class="value-number" data-value="89">89</span>
                            <span class="value-unit">%</span>
                        </div>
                        <div class="metric-label">Response Time</div>
                        <div class="metric-context">From hours to seconds</div>
                    </div>

                    <div class="result-metric">
                        <div class="metric-value">
                            <span class="value-symbol">$</span>
                            <span class="value-number" data-value="12400">12,400</span>
                        </div>
                        <div class="metric-label">Monthly Revenue Recovered</div>
                        <div class="metric-context">Average for service businesses</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials: Staggered Cards -->
        <section class="hs-testimonials">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">From Service Pros</span>
                    <h2 class="section-title">Trusted by home service businesses</h2>
                </div>

                <div class="testimonial-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"We were losing at least 5 emergency calls a week to voicemail. Now every single one gets handled. Last month the AI dispatched 23 after-hours jobs we would have missed."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">RH</div>
                            <div class="author-info">
                                <span class="author-name">Beta User</span>
                                <span class="author-company">HVAC Company, Texas</span>
                            </div>
                        </div>
                        <div class="testimonial-badge">HVAC</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"The AI actually helped a customer turn off their water main at 3 AM while dispatching our guy. That's not just answering calls--that's real service."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">MP</div>
                            <div class="author-info">
                                <span class="author-name">Beta User</span>
                                <span class="author-company">Plumbing Services, Florida</span>
                            </div>
                        </div>
                        <div class="testimonial-badge">Plumbing</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"Scheduling used to take 3-4 calls back and forth. Now customers book directly and it just shows up on our calendar. We've doubled our recurring clients."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">SC</div>
                            <div class="author-info">
                                <span class="author-name">Beta User</span>
                                <span class="author-company">Cleaning Service, California</span>
                            </div>
                        </div>
                        <div class="testimonial-badge">Cleaning</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA: Command Center Style -->
        <section class="hs-cta" id="demo">
            <div class="container">
                <div class="cta-card">
                    <div class="cta-content">
                        <h2 class="cta-title">Stop losing jobs to voicemail</h2>
                        <p class="cta-description">See how AI handles your exact call types. 15-minute demo customized for your service business.</p>

                        <form class="cta-form" id="demo-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <input type="text" id="firstname" name="firstname" required placeholder=" ">
                                    <label for="firstname">First Name</label>
                                </div>
                                <div class="form-field">
                                    <input type="text" id="lastname" name="lastname" required placeholder=" ">
                                    <label for="lastname">Last Name</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <input type="email" id="email" name="email" required placeholder=" ">
                                    <label for="email">Work Email</label>
                                </div>
                                <div class="form-field">
                                    <input type="tel" id="phone" name="phone" placeholder=" ">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <input type="text" id="company" name="company" required placeholder=" ">
                                    <label for="company">Company Name</label>
                                </div>
                                <div class="form-field">
                                    <select id="service-type" name="service-type" required>
                                        <option value="" disabled selected></option>
                                        <option value="hvac">HVAC</option>
                                        <option value="plumbing">Plumbing</option>
                                        <option value="electrical">Electrical</option>
                                        <option value="cleaning">Cleaning Services</option>
                                        <option value="other">Other Home Service</option>
                                    </select>
                                    <label for="service-type">Service Type</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-full">
                                Get Your Demo
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="cta-visual">
                        <div class="mini-dispatch">
                            <div class="mini-header">Your Dispatch Board</div>
                            <div class="mini-jobs">
                                <div class="mini-job">
                                    <span class="mini-status completed"></span>
                                    <span class="mini-text">Emergency repair - Done</span>
                                </div>
                                <div class="mini-job">
                                    <span class="mini-status active"></span>
                                    <span class="mini-text">Maintenance call - In progress</span>
                                </div>
                                <div class="mini-job">
                                    <span class="mini-status scheduled"></span>
                                    <span class="mini-text">Quote visit - 2:00 PM</span>
                                </div>
                                <div class="mini-job incoming">
                                    <span class="mini-status incoming"></span>
                                    <span class="mini-text">New call coming in...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
