/**
 * Automatdo Landing Page
 * Interactive behaviors and animations
 */

/**
 * HubSpot Configuration (Required for form submissions)
 * Get these values from your HubSpot account:
 * - Portal ID: Settings > Account Management > Account Setup > Account Info
 * - Form GUID: Marketing > Forms > Create form > After saving, get ID from URL
 */
const HUBSPOT_CONFIG = {
    portalId: '244075216',
    formGuid: 'cf1883b6-ed7d-4b15-82a4-88e47b7a9175',
};

/**
 * Rate Limiting Configuration
 */
const RATE_LIMIT_CONFIG = {
    minTimeBetweenSubmissions: 30000,  // 30 seconds between submissions
    maxSubmissionsPerHour: 5,          // Max 5 submissions per hour
    storageKey: 'demo_form_submissions'
};

/**
 * UTM Parameter Tracking
 * Captures UTM parameters from URL and stores them for form submissions
 */
const UTM_PARAMS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];

function initUTMTracking() {
    const urlParams = new URLSearchParams(window.location.search);
    const utmData = {};
    let hasUTM = false;

    // Capture UTM parameters from URL
    UTM_PARAMS.forEach(param => {
        const value = urlParams.get(param);
        if (value) {
            utmData[param] = value;
            hasUTM = true;
        }
    });

    // Store in sessionStorage if we found any UTM params
    if (hasUTM) {
        sessionStorage.setItem('automatdo_utm', JSON.stringify(utmData));

        // Send to Google Analytics as custom event
        if (typeof gtag === 'function') {
            gtag('event', 'utm_captured', {
                'utm_source': utmData.utm_source || '',
                'utm_medium': utmData.utm_medium || '',
                'utm_campaign': utmData.utm_campaign || ''
            });
        }
    }

    return utmData;
}

function getStoredUTMParams() {
    try {
        const stored = sessionStorage.getItem('automatdo_utm');
        return stored ? JSON.parse(stored) : {};
    } catch {
        return {};
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Initialize UTM tracking first
    initUTMTracking();
    // Initialize all components
    initTheme();
    initNavigation();
    initSolutionTabs();
    initScrollAnimations();
    initDemoForm();
    initMobileMenu();
    initAudioPlayer();
});

/**
 * Theme switching functionality with localStorage persistence
 */
function initTheme() {
    const themeToggle = document.getElementById('theme-toggle');
    const mobileThemeToggle = document.querySelector('.theme-toggle-mobile');
    const html = document.documentElement;

    // Check for saved theme preference or default to system preference
    const savedTheme = localStorage.getItem('automatdo-theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Apply initial theme
    if (savedTheme) {
        html.setAttribute('data-theme', savedTheme);
    } else if (systemPrefersDark) {
        html.setAttribute('data-theme', 'dark');
    } else {
        html.setAttribute('data-theme', 'dark'); // Default to dark for this design
    }

    // Theme toggle handler
    function toggleTheme(toggleBtn) {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('automatdo-theme', newTheme);

        // Add a subtle animation feedback
        if (toggleBtn) {
            toggleBtn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                toggleBtn.style.transform = 'scale(1)';
            }, 150);
        }
    }

    // Toggle theme on button click (main toggle)
    if (themeToggle) {
        themeToggle.addEventListener('click', () => toggleTheme(themeToggle));
    }

    // Toggle theme on mobile button click
    if (mobileThemeToggle) {
        mobileThemeToggle.addEventListener('click', () => toggleTheme(mobileThemeToggle));
    }

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        // Only auto-switch if user hasn't manually set a preference
        if (!localStorage.getItem('automatdo-theme')) {
            html.setAttribute('data-theme', e.matches ? 'dark' : 'light');
        }
    });
}

/**
 * Navigation scroll behavior
 */
function initNavigation() {
    const nav = document.querySelector('.nav');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        // Add/remove scrolled class
        if (currentScroll > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    }, { passive: true });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                const navHeight = nav.offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                closeMobileMenu();
            }
        });
    });
}

/**
 * Solution tabs functionality
 */
function initSolutionTabs() {
    const tabs = document.querySelectorAll('.solution-tab');
    const panels = document.querySelectorAll('.solution-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetId = tab.dataset.tab;

            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            // Update active panel
            panels.forEach(panel => {
                panel.classList.remove('active');
                if (panel.id === `panel-${targetId}`) {
                    panel.classList.add('active');
                }
            });
        });
    });
}

