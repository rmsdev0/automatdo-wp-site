<?php
/**
 * Template Name: FAQ Page
 * Description: Frequently Asked Questions with accordion layout and FAQPage schema
 *
 * @package Automatdo
 */

get_header();

// FAQ Data organized by category
$faq_categories = array(
    'general' => array(
        'label' => 'General',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M10 6v4l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'questions' => array(
            array(
                'q' => 'What is Automatdo?',
                'a' => 'Automatdo provides enterprise-grade AI voice agents that handle phone calls for your business 24/7. Our agents can schedule appointments, answer customer questions, qualify leads, and complete third-party verifications with the same care and intelligence as your best team members.'
            ),
            array(
                'q' => 'How do AI voice agents work?',
                'a' => 'Our AI voice agents use advanced speech recognition and natural language processing to understand caller intent, respond naturally in conversation, and take actions like booking appointments or transferring calls. They integrate with your existing phone system and CRM, learning your business processes to provide seamless customer interactions.'
            ),
            array(
                'q' => 'What industries do you serve?',
                'a' => 'We specialize in industries where every call matters: energy and utilities (TPV verification), fitness and wellness (membership inquiries and class bookings), home services (emergency dispatch and scheduling), and general customer support. Our agents are customized to understand the specific terminology and workflows of your industry.'
            ),
            array(
                'q' => 'Is there a free trial available?',
                'a' => 'Yes! We offer a personalized demo where you can experience our AI voice agent firsthand. During the demo, we\'ll configure an agent specific to your industry and use case so you can see exactly how it would handle your calls. Contact us to schedule your demo.'
            ),
        ),
    ),
    'technical' => array(
        'label' => 'Technical',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="3" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M7 8l2 2-2 2M11 12h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'questions' => array(
            array(
                'q' => 'How does Automatdo integrate with my existing systems?',
                'a' => 'We integrate with all major phone systems (VoIP, PBX, SIP trunking) and CRM platforms including Salesforce, HubSpot, Mindbody, ServiceTitan, and custom solutions. Our API allows for deep integration with your scheduling, billing, and customer management systems. Most integrations can be completed within 1-2 weeks.'
            ),
            array(
                'q' => 'What languages does the AI support?',
                'a' => 'Our voice agents support over 50 languages including English, Spanish, French, German, Mandarin, Portuguese, and many more. The AI can seamlessly switch languages mid-conversation based on caller preference, ensuring you never lose a customer due to language barriers.'
            ),
            array(
                'q' => 'How accurate is the speech recognition?',
                'a' => 'Our speech recognition achieves over 95% accuracy across diverse accents, dialects, and speaking styles. The system is trained on millions of hours of conversational data and continuously improves through machine learning. For specialized terminology in your industry, we can fine-tune the models for even higher accuracy.'
            ),
            array(
                'q' => 'What happens if the AI can\'t handle a call?',
                'a' => 'Our AI knows its limits. When a conversation requires human judgment or falls outside its training, it seamlessly transfers to a live agent with full context of the conversation. You can set custom escalation rules based on topics, sentiment, or caller requests. The AI also learns from these escalations to handle similar situations better in the future.'
            ),
        ),
    ),
    'pricing' => array(
        'label' => 'Pricing',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M10 5v10M7.5 7.5c0-1.1 1.1-2 2.5-2s2.5.9 2.5 2c0 1.5-2.5 1.5-2.5 3M10 15.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'questions' => array(
            array(
                'q' => 'How is Automatdo priced?',
                'a' => 'We offer flexible pricing based on call volume and complexity. Plans start with a base monthly fee plus per-minute rates for calls handled. Volume discounts are available for high-traffic operations. Contact us for a custom quote based on your specific needs and expected call volume.'
            ),
            array(
                'q' => 'Are there any setup fees?',
                'a' => 'Setup fees vary based on the complexity of your integration and customization requirements. For standard integrations with supported CRM platforms, setup is often included in your first month. Custom integrations, specialized training, and multi-location deployments may incur additional setup costs.'
            ),
            array(
                'q' => 'What\'s included in the monthly subscription?',
                'a' => 'Every plan includes: 24/7 AI voice agent availability, real-time call analytics and reporting, standard CRM integrations, multilingual support, automatic call transcription, and priority customer support. Enterprise plans add dedicated account management, custom model training, and SLA guarantees.'
            ),
            array(
                'q' => 'Do you offer volume discounts?',
                'a' => 'Yes, we offer significant volume discounts for businesses handling large call volumes. Our enterprise tier includes custom pricing based on your specific usage patterns. Contact our sales team to discuss volume pricing for your organization.'
            ),
        ),
    ),
    'security' => array(
        'label' => 'Security & Compliance',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2L3 6v4c0 5 3 9.5 7 11 4-1.5 7-6 7-11V6l-7-4z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 10l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'questions' => array(
            array(
                'q' => 'Is my data secure with Automatdo?',
                'a' => 'Security is our top priority. All data is encrypted at rest and in transit using AES-256 and TLS 1.3. We operate SOC 2 Type II compliant infrastructure, conduct regular security audits, and maintain strict access controls. Your data is never used to train models for other customers.'
            ),
            array(
                'q' => 'Is Automatdo HIPAA compliant?',
                'a' => 'Yes, we offer HIPAA-compliant solutions for healthcare organizations. This includes signed Business Associate Agreements (BAA), encrypted PHI handling, audit logging, and compliant data retention policies. Contact us to learn more about our healthcare-specific implementation.'
            ),
            array(
                'q' => 'How do you handle PCI compliance for payment information?',
                'a' => 'We are PCI DSS compliant and never store sensitive payment card data. When calls involve payment processing, we use secure tokenization and integrate directly with your payment processor. Callers can safely provide payment information knowing it\'s handled to the highest security standards.'
            ),
            array(
                'q' => 'Can calls be recorded and where are recordings stored?',
                'a' => 'Call recording is optional and configurable based on your compliance needs. When enabled, recordings are encrypted and stored in secure, geographically-redundant data centers. You control retention periods, access permissions, and can export or delete recordings at any time. We support automatic deletion policies to help with compliance requirements.'
            ),
        ),
    ),
    'why-automatdo' => array(
        'label' => 'Why Automatdo',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2L2 7v6l8 5 8-5V7l-8-5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 12V8M10 16v-1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'questions' => array(
            array(
                'q' => 'How is Automatdo different from a traditional call center?',
                'a' => 'Traditional call centers have limited hours, variable agent quality, and struggle to scale during peak demand. Automatdo provides 24/7/365 availability with zero hold times, consistent quality on every call, and instant scalability from 100 to 10,000+ daily calls without hiring or training. Our AI agents never call in sick, never have bad days, and deliver the same excellent service at 3 AM as they do at 3 PM—typically at 60-80% lower cost per call.'
            ),
            array(
                'q' => 'Why choose AI voice agents over IVR systems?',
                'a' => 'IVR systems force callers through rigid menu trees, can\'t answer questions, and fail when conversations go off-script. Automatdo\'s AI agents have natural conversations, understand context, answer questions intelligently, and handle unexpected situations gracefully. They can switch between 50+ languages mid-call, negotiate appointment times, and provide the personal touch that IVR systems simply cannot deliver—all while maintaining the cost efficiency and 24/7 availability of automated systems.'
            ),
            array(
                'q' => 'Can AI really replace human phone agents?',
                'a' => 'For many call types, yes. Our AI excels at appointment scheduling, information requests, lead qualification, order status inquiries, and compliance verifications—tasks that make up 70-80% of typical call volume. For complex situations requiring human judgment, the AI seamlessly transfers to your team with full conversation context. Think of it as your tireless first line of support that handles routine calls perfectly while ensuring humans focus on high-value interactions.'
            ),
            array(
                'q' => 'What makes Automatdo\'s voice technology special?',
                'a' => 'We use a real-time voice engine with sub-second latency, enabling natural, interruption-friendly conversations that feel human. Unlike older text-to-speech systems, our agents understand tone, handle overlapping speech, and respond with appropriate pacing and intonation. Combined with 50+ language support with instant switching, advanced speech recognition across accents, and continuous learning from every interaction, we deliver voice AI that callers actually enjoy talking to.'
            ),
            array(
                'q' => 'How quickly can I see ROI with Automatdo?',
                'a' => 'Most customers see positive ROI within the first month. Consider: if you\'re missing just 5 calls per day at an average job value of $500, that\'s $75,000 in annual lost revenue. Add in reduced staffing costs, eliminated overtime, and increased customer satisfaction from zero hold times, and the math becomes compelling quickly. We provide detailed analytics so you can track exactly how many calls we\'ve handled and appointments we\'ve booked.'
            ),
            array(
                'q' => 'How does Automatdo handle peak call volumes?',
                'a' => 'Unlike human teams that get overwhelmed during busy periods, our AI scales instantly and infinitely. Whether you receive 10 calls or 10,000 calls simultaneously, every caller gets immediate attention with zero wait time. This is especially valuable during seasonal surges (summer AC emergencies, post-holiday fitness inquiries), marketing campaign responses, or unexpected viral moments when traditional call centers would buckle.'
            ),
            array(
                'q' => 'What happens when the AI can\'t help a caller?',
                'a' => 'Our AI is designed to know its limits. When a situation requires human judgment—complex complaints, unusual requests, or caller preference—it seamlessly transfers the call to your team with a full summary of the conversation so far. No repetition required. You can customize escalation rules based on topics, sentiment, or specific phrases. The AI also learns from these escalations to improve over time.'
            ),
            array(
                'q' => 'Do callers know they\'re talking to AI?',
                'a' => 'Our AI identifies itself appropriately based on your preferences and regulatory requirements. However, most callers quickly forget they\'re talking to AI because the conversation is so natural. We\'ve found that callers primarily care about getting their issue resolved quickly and professionally—which our AI does exceptionally well. Many callers actually prefer the instant response and zero hold times over waiting for human agents.'
            ),
        ),
    ),
    'industries' => array(
        'label' => 'Industry Solutions',
        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="2" y="8" width="5" height="10" stroke="currentColor" stroke-width="1.5"/><rect x="7.5" y="4" width="5" height="14" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="2" width="5" height="16" stroke="currentColor" stroke-width="1.5"/></svg>',
        'questions' => array(
            array(
                'q' => 'How does Automatdo handle Third-Party Verification (TPV)?',
                'a' => 'Our TPV solution delivers 100% script adherence on every verification call. The AI executes your exact verification script—confirming identity, service address, rate plans, and capturing required disclosures—with complete consistency. Every call is recorded with full transcripts for compliance audits. We support both inbound and outbound TPV, integrate with your enrollment systems via API, and handle 50+ languages with instant switching for diverse customer bases.'
            ),
            array(
                'q' => 'Is the TPV solution compliant with energy industry regulations?',
                'a' => 'Yes. Our TPV agents are pre-configured for FCC regulations, state PUC requirements, and industry-specific compliance standards. We provide complete audit trails, call recordings, and transcripts for every verification. The AI never deviates from approved scripts, eliminating the compliance drift that occurs with human agents. We serve deregulated energy retailers, community solar programs, and telecommunications providers with full regulatory compliance.'
            ),
            array(
                'q' => 'How does Automatdo help fitness studios and gyms?',
                'a' => 'Our fitness solution captures every lead, even at 2 AM. The AI answers membership inquiries, explains pricing and tiers, describes amenities and class schedules, and books facility tours directly into your calendar. It integrates with gym management software like Mindbody, syncs with Google Calendar and Outlook, and captures lead details for follow-up. Since 40% of fitness inquiries happen outside business hours, you\'ll immediately see more booked tours and memberships.'
            ),
            array(
                'q' => 'What can the AI do for home service businesses?',
                'a' => 'For HVAC, plumbing, electrical, and cleaning companies, our AI handles everything from emergency dispatch to routine scheduling. It triages urgent calls (burst pipes, no AC in summer), provides safety guidance while dispatching technicians, books service appointments based on real-time availability, and captures quote requests with all relevant details. Integration with ServiceTitan and other field service software means jobs appear directly on your dispatch board.'
            ),
            array(
                'q' => 'Can the AI handle emergency calls for home services?',
                'a' => 'Absolutely—this is one of our strongest use cases. The AI immediately recognizes emergency situations, provides critical safety guidance (like how to shut off a water main), and dispatches your on-call technician within seconds. At 2 AM when a pipe bursts, your customer gets immediate help instead of voicemail. We\'ve had AI agents guide customers through emergency shutoffs while simultaneously dispatching technicians and keeping customers calm.'
            ),
            array(
                'q' => 'How does the AI know my business\'s specific services and pricing?',
                'a' => 'We customize each AI agent with your specific information: service offerings, pricing tiers, availability, service areas, team member details, and business policies. For fitness, that means your membership levels and class schedules. For home services, your service types and pricing guidelines. For TPV, your exact verification scripts. The AI learns your business during onboarding and can be updated anytime as your offerings change.'
            ),
            array(
                'q' => 'Can Automatdo integrate with my industry-specific software?',
                'a' => 'Yes. We integrate with major platforms across industries: Mindbody and gym management systems for fitness; ServiceTitan, Housecall Pro, and Jobber for home services; Salesforce and HubSpot for general CRM; plus Google Calendar, Outlook, and GoHighLevel for scheduling. Custom integrations via API and webhook are available for proprietary systems. Most standard integrations are completed within 1-2 weeks.'
            ),
            array(
                'q' => 'What results do businesses typically see in my industry?',
                'a' => 'Results vary by industry: TPV operations see dramatically lower cost per verification (often ~$0.60 vs $5-8 for human agents) with 100% script compliance. Fitness businesses typically capture 30-50% more leads by eliminating missed after-hours calls. Home service companies report 100% call answer rates and 30%+ more booked jobs from previously missed after-hours emergencies. We provide detailed analytics to track your specific results from day one.'
            ),
        ),
    ),
);

