<?php
/**
 * Template Name: About Page
 * Description: Company and founder information optimized for E-E-A-T SEO
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content" itemscope itemtype="https://schema.org/AboutPage">
        <!-- Story Section (Primary - First Section) -->
        <section class="about-story about-first-section" aria-labelledby="story-title">
            <div class="section-container">
                <div class="story-wrapper">
                    <div class="story-header">
                        <span class="section-tag">Our Story</span>
                        <h1 class="story-title" id="story-title">Built at the frontier of AI</h1>
                    </div>
                    <div class="story-timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <span class="timeline-year">2023</span>
                            </div>
                            <div class="timeline-content">
                                <h3>The Origin</h3>
                                <p>
                                    Automatdo was born at the dawn of large language models, in the height of
                                    specialized machine learning. We started where the pain was greatest: contact
                                    centers drowning in call volume with no way to ensure quality. Our first
                                    product automated QA on inbound calls handled by human agents—analyzing
                                    every conversation for compliance, sentiment, and performance. It still does.
                                </p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <span class="timeline-year">2024</span>
                            </div>
                            <div class="timeline-content">
                                <h3>The Breakthrough</h3>
                                <p>
                                    Then OpenAI released real-time voice. The technology we'd been waiting for
                                    finally existed. We didn't just add voice to a chatbot—we built from the
                                    ground up. Industry-specific toolboxes for TPV compliance, fitness scheduling,
                                    and home services dispatch. Deep integrations with Twilio, Google Calendar,
                                    and CRMs. A flow builder that lets conversations branch naturally. Vector
                                    search over every transcript. The result: AI agents that don't just talk,
                                    they actually get things done.
                                </p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <span class="timeline-year">Today</span>
                            </div>
                            <div class="timeline-content">
                                <h3>The Mission</h3>
                                <p>
                                    We're building the infrastructure for voice-first AI. Every call recorded,
                                    transcribed, and searchable. Every appointment booked directly to calendars.
                                    Every compliance requirement tracked and verified. Whether you need to
                                    automate calls or augment your human agents with real-time intelligence,
                                    we're making world-class voice AI accessible to businesses that refuse to
                                    miss another opportunity.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="about-mission" aria-labelledby="mission-title">
            <div class="section-container">
                <div class="mission-grid">
                    <div class="mission-content">
                        <span class="section-tag">Our Mission</span>
                        <h2 class="mission-title" id="mission-title">Automating conversations, amplifying human potential</h2>
                        <div class="mission-text">
                            <p>
                                Every day, businesses miss thousands of calls. Each missed call is a missed opportunity,
                                a frustrated customer, or a lost sale. We started Automatdo to solve this problem
                                with AI voice agents that handle calls with the same care and intelligence as your
                                best team members.
                            </p>
                            <p>
                                Our technology isn't about replacing humans. It's about freeing your team to focus on
                                what they do best while ensuring no customer is ever left waiting. Whether it's
                                scheduling appointments at 2 AM, verifying enrollments across state lines, or
                                qualifying leads in multiple languages, our AI agents work tirelessly so your team
                                doesn't have to.
                            </p>
                        </div>
                    </div>
                    <div class="mission-visual">
                        <div class="mission-card">
                            <div class="mission-icon">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <path d="M24 4L6 14v10c0 11 7.2 21.3 18 24 10.8-2.7 18-13 18-24V14L24 4z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 24l6 6 12-12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>Enterprise Grade</h3>
                            <p>Built for regulated industries with full compliance support</p>
                        </div>
                        <div class="mission-card">
                            <div class="mission-icon">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="18" stroke="currentColor" stroke-width="2.5"/>
                                    <path d="M24 14v10l7 4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3>Always Available</h3>
                            <p>Never miss another call, day or night, weekday or weekend</p>
                        </div>
                        <div class="mission-card">
                            <div class="mission-icon">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <path d="M24 4C13 4 4 13 4 24s9 20 20 20 20-9 20-20S35 4 24 4z" stroke="currentColor" stroke-width="2.5"/>
                                    <path d="M4 24h40M24 4c5 5 8 12 8 20s-3 15-8 20c-5-5-8-12-8-20s3-15 8-20z" stroke="currentColor" stroke-width="2.5"/>
                                </svg>
                            </div>
                            <h3>Multilingual</h3>
                            <p>Seamlessly switch between 50+ languages mid-conversation</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Founder Section (E-E-A-T Optimized) -->
        <section class="about-founder" aria-labelledby="founder-title" itemscope itemtype="https://schema.org/Person">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-tag">Leadership</span>
                    <h2 class="section-title" id="founder-title">Meet the Founder</h2>
                </div>
                <div class="founder-card">
                    <div class="founder-image-wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ryan_pfp_linkedin.jpeg"
                             alt="Ryan Schuetz - Founder & CEO of Automatdo"
                             class="founder-image"
                             itemprop="image"
                             loading="lazy">
                    </div>
                    <div class="founder-info">
                        <div class="founder-header">
                            <div class="founder-titles">
                                <h3 class="founder-name" itemprop="name">Ryan Schuetz</h3>
                                <span class="founder-role" itemprop="jobTitle">Founder & CEO</span>
                            </div>
                            <a href="https://www.linkedin.com/in/ryanschuetz/"
                               class="founder-linkedin"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Connect with Ryan on LinkedIn"
                               itemprop="sameAs">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                <span>Connect on LinkedIn</span>
                            </a>
                        </div>
                        <div class="founder-bio" itemprop="description">
                            <p>
                                Ryan brings 25 years of experience in technology and entrepreneurship to Automatdo.
                                Before founding Automatdo, he built and scaled HelloGym, gaining firsthand insight
                                into the challenges businesses face managing customer communications at scale.
                            </p>
                            <p>
                                Passionate about the intersection of AI and human communication, Ryan leads
                                Automatdo's mission to transform how businesses connect with their customers
                                through intelligent voice technology.
                            </p>
                        </div>
                        <div class="founder-credentials">
                            <div class="credential-item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 3L4 7v4c0 5.5 3.6 10.7 8 12 4.4-1.3 8-6.5 8-12V7l-8-4z" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 12l3 3 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>25+ Years in Tech</span>
                            </div>
                            <a href="https://hellogym.io" target="_blank" rel="noopener noreferrer" class="credential-item credential-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 12h12M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm16-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 4a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M6 8v8M18 8v8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <span>Founded HelloGym</span>
                            </a>
                            <a href="https://safeteam.io" target="_blank" rel="noopener noreferrer" class="credential-item credential-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <circle cx="9" cy="7" r="3" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="17" cy="7" r="2" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M17 11a3 3 0 0 1 3 3v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <span>Founded SafeTeam</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="about-values" aria-labelledby="values-title">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-tag">Our Values</span>
                    <h2 class="section-title" id="values-title">What drives us</h2>
                    <p class="section-subtitle">
                        The principles that guide every decision we make and every line of code we write.
                    </p>
                </div>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-number">01</div>
                        <h3 class="value-title">Reliability First</h3>
                        <p class="value-desc">
                            When you trust us with your customers, we take that seriously. Our systems are built
                            for 99.9% uptime because your business never sleeps.
                        </p>
                    </div>
                    <div class="value-card">
                        <div class="value-number">02</div>
                        <h3 class="value-title">Human-Centered AI</h3>
                        <p class="value-desc">
                            Technology should serve people, not the other way around. We build AI that enhances
                            human capabilities rather than replacing human connection.
                        </p>
                    </div>
                    <div class="value-card">
                        <div class="value-number">03</div>
                        <h3 class="value-title">Radical Transparency</h3>
                        <p class="value-desc">
                            No black boxes. We believe you should understand exactly how our AI works, what it
                            can do, and where its limitations lie.
                        </p>
                    </div>
                    <div class="value-card">
                        <div class="value-number">04</div>
                        <h3 class="value-title">Continuous Innovation</h3>
                        <p class="value-desc">
                            The AI landscape evolves daily. We're committed to staying at the cutting edge,
                            constantly improving our agents to deliver better results.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="about-cta">
            <div class="section-container">
                <div class="cta-card">
                    <div class="cta-content">
                        <h2 class="cta-title">Ready to transform your customer communications?</h2>
                        <p class="cta-subtitle">
                            See how Automatdo can help your business never miss another opportunity.
                        </p>
                    </div>
                    <div class="cta-actions">
                        <a href="<?php echo home_url('/#demo'); ?>" class="btn-primary btn-large">
                            <span>Book a Demo</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="<?php echo home_url('/contact'); ?>" class="btn-secondary btn-large">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
?>
