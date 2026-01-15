<?php
/**
 * Template Name: Contact Page
 * Description: Contact page with inquiry form, email, and FAQ
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Contact Hero Section -->
        <section class="contact-hero" aria-labelledby="contact-hero-title">
            <div class="contact-hero-container">
                <div class="contact-hero-content">
                    <span class="section-tag">Get in Touch</span>
                    <h1 class="contact-hero-title" id="contact-hero-title">
                        <span class="title-line">We'd Love to</span>
                        <span class="title-line title-gradient">Hear From You</span>
                    </h1>
                    <p class="contact-hero-subtitle">
                        Have a question about our AI voice agents? Need help with an integration?
                        Or just want to say hello? We're here to help.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-main">
            <div class="section-container">
                <div class="contact-grid">
                    <!-- Contact Form -->
                    <div class="contact-form-wrapper">
                        <div class="contact-form-card">
                            <h2 class="contact-form-title">Send Us a Message</h2>
                            <p class="contact-form-subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>

                            <form class="contact-form" id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                                <input type="hidden" name="action" value="contact_form_submit">
                                <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="contact-name">Full Name *</label>
                                        <input type="text" id="contact-name" name="contact_name" placeholder="John Smith" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-email">Email Address *</label>
                                        <input type="email" id="contact-email" name="contact_email" placeholder="john@company.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact-company">Company</label>
                                    <input type="text" id="contact-company" name="contact_company" placeholder="Your Company Name">
                                </div>

                                <div class="form-group">
                                    <label for="contact-subject">Subject *</label>
                                    <select id="contact-subject" name="contact_subject" required>
                                        <option value="">Select a topic...</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="technical">Technical Question</option>
                                        <option value="partnership">Partnership Opportunity</option>
                                        <option value="support">Support Request</option>
                                        <option value="billing">Billing Question</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contact-message">Message *</label>
                                    <textarea id="contact-message" name="contact_message" placeholder="Tell us how we can help..." rows="5" required></textarea>
                                </div>

                                <button type="submit" class="btn-primary btn-large btn-full">
                                    <span>Send Message</span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Info Sidebar -->
                    <div class="contact-info-sidebar">
                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M4 8l12 8 12-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <rect x="4" y="6" width="24" height="20" rx="2" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <h3>Email Us Directly</h3>
                            <p>For quick questions or support</p>
                            <a href="mailto:info@automatdo.com" class="contact-email-link">info@automatdo.com</a>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <circle cx="16" cy="16" r="10" stroke="currentColor" stroke-width="2"/>
                                    <path d="M16 10v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3>Response Time</h3>
                            <p>We typically respond within</p>
                            <span class="contact-highlight">24 hours</span>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M16 4L6 9v6c0 7 4 12.5 10 14 6-1.5 10-7 10-14V9L16 4z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 16l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>Sales Inquiries</h3>
                            <p>Ready to see a demo?</p>
                            <a href="<?php echo home_url('/#demo'); ?>" class="btn-secondary contact-demo-btn">Book a Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="contact-faq">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-tag">FAQ</span>
                    <h2 class="section-title">Common Questions</h2>
                    <p class="section-subtitle">
                        Find quick answers to frequently asked questions about Automatdo.
                    </p>
                </div>

                <div class="faq-grid">
                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How quickly can I deploy an AI voice agent?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>Most customers are live within days, not months. Our platform is designed for rapid deployment with pre-built templates for common use cases like TPV, appointment scheduling, and customer service.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>What languages do your AI agents support?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>Our AI agents support 50+ languages with automatic language detection. A caller can start in English and switch to Spanish mid-call, and the agent will seamlessly continue the conversation in their preferred language.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How does pricing work?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>We offer flexible pricing based on your call volume and use case. Contact us for a custom quote tailored to your specific needs. We're committed to providing transparent, value-based pricing.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>Can AI agents transfer to human agents?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>Absolutely. Our AI agents can perform warm transfers to human agents when needed, passing along full context from the conversation. You define the escalation rules based on your business requirements.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>Is Automatdo compliant with industry regulations?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>Yes. We're built for regulated industries. Our platform supports FCC, state PUC, TCPA, and industry-specific compliance requirements. All calls are recorded with complete audit trails for compliance verification.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>What integrations do you support?</span>
                            <span class="faq-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <div class="faq-answer-divider"></div>
                                <p>We integrate with popular CRMs (Salesforce, HubSpot, GoHighLevel), calendar systems (Google, Outlook), and custom platforms via our REST API and webhooks. Our team can help with custom integrations.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-cta">
                    <p>Still have questions?</p>
                    <a href="#contact-form" class="btn-secondary">Contact Us</a>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
?>