/**
 * Scroll-triggered animations using Intersection Observer
 */
function initScrollAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements that should animate on scroll
    const animateElements = document.querySelectorAll(
        '.feature-card, .testimonial-card, .section-header, .solution-panel, .cta-content, .cta-visual'
    );

    animateElements.forEach(el => {
        el.classList.add('animate-target');
        observer.observe(el);
    });

    // Add animation styles
    const style = document.createElement('style');
    style.textContent = `
        .animate-target {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-target.animate-in {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card.animate-target { transition-delay: 0.1s; }
        .feature-card:nth-child(2).animate-target { transition-delay: 0.2s; }
        .feature-card:nth-child(3).animate-target { transition-delay: 0.3s; }
        .feature-card:nth-child(4).animate-target { transition-delay: 0.4s; }
        .feature-card:nth-child(5).animate-target { transition-delay: 0.5s; }
        .feature-card:nth-child(6).animate-target { transition-delay: 0.6s; }

        .testimonial-card:nth-child(1).animate-target { transition-delay: 0.1s; }
        .testimonial-card:nth-child(2).animate-target { transition-delay: 0.2s; }
        .testimonial-card:nth-child(3).animate-target { transition-delay: 0.3s; }
    `;
    document.head.appendChild(style);
}

/**
 * Demo form handling
 */
function initDemoForm() {
    const form = document.getElementById('demo-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;

        // Collect form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Honeypot check - if filled, it's a bot
        if (data.website && data.website.trim() !== '') {
            console.log('Bot detected via honeypot');
            // Silently "succeed" to not alert the bot
            showFormSuccess(form);
            return;
        }

        // Rate limiting check
        const rateLimitResult = checkRateLimit();
        if (!rateLimitResult.allowed) {
            showFormError(form, rateLimitResult.message);
            return;
        }

        // Show loading state
        submitBtn.innerHTML = `
            <span>Submitting...</span>
            <svg class="spinner" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="50" stroke-dashoffset="25">
                    <animateTransform attributeName="transform" type="rotate" from="0 10 10" to="360 10 10" dur="1s" repeatCount="indefinite"/>
                </circle>
            </svg>
        `;
        submitBtn.disabled = true;

        // Remove honeypot from data before submission
        delete data.website;

        try {
            // Validate HubSpot configuration
            if (!HUBSPOT_CONFIG.portalId || !HUBSPOT_CONFIG.formGuid) {
                throw new Error('HubSpot configuration is missing');
            }

            // Submit to HubSpot Forms API
            await submitToHubSpot(data);

            recordSubmission(); // Record successful submission for rate limiting

            // Track form submission in Google Analytics with UTM data
            if (typeof gtag === 'function') {
                const utmParams = getStoredUTMParams();
                gtag('event', 'demo_request', {
                    'event_category': 'Lead Generation',
                    'event_label': data.use_case || 'Not specified',
                    'utm_source': utmParams.utm_source || '(direct)',
                    'utm_medium': utmParams.utm_medium || '(none)',
                    'utm_campaign': utmParams.utm_campaign || '(not set)'
                });
            }

            showFormSuccess(form);
        } catch (error) {
            console.error('Form submission error:', error);
            // Reset button on error
            submitBtn.innerHTML = originalContent;
            submitBtn.disabled = false;
            showFormError(form, 'Something went wrong. Please try again.');
        }
    });
}

/**
 * Check if submission is allowed based on rate limits
 */
