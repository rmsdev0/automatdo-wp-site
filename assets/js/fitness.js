/**
 * Automatdo Fitness Page - "The Pulse" Design
 * Energetic animations and interactions for the fitness & wellness page
 */

document.addEventListener('DOMContentLoaded', () => {
    initScrollAnimations();
    initImpactCountUp();
    initConversationAnimation();
    initHorizontalScroll();
    initFloatingLabels();
    initParallaxEffects();
});

/**
 * Initialize scroll-triggered animations for page elements
 */
function initScrollAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -80px 0px',
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animatable elements
    const animateElements = document.querySelectorAll(
        '.impact-stat, .timeline-item, .feature-row, .audience-card, .testimonial-quote, .cta-card'
    );

    animateElements.forEach((el, index) => {
        // Add staggered delay based on position
        el.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(el);
    });
}

/**
 * Animate large impact numbers counting up when visible
 */
function initImpactCountUp() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const text = target.textContent.trim();

                // Parse different number formats: 67%, $2,400, 24/7, 3x
                let match;

                // Percentage format (67%)
                if ((match = text.match(/^(\d+)%$/))) {
                    animateValue(target, 0, parseInt(match[1]), 2000, '', '%');
                }
                // Dollar format ($2,400)
                else if ((match = text.match(/^\$(\d+(?:,\d{3})*)$/))) {
                    const value = parseInt(match[1].replace(/,/g, ''));
                    animateValue(target, 0, value, 2000, '$', '');
                }
                // Multiplier format (3x)
                else if ((match = text.match(/^(\d+)x$/))) {
                    animateValue(target, 0, parseInt(match[1]), 1500, '', 'x');
                }
                // Plain number
                else if ((match = text.match(/^(\d+(?:,\d{3})*)$/))) {
                    const value = parseInt(match[1].replace(/,/g, ''));
                    animateValue(target, 0, value, 2000, '', '');
                }
                // Special format like 24/7 - just fade in
                else {
                    target.style.opacity = '0';
                    target.style.transform = 'translateY(20px)';
                    requestAnimationFrame(() => {
                        target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        target.style.opacity = '1';
                        target.style.transform = 'translateY(0)';
                    });
                }

                observer.unobserve(target);
            }
        });
    }, observerOptions);

    // Observe impact numbers
    document.querySelectorAll('.impact-number').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Animate a numeric value with easing
 */
function animateValue(element, start, end, duration, prefix = '', suffix = '') {
    const startTime = performance.now();

    // Check for reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        element.textContent = `${prefix}${formatNumber(end)}${suffix}`;
        return;
    }

    function formatNumber(num) {
        if (num >= 1000) {
            return num.toLocaleString();
        }
        return num.toString();
    }

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Elastic ease-out for energetic feel
        const easeProgress = 1 - Math.pow(1 - progress, 4);

        const currentValue = Math.floor(start + (end - start) * easeProgress);
        element.textContent = `${prefix}${formatNumber(currentValue)}${suffix}`;

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = `${prefix}${formatNumber(end)}${suffix}`;
        }
    }

    requestAnimationFrame(update);
}

/**
 * Animate conversation messages appearing one by one
 */
function initConversationAnimation() {
    const conversationCard = document.querySelector('.conversation-card');
    if (!conversationCard) return;

    const messages = conversationCard.querySelectorAll('.msg');
    const typingIndicator = conversationCard.querySelector('.typing-indicator');

    // Hide all messages initially
    messages.forEach(msg => {
        msg.style.opacity = '0';
        msg.style.transform = 'translateY(10px)';
    });

    if (typingIndicator) {
        typingIndicator.style.opacity = '0';
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateConversation(messages, typingIndicator);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    observer.observe(conversationCard);
}

/**
 * Sequentially animate conversation messages
 */
function animateConversation(messages, typingIndicator) {
    const baseDelay = 600;

    messages.forEach((msg, index) => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            msg.style.opacity = '1';
            msg.style.transform = 'translateY(0)';
        }, index * baseDelay);
    });

    // Show typing indicator after all messages
    if (typingIndicator) {
        setTimeout(() => {
            typingIndicator.style.transition = 'opacity 0.3s ease';
            typingIndicator.style.opacity = '1';
        }, messages.length * baseDelay + 200);
    }
}

/**
 * Initialize horizontal scroll indicators and drag functionality
 */
function initHorizontalScroll() {
    const scrollContainer = document.querySelector('.audience-scroll');
    if (!scrollContainer) return;

    let isDown = false;
    let startX;
    let scrollLeft;

    // Mouse drag scrolling
    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.classList.add('dragging');
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.classList.remove('dragging');
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.classList.remove('dragging');
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 1.5;
        scrollContainer.scrollLeft = scrollLeft - walk;
    });

    // Add scroll hint animation
    const scrollHint = document.createElement('div');
    scrollHint.className = 'scroll-hint';
    scrollHint.innerHTML = '<span>Scroll →</span>';
    scrollContainer.parentElement.appendChild(scrollHint);

    // Hide hint after user scrolls
    scrollContainer.addEventListener('scroll', () => {
        if (scrollContainer.scrollLeft > 50) {
            scrollHint.style.opacity = '0';
        }
    }, { passive: true });
}

/**
 * Initialize floating label interactions for the CTA form
 */
function initFloatingLabels() {
    const formFields = document.querySelectorAll('.form-field');

    formFields.forEach(field => {
        const input = field.querySelector('input, select');
        const label = field.querySelector('label');

        if (!input || !label) return;

        // Check initial state
        if (input.value) {
            label.classList.add('active');
        }

        input.addEventListener('focus', () => {
            label.classList.add('active');
        });

        input.addEventListener('blur', () => {
            if (!input.value) {
                label.classList.remove('active');
            }
        });

        // Handle autofill
        input.addEventListener('animationstart', (e) => {
            if (e.animationName === 'onAutoFillStart') {
                label.classList.add('active');
            }
        });
    });

    // Form submission
    const fitForm = document.querySelector('.fit-form');
    if (fitForm) {
        fitForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const button = fitForm.querySelector('button[type="submit"]');
            const originalText = button.textContent;

            button.textContent = 'Sending...';
            button.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                button.textContent = 'Request Sent!';
                button.classList.add('success');

                setTimeout(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                    button.classList.remove('success');
                    fitForm.reset();

                    // Reset labels
                    formFields.forEach(field => {
                        const label = field.querySelector('label');
                        if (label) label.classList.remove('active');
                    });
                }, 2000);
            }, 1500);
        });
    }
}

/**
 * Add subtle parallax effects to hero elements
 */
function initParallaxEffects() {
    const heroPhone = document.querySelector('.fit-hero-phone');
    const heroDiagonal = document.querySelector('.hero-diagonal');

    if (!heroPhone && !heroDiagonal) return;

    // Check for reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    let ticking = false;

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const heroSection = document.querySelector('.fit-hero');

                if (heroSection) {
                    const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

                    // Only apply parallax while hero is visible
                    if (scrolled < heroBottom) {
                        if (heroPhone) {
                            const phoneOffset = scrolled * 0.15;
                            heroPhone.style.transform = `translateY(calc(-50% + ${phoneOffset}px)) rotate(6deg)`;
                        }
                    }
                }

                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
}

/**
 * Smooth scroll for internal links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;

        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            const nav = document.querySelector('.nav');
            const navHeight = nav ? nav.offsetHeight : 0;
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 20;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

/**
 * Add energy pulse effect to CTA buttons on hover
 */
document.querySelectorAll('.btn-primary').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.animation = 'none';
        requestAnimationFrame(() => {
            this.style.animation = '';
        });
    });
});
