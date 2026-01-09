/**
 * Automatdo Home Services Page - "The Dispatch Board"
 * Interactions and animations for the dispatch-themed design
 */

document.addEventListener('DOMContentLoaded', () => {
    initServiceTabs();
    initScrollAnimations();
    initMetricCountUp();
    initFloatingLabels();
    initDispatchAnimation();
});

/**
 * Service type tab switching
 */
function initServiceTabs() {
    const tabs = document.querySelectorAll('.service-tab');
    const panels = document.querySelectorAll('.service-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const service = tab.dataset.service;

            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            // Update active panel
            panels.forEach(panel => {
                if (panel.dataset.service === service) {
                    panel.classList.add('active');
                } else {
                    panel.classList.remove('active');
                }
            });
        });
    });
}

/**
 * Scroll-triggered animations
 */
function initScrollAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -80px 0px',
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

    // Observe animatable elements with staggered delays
    const animateSelectors = [
        '.problem-card',
        '.flow-step',
        '.result-metric',
        '.testimonial-card'
    ];

    animateSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach((el, index) => {
            el.style.transitionDelay = `${index * 0.1}s`;
            observer.observe(el);
        });
    });
}

/**
 * Animate metric numbers counting up
 */
function initMetricCountUp() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const valueEl = entry.target.querySelector('.value-number');
                if (valueEl && valueEl.dataset.value) {
                    const endValue = parseInt(valueEl.dataset.value.replace(/,/g, ''));
                    animateValue(valueEl, 0, endValue, 2000);
                }
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.result-metric').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Animate a numeric value with easing
 */
function animateValue(element, start, end, duration) {
    // Check for reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        element.textContent = formatNumber(end);
        return;
    }

    const startTime = performance.now();

    function formatNumber(num) {
        if (num >= 1000) {
            return num.toLocaleString();
        }
        return num.toString();
    }

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Ease-out cubic
        const easeProgress = 1 - Math.pow(1 - progress, 3);

        const currentValue = Math.floor(start + (end - start) * easeProgress);
        element.textContent = formatNumber(currentValue);

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = formatNumber(end);
        }
    }

    requestAnimationFrame(update);
}

/**
 * Floating label form interactions
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

        // For select elements
        if (input.tagName === 'SELECT') {
            input.addEventListener('change', () => {
                if (input.value) {
                    label.classList.add('active');
                }
            });
        }
    });

    // Form submission
    const demoForm = document.querySelector('#demo-form');
    if (demoForm) {
        demoForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const button = demoForm.querySelector('button[type="submit"]');
            const originalHTML = button.innerHTML;

            button.innerHTML = 'Sending...';
            button.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                button.innerHTML = 'Request Sent!';
                button.classList.add('success');

                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                    button.classList.remove('success');
                    demoForm.reset();

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
 * Animate dispatch board elements
 */
function initDispatchAnimation() {
    const dispatchBoard = document.querySelector('.dispatch-board');
    if (!dispatchBoard) return;

    const jobCards = dispatchBoard.querySelectorAll('.job-card');
    const incomingSection = dispatchBoard.querySelector('.board-incoming');

    // Periodically update the incoming call animation
    if (incomingSection) {
        const callerTypes = [
            'Emergency call...',
            'New booking request...',
            'Quote inquiry...',
            'Service question...'
        ];

        let currentIndex = 0;

        setInterval(() => {
            const label = incomingSection.querySelector('.incoming-label');
            if (label) {
                // Fade out
                label.style.opacity = '0.5';

                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % callerTypes.length;
                    const svg = label.querySelector('svg').outerHTML;
                    label.innerHTML = svg + ' ' + callerTypes[currentIndex];
                    label.style.opacity = '1';
                }, 200);
            }
        }, 4000);
    }

    // Add subtle hover effects to job cards
    jobCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateX(4px)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateX(0)';
        });
    });
}

/**
 * Mini dispatch board animation in CTA
 */
function initMiniDispatch() {
    const miniDispatch = document.querySelector('.mini-dispatch');
    if (!miniDispatch) return;

    const jobs = miniDispatch.querySelectorAll('.mini-job:not(.incoming)');
    const statuses = ['completed', 'active', 'scheduled'];

    // Periodically update job statuses for visual interest
    setInterval(() => {
        jobs.forEach((job, index) => {
            const status = job.querySelector('.mini-status');
            if (status && Math.random() > 0.7) {
                // Occasionally change status
                const currentClass = Array.from(status.classList).find(c => statuses.includes(c));
                const currentIndex = statuses.indexOf(currentClass);
                const newIndex = (currentIndex + 1) % statuses.length;

                status.classList.remove(currentClass);
                status.classList.add(statuses[newIndex]);
            }
        });
    }, 5000);
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
 * Animate chaos items on hero load
 */
(function initChaosAnimation() {
    const chaosItems = document.querySelectorAll('.chaos-item');

    // Check for reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    // Add staggered entrance animation
    chaosItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';

        setTimeout(() => {
            item.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 200 + (index * 150));
    });
})();

/**
 * Animate dispatch board jobs on hero load
 */
(function initBoardAnimation() {
    const jobCards = document.querySelectorAll('.dispatch-board .job-card');

    // Check for reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    // Add staggered entrance animation
    jobCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(10px)';

        setTimeout(() => {
            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 600 + (index * 150));
    });
})();