function checkRateLimit() {
    try {
        const stored = localStorage.getItem(RATE_LIMIT_CONFIG.storageKey);
        const submissions = stored ? JSON.parse(stored) : [];
        const now = Date.now();
        const oneHourAgo = now - 3600000;

        // Filter to only submissions within the last hour
        const recentSubmissions = submissions.filter(time => time > oneHourAgo);

        // Check if too many submissions in the last hour
        if (recentSubmissions.length >= RATE_LIMIT_CONFIG.maxSubmissionsPerHour) {
            return {
                allowed: false,
                message: 'Too many submissions. Please try again later.'
            };
        }

        // Check if submitted too recently
        if (recentSubmissions.length > 0) {
            const lastSubmission = Math.max(...recentSubmissions);
            const timeSinceLastSubmission = now - lastSubmission;

            if (timeSinceLastSubmission < RATE_LIMIT_CONFIG.minTimeBetweenSubmissions) {
                const waitSeconds = Math.ceil((RATE_LIMIT_CONFIG.minTimeBetweenSubmissions - timeSinceLastSubmission) / 1000);
                return {
                    allowed: false,
                    message: `Please wait ${waitSeconds} seconds before submitting again.`
                };
            }
        }

        return { allowed: true };
    } catch (e) {
        // If localStorage fails, allow submission
        return { allowed: true };
    }
}

/**
 * Record a successful submission for rate limiting
 */
function recordSubmission() {
    try {
        const stored = localStorage.getItem(RATE_LIMIT_CONFIG.storageKey);
        const submissions = stored ? JSON.parse(stored) : [];
        const now = Date.now();
        const oneHourAgo = now - 3600000;

        // Keep only recent submissions and add the new one
        const recentSubmissions = submissions.filter(time => time > oneHourAgo);
        recentSubmissions.push(now);

        localStorage.setItem(RATE_LIMIT_CONFIG.storageKey, JSON.stringify(recentSubmissions));
    } catch (e) {
        // Ignore localStorage errors
    }
}

/**
 * Submit form data to HubSpot Forms API
 */
async function submitToHubSpot(data) {
    const hubspotData = {
        fields: [
            { name: 'firstname', value: data.firstname || '' },
            { name: 'lastname', value: data.lastname || '' },
            { name: 'email', value: data.email || '' },
            { name: 'company', value: data.company || '' },  // Contact's company property
            { name: 'phone', value: data.phone || '' },
        ],
        context: {
            pageUri: window.location.href,
            pageName: document.title
        }
    };

    // Add use_case to the "Interest" field in HubSpot
    if (data.use_case) {
        hubspotData.fields.push({ name: 'interest', value: data.use_case });
    }

    // Add UTM parameters to HubSpot submission
    const utmParams = getStoredUTMParams();
    if (utmParams.utm_source) {
        hubspotData.fields.push({ name: 'hs_analytics_source', value: utmParams.utm_source });
    }
    if (utmParams.utm_medium) {
        hubspotData.fields.push({ name: 'utm_medium', value: utmParams.utm_medium });
    }
    if (utmParams.utm_campaign) {
        hubspotData.fields.push({ name: 'utm_campaign', value: utmParams.utm_campaign });
    }
    if (utmParams.utm_term) {
        hubspotData.fields.push({ name: 'utm_term', value: utmParams.utm_term });
    }
    if (utmParams.utm_content) {
        hubspotData.fields.push({ name: 'utm_content', value: utmParams.utm_content });
    }

    const response = await fetch(
        `https://api.hsforms.com/submissions/v3/integration/submit/${HUBSPOT_CONFIG.portalId}/${HUBSPOT_CONFIG.formGuid}`,
        {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(hubspotData)
        }
    );

    if (!response.ok) {
        const errorText = await response.text();
        console.error('HubSpot API error:', errorText);
        throw new Error('HubSpot submission failed');
    }

    return response.json();
}

/**
 * Show form error message
 */
function showFormError(form, message) {
    // Remove any existing error
    const existingError = form.querySelector('.form-error-message');
    if (existingError) existingError.remove();

    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error-message';
    errorDiv.style.cssText = 'color: #ef4444; padding: 0.75rem; margin-top: 1rem; background: rgba(239, 68, 68, 0.1); border-radius: 0.5rem; text-align: center;';
    errorDiv.textContent = message;
    form.appendChild(errorDiv);

    // Auto-remove after 5 seconds
    setTimeout(() => errorDiv.remove(), 5000);
}

/**
 * Show form success message
 */
