/**
 * Automatdo TPV Page
 * Additional interactions and animations specific to TPV page
 */

document.addEventListener('DOMContentLoaded', () => {
    initTPVAnimations();
    initVerificationCardAnimation();
    initCountUpAnimation();
});

/**
 * Initialize scroll-triggered animations for TPV-specific elements
 */
function initTPVAnimations() {
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

    // Observe TPV-specific elements
    const animateElements = document.querySelectorAll(
        '.tpv-hero-visual, .problem-stat, .solution-feature-card, .industry-card, .workflow-step, .comparison-row'
    );

    animateElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * Animate the verification card steps
 */
function initVerificationCardAnimation() {
    const verificationCard = document.querySelector('.tpv-verification-card');
    if (!verificationCard) return;

    const steps = verificationCard.querySelectorAll('.progress-step');
    const timeDisplay = verificationCard.querySelector('.verification-time');

    let currentStep = 0;
    let seconds = 47;

    // Simulate verification progress
    function advanceStep() {
        if (currentStep >= steps.length - 1) {
            // Reset after completion
            setTimeout(() => {
                steps.forEach((step, index) => {
                    step.classList.remove('completed', 'active');
                    if (index < 3) {
                        step.classList.add('completed');
                    } else {
                        step.classList.add('active');
                    }
                });
                currentStep = 0;
                seconds = 47;
            }, 3000);
            return;
        }

        const activeStep = steps[currentStep + 1];
        const currentActiveStep = steps[currentStep];

        if (currentActiveStep && activeStep) {
            // Complete current step
            currentActiveStep.classList.remove('active');
            currentActiveStep.classList.add('completed');

            // Update indicator
            const indicator = currentActiveStep.querySelector('.step-indicator');
            if (indicator) {
                indicator.classList.remove('pulsing');
                indicator.innerHTML = `
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M3 7l2.5 2.5 5.5-5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                `;
            }

            // Activate next step
            activeStep.classList.remove('completed');
            activeStep.classList.add('active');
        }

        currentStep++;
    }

    // Update time display
    function updateTime() {
        seconds++;
        if (seconds >= 60) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            timeDisplay.textContent = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        } else {
            timeDisplay.textContent = `00:${String(seconds).padStart(2, '0')}`;
        }
    }

    // Start animation after a delay when card becomes visible
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Start the time counter
                setInterval(updateTime, 1000);

                // Advance through steps periodically
                setTimeout(() => advanceStep(), 4000);

                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    cardObserver.observe(verificationCard);
}

/**
 * Animate numbers counting up when they come into view
 */
function initCountUpAnimation() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const text = target.textContent;

                // Check if it's a number we should animate
                const match = text.match(/^(\$?)(\d+)(%?)$/);
                if (match) {
                    const prefix = match[1] || '';
                    const endValue = parseInt(match[2]);
                    const suffix = match[3] || '';

                    animateValue(target, 0, endValue, 1500, prefix, suffix);
                }

                observer.unobserve(target);
            }
        });
    }, observerOptions);

    // Observe problem stats numbers
    document.querySelectorAll('.problem-number').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Animate a numeric value from start to end
 */
function animateValue(element, start, end, duration, prefix = '', suffix = '') {
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Easing function (ease-out)
        const easeProgress = 1 - Math.pow(1 - progress, 3);

        const currentValue = Math.floor(start + (end - start) * easeProgress);
        element.textContent = `${prefix}${currentValue}${suffix}`;

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = `${prefix}${end}${suffix}`;
        }
    }

    requestAnimationFrame(update);
}

/**
 * Smooth scroll enhancement for TPV page internal links
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