// Flatten FAQs for schema
$all_faqs = array();
foreach ($faq_categories as $cat) {
    foreach ($cat['questions'] as $faq) {
        $all_faqs[] = $faq;
    }
}
?>

    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php foreach ($all_faqs as $index => $faq): ?>
            {
                "@type": "Question",
                "name": <?php echo json_encode($faq['q']); ?>,
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": <?php echo json_encode($faq['a']); ?>
                }
            }<?php echo $index < count($all_faqs) - 1 ? ',' : ''; ?>
            <?php endforeach; ?>
        ]
    }
    </script>

    <!-- Main Content -->
    <main id="main-content" class="faq-page">
        <!-- FAQ Header -->
        <section class="faq-header-section">
            <div class="section-container">
                <div class="faq-header">
                    <span class="section-tag">Support</span>
                    <h1 class="faq-title">Frequently Asked Questions</h1>
                    <p class="faq-subtitle">
                        Everything you need to know about our AI voice agents.
                        Can't find what you're looking for? <a href="<?php echo home_url('/contact'); ?>" class="faq-contact-link">Contact our team</a>.
                    </p>
                </div>
            </div>
        </section>

        <!-- FAQ Content -->
        <section class="faq-content-section">
            <div class="section-container">
                <div class="faq-layout">
                    <!-- Category Navigation -->
                    <nav class="faq-nav" aria-label="FAQ Categories">
                        <div class="faq-nav-inner">
                            <?php $first = true; foreach ($faq_categories as $cat_id => $category): ?>
                            <button
                                class="faq-nav-item<?php echo $first ? ' active' : ''; ?>"
                                data-category="<?php echo esc_attr($cat_id); ?>"
                                aria-pressed="<?php echo $first ? 'true' : 'false'; ?>"
                            >
                                <span class="faq-nav-icon"><?php echo $category['icon']; ?></span>
                                <span class="faq-nav-label"><?php echo esc_html($category['label']); ?></span>
                            </button>
                            <?php $first = false; endforeach; ?>
                        </div>
                    </nav>

                    <!-- FAQ Accordions -->
                    <div class="faq-panels">
                        <?php $first = true; foreach ($faq_categories as $cat_id => $category): ?>
                        <div
                            class="faq-panel<?php echo $first ? ' active' : ''; ?>"
                            id="faq-panel-<?php echo esc_attr($cat_id); ?>"
                            data-category="<?php echo esc_attr($cat_id); ?>"
                            role="region"
                            aria-labelledby="faq-nav-<?php echo esc_attr($cat_id); ?>"
                        >
                            <div class="faq-list">
                                <?php foreach ($category['questions'] as $index => $faq): ?>
                                <div class="faq-item" data-index="<?php echo $index; ?>">
                                    <button
                                        class="faq-question"
                                        aria-expanded="false"
                                        aria-controls="faq-answer-<?php echo esc_attr($cat_id . '-' . $index); ?>"
                                    >
                                        <span class="faq-question-text"><?php echo esc_html($faq['q']); ?></span>
                                        <span class="faq-icon" aria-hidden="true">
                                            <span class="faq-icon-line faq-icon-horizontal"></span>
                                            <span class="faq-icon-line faq-icon-vertical"></span>
                                        </span>
                                    </button>
                                    <div
                                        class="faq-answer"
                                        id="faq-answer-<?php echo esc_attr($cat_id . '-' . $index); ?>"
                                        aria-hidden="true"
                                    >
                                        <div class="faq-answer-inner">
                                            <p><?php echo esc_html($faq['a']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $first = false; endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="faq-cta">
            <div class="section-container">
                <div class="cta-card">
                    <div class="cta-content">
                        <h2 class="cta-title">Still have questions?</h2>
                        <p class="cta-subtitle">
                            Our team is ready to help you find the perfect AI voice solution for your business.
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