function showFormSuccess(form) {
    const container = form.parentElement;
    form.style.display = 'none';

    const successMessage = document.createElement('div');
    successMessage.className = 'form-success';
    successMessage.innerHTML = `
        <div class="success-icon">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                <path d="M16 24l6 6 12-12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3>Thank you!</h3>
        <p>We've received your request and will be in touch within 24 hours to schedule your personalized demo.</p>
    `;

    // Add success styles
    const style = document.createElement('style');
    style.textContent = `
        .form-success {
            text-align: center;
            padding: 3rem 2rem;
            animation: fadeInUp 0.5s ease-out;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 50%;
            color: #22c55e;
        }
        .form-success h3 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .form-success p {
            color: #9d9da6;
            max-width: 400px;
            margin: 0 auto;
        }
    `;
    document.head.appendChild(style);

    container.appendChild(successMessage);
}

/**
 * Mobile menu functionality
 */
function initMobileMenu() {
    const toggle = document.querySelector('.nav-mobile-toggle');
    const nav = document.querySelector('.nav');

    if (!toggle) return;

    toggle.addEventListener('click', () => {
        nav.classList.toggle('mobile-open');
        toggle.classList.toggle('active');
    });

    // Add mobile menu styles
    const style = document.createElement('style');
    style.textContent = `
        .nav.mobile-open .nav-links {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(5, 5, 8, 0.98);
            backdrop-filter: blur(20px);
            padding: 1.5rem;
            gap: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* Light mode mobile menu background */
        [data-theme="light"] .nav.mobile-open .nav-links {
            background: rgba(255, 255, 255, 0.98);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .nav.mobile-open .nav-links .nav-link {
            padding: 0.75rem 0;
            font-size: 1.125rem;
        }

        .nav-mobile-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .nav-mobile-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .nav-mobile-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media (min-width: 769px) {
            .nav.mobile-open .nav-links {
                display: flex;
                flex-direction: row;
                position: static;
                background: none;
                padding: 0;
                gap: 2rem;
                border: none;
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Close mobile menu
 */
function closeMobileMenu() {
    const nav = document.querySelector('.nav');
    const toggle = document.querySelector('.nav-mobile-toggle');

    if (nav) nav.classList.remove('mobile-open');
    if (toggle) toggle.classList.remove('active');
}

/**
 * Typing animation for hero transcript (optional enhancement)
 */
function initTypingAnimation() {
    const typingElements = document.querySelectorAll('.transcript-line.typing .text');

    typingElements.forEach(el => {
        const text = el.textContent;
        el.textContent = '';

        let i = 0;
        function type() {
            if (i < text.length) {
                el.textContent += text.charAt(i);
                i++;
                setTimeout(type, 30 + Math.random() * 20);
            }
        }

        // Start typing after a delay
        setTimeout(type, 2000);
    });
}

/**
 * Parallax effect for gradient orbs
 */
function initParallax() {
    const orbs = document.querySelectorAll('.orb');

    window.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 2;
        const y = (e.clientY / window.innerHeight - 0.5) * 2;

        orbs.forEach((orb, index) => {
            const speed = (index + 1) * 10;
            orb.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
        });
    }, { passive: true });
}

// Initialize parallax on desktop only
if (window.innerWidth > 1024) {
    initParallax();
}

/**
 * Audio Player functionality
 */
function initAudioPlayer() {
    const audio = document.getElementById('audio-player');
    const playButton = document.getElementById('play-button');
    const progressBar = document.getElementById('progress-bar');
    const progressFill = document.getElementById('progress-fill');
    const progressHandle = document.getElementById('progress-handle');
    const currentTimeEl = document.getElementById('current-time');
    const durationEl = document.getElementById('duration');
    const audioStatus = document.getElementById('audio-status');
    const audioPlayerContainer = document.querySelector('.audio-player-compact');

    if (!audio || !playButton) return;

    // Format time as MM:SS
    function formatTime(seconds) {
        if (!isFinite(seconds)) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    // Update duration when metadata is loaded
    audio.addEventListener('loadedmetadata', () => {
        durationEl.textContent = formatTime(audio.duration);
    });

    // Play/Pause toggle
    playButton.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            audioPlayerContainer.classList.add('playing');
            audioStatus.innerHTML = '<span class="status-indicator"></span>Playing';
        } else {
            audio.pause();
            audioPlayerContainer.classList.remove('playing');
            audioStatus.innerHTML = '<span class="status-indicator"></span>Paused';
        }
    });

    // Update progress bar as audio plays
    audio.addEventListener('timeupdate', () => {
        const percent = (audio.currentTime / audio.duration) * 100;
        progressFill.style.width = `${percent}%`;
        progressHandle.style.left = `${percent}%`;
        currentTimeEl.textContent = formatTime(audio.currentTime);
    });

    // Seek functionality - click on progress bar
    progressBar.addEventListener('click', (e) => {
        const rect = progressBar.getBoundingClientRect();
        const percent = (e.clientX - rect.left) / rect.width;
        audio.currentTime = percent * audio.duration;
    });

    // Drag functionality for progress handle
    let isDragging = false;

    progressHandle.addEventListener('mousedown', (e) => {
        isDragging = true;
        e.preventDefault();
    });

    document.addEventListener('mousemove', (e) => {
        if (!isDragging) return;

        const rect = progressBar.getBoundingClientRect();
        let percent = (e.clientX - rect.left) / rect.width;
        percent = Math.max(0, Math.min(1, percent)); // Clamp between 0 and 1

        audio.currentTime = percent * audio.duration;
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
    });

    // Touch support for mobile
    progressBar.addEventListener('touchstart', (e) => {
        const touch = e.touches[0];
        const rect = progressBar.getBoundingClientRect();
        const percent = (touch.clientX - rect.left) / rect.width;
        audio.currentTime = Math.max(0, Math.min(1, percent)) * audio.duration;
    }, { passive: true });

    progressBar.addEventListener('touchmove', (e) => {
        const touch = e.touches[0];
        const rect = progressBar.getBoundingClientRect();
        const percent = (touch.clientX - rect.left) / rect.width;
        audio.currentTime = Math.max(0, Math.min(1, percent)) * audio.duration;
    }, { passive: true });

    // Keyboard support for play button (Space/Enter)
    playButton.addEventListener('keydown', (e) => {
        if (e.key === ' ' || e.key === 'Enter') {
            e.preventDefault();
            playButton.click();
        }
    });

    // Keyboard support for progress bar (Arrow keys)
    progressBar.setAttribute('tabindex', '0');
    progressBar.setAttribute('role', 'slider');
    progressBar.setAttribute('aria-label', 'Audio progress');
    progressBar.setAttribute('aria-valuemin', '0');
    progressBar.setAttribute('aria-valuemax', '100');
    progressBar.setAttribute('aria-valuenow', '0');

    progressBar.addEventListener('keydown', (e) => {
        const skipAmount = e.shiftKey ? 10 : 5; // Shift + arrow = 10s, arrow = 5s

        switch (e.key) {
            case 'ArrowRight':
            case 'ArrowUp':
                e.preventDefault();
                audio.currentTime = Math.min(audio.duration, audio.currentTime + skipAmount);
                break;
            case 'ArrowLeft':
            case 'ArrowDown':
                e.preventDefault();
                audio.currentTime = Math.max(0, audio.currentTime - skipAmount);
                break;
            case 'Home':
                e.preventDefault();
                audio.currentTime = 0;
                break;
            case 'End':
                e.preventDefault();
                audio.currentTime = audio.duration;
                break;
        }
    });

    // Update ARIA value as audio plays
    audio.addEventListener('timeupdate', () => {
        const percent = Math.round((audio.currentTime / audio.duration) * 100) || 0;
        progressBar.setAttribute('aria-valuenow', percent);
        progressBar.setAttribute('aria-valuetext', `${formatTime(audio.currentTime)} of ${formatTime(audio.duration)}`);
    });

    // Reset when audio ends
    audio.addEventListener('ended', () => {
        audioPlayerContainer.classList.remove('playing');
        audioStatus.innerHTML = '<span class="status-indicator"></span>Ready to play';
        progressFill.style.width = '0%';
        progressHandle.style.left = '0%';
        currentTimeEl.textContent = '0:00';
    });

    // Handle audio loading states
    audio.addEventListener('loadstart', () => {
        audioStatus.innerHTML = '<span class="status-indicator"></span>Loading...';
    });

    audio.addEventListener('canplay', () => {
        if (audio.paused) {
            audioStatus.innerHTML = '<span class="status-indicator"></span>Ready to play';
        }
    });

    audio.addEventListener('error', () => {
        audioStatus.innerHTML = '<span class="status-indicator"></span>Error loading audio';
        console.error('Audio failed to load. Please check the file path.');
    });
}
