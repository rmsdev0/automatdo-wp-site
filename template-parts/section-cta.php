<?php
/**
 * Template part for CTA section
 *
 * @package Automatdo
 */
?>

<section class="cta" id="demo" aria-labelledby="cta-title">
    <div class="cta-container">
        <div class="cta-content">
            <h2 class="cta-title" id="cta-title">Don't Take Our Word for It. Hear It Yourself.</h2>
            <p class="cta-subtitle">
                Join the industry leaders automating scheduling, dispatch, and verification with zero latency. See exactly how it works for your specific use case.
            </p>

            <form class="demo-form" id="demo-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="demo-firstname">First Name</label>
                        <input type="text" id="demo-firstname" name="firstname" required placeholder="John">
                    </div>
                    <div class="form-group">
                        <label for="demo-lastname">Last Name</label>
                        <input type="text" id="demo-lastname" name="lastname" required placeholder="Smith">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="demo-email">Work Email</label>
                        <input type="email" id="demo-email" name="email" required placeholder="john@company.com">
                    </div>
                    <div class="form-group">
                        <label for="demo-company">Company Name</label>
                        <input type="text" id="demo-company" name="company" required placeholder="Company Inc.">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="demo-phone">Phone Number</label>
                        <input type="tel" id="demo-phone" name="phone" placeholder="+1 (555) 000-0000">
                    </div>
                    <div class="form-group">
                        <label for="demo-use-case">What Solution Are You Interested In?</label>
                        <select id="demo-use-case" name="use_case" required>
                            <option value="">Select an option</option>
                            <option value="Third-Party Verification (TPV)">Third-Party Verification (TPV)</option>
                            <option value="Contact Center / Customer Support">Contact Center / Customer Support</option>
                            <option value="Fitness / Gym Operations">Fitness / Gym Operations</option>
                            <option value="Home Services (HVAC, Plumbing, etc.)">Home Services (HVAC, Plumbing, etc.)</option>
                            <option value="Appointment Booking">Appointment Booking</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <!-- Honeypot field - hidden from humans, bots will fill it -->
                <div style="position: absolute; left: -9999px;" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>
                <button type="submit" class="btn-primary btn-large btn-full">
                    <span>Book Your Demo</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <p class="form-disclaimer">
                    By submitting, you agree to our <a href="<?php echo get_privacy_policy_url() ?: home_url('/privacy-policy/'); ?>">Terms of Service and Privacy Policy</a>.
                </p>
            </form>
        </div>

        <div class="cta-visual">
            <div class="cta-card">
                <div class="cta-card-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                        <path d="M20 18l10 6-10 6V18z" fill="currentColor"/>
                    </svg>
                </div>
                <h3>See it in action</h3>
                <p>Watch a live demo of our AI voice agents handling real calls.</p>
                <div class="cta-features">
                    <div class="cta-feature">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>15-minute personalized demo</span>
                    </div>
                    <div class="cta-feature">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Custom use case walkthrough</span>
                    </div>
                    <div class="cta-feature">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Pricing and ROI discussion</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
