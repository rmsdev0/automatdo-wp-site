<?php
/**
 * Privacy Policy Page Template
 *
 * @package Automatdo
 */

get_header();
?>

    <!-- Main Content -->
    <main id="main-content" class="legal-page">
        <!-- Page Header -->
        <section class="legal-header">
            <div class="section-container">
                <div class="legal-header-content">
                    <h1 class="legal-title"><?php the_title(); ?></h1>
                    <p class="legal-updated">Last updated: January 27, 2026</p>
                </div>
            </div>
        </section>

        <!-- Page Content -->
        <section class="legal-content">
            <div class="section-container">
                <div class="legal-body">
                    <h2>Overview</h2>
                    <p>Automatdo LLC ("Automatdo," "we," "us") provides AI voice agent software and related services for customer service, third-party verification (TPV), scheduling, and contact centers (the "Services"). This Privacy Policy explains how we collect, use, and share information when you visit our websites or use the Services.</p>
                    <p>This policy applies to our public websites and marketing pages, as well as the Automatdo platform used by customers and their end users. If you are using Automatdo through an organization, that organization may control your data and its own privacy practices may also apply.</p>

                    <h2>Information We Collect</h2>
                    <h3>Information you provide</h3>
                    <ul>
                        <li>Demo and contact requests: name, work email, company, phone number, use case, subject, and message.</li>
                        <li>Account and onboarding: name, email, role, login credentials, and billing or administrative contacts.</li>
                        <li>Customer content: call recordings, transcripts, call metadata, scripts, routing rules, and business information provided to configure agents.</li>
                    </ul>

                    <h3>Information collected automatically</h3>
                    <ul>
                        <li>Usage data: pages viewed, features used, timestamps, and interactions.</li>
                        <li>Device and network data: IP address, browser type, device identifiers, and operating system.</li>
                        <li>Cookies and similar technologies: necessary cookies and local storage used to remember preferences (such as theme) and session data, plus analytics or marketing tags when enabled.</li>
                    </ul>

                    <h3>Information from integrations</h3>
                    <p>If you connect third-party systems (CRMs, calendars, phone systems, or other business platforms), we may receive data from those systems as configured by the customer.</p>

                    <h2>How We Use Information</h2>
                    <ul>
                        <li>Provide, operate, and improve the Services, including call handling, scheduling, routing, and analytics.</li>
                        <li>Record and process calls, audio, and transcripts for the customer's use and compliance needs.</li>
                        <li>Respond to requests, provide customer support, and communicate about the Services.</li>
                        <li>Maintain security, prevent fraud or abuse, and enforce our policies.</li>
                        <li>Measure and improve marketing performance (for example, demo request analytics).</li>
                    </ul>

                    <h2>How We Share Information</h2>
                    <p>We share information only as needed to provide the Services or as required by law, including:</p>
                    <ul>
                        <li>Service providers that support hosting, analytics, customer relationship management, email delivery, and customer support.</li>
                        <li>Telephony, transcription, or AI model providers used to process voice interactions on behalf of customers.</li>
                        <li>Professional advisors (legal, accounting) and authorities when required to comply with law.</li>
                        <li>In connection with a merger, acquisition, or asset sale, subject to standard protections.</li>
                    </ul>
                    <p>We do not sell personal information and do not use personal information for cross-context behavioral advertising at this time.</p>

                    <h2>Cookies and Tracking</h2>
                    <p>We use cookies, local storage, and similar technologies for essential site functionality, preferences, and analytics. For example, we store theme preferences locally and may collect UTM parameters and demo request events for measurement. We also may use tools such as HubSpot for demo form processing and Google Analytics for site performance. You can control cookies through your browser settings. Some features may not function properly if you block or delete cookies.</p>

                    <h2>Data Retention</h2>
                    <p>We retain data for as long as necessary to provide the Services and as instructed by customers. By default, customer data is retained unless the customer requests deletion or configures a different retention period. We may retain certain records longer for legal, security, or operational reasons.</p>

                    <h2>Data Location</h2>
                    <p>Service data is stored in U.S. data centers (us-east-1). If you access the Services from outside the United States, your information may be transferred to, stored, and processed in the United States.</p>

                    <h2>Security</h2>
                    <p>We use reasonable administrative, technical, and physical safeguards designed to protect information. No method of transmission or storage is completely secure, and we cannot guarantee absolute security.</p>

                    <h2>Your Rights and Choices (U.S. States)</h2>
                    <p>Depending on your state of residence, you may have rights to access, correct, delete, or obtain a copy of your personal information, and to opt out of certain processing. If you are an end user whose information is processed by an Automatdo customer, please direct your request to that customer. Automatdo will assist customers in responding to verified requests.</p>

                    <h2>Children's Privacy</h2>
                    <p>The Services are not intended for individuals under 18, and we do not knowingly collect personal information from children.</p>

                    <h2>Changes to This Policy</h2>
                    <p>We may update this policy from time to time. We will post the updated version on this page and update the "Last updated" date above.</p>

                    <h2>Contact Us</h2>
                    <p>Automatdo LLC<br>Woodbury, Minnesota, USA</p>
                    <p>Email: <a href="mailto:info@automatdo.com">info@automatdo.com</a></p>
                </div>
            </div>
        </section>

        <!-- Back to Home CTA -->
        <section class="legal-cta">
            <div class="section-container">
                <div class="legal-cta-content">
                    <p>Have questions about our policies?</p>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn-primary">
                        <span>Contact Us</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
?>
