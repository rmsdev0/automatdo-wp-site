/**
 * Automatdo Contact Page JavaScript
 * FAQ accordion and form handling
 */

document.addEventListener('DOMContentLoaded', function() {
    // FAQ Accordion
    initFaqAccordion();

    // Smooth scroll to form when clicking FAQ CTA
    initSmoothScrollToForm();

    // Form validation feedback
    initFormValidation();
});

/**
 * Initialize FAQ Accordion
 */
function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        if (question && answer) {
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
                question.setAttribute('aria-expanded', !isActive);
            });
        }
    });
}

/**
 * Smooth scroll to contact form
 */
function initSmoothScrollToForm() {
    const faqCta = document.querySelector('.faq-cta a[href="#contact-form"]');

    if (faqCta) {
        faqCta.addEventListener('click', (e) => {
            e.preventDefault();
            const form = document.getElementById('contact-form');
            if (form) {
                const headerOffset = 100;
                const elementPosition = form.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Focus on first input after scroll
                setTimeout(() => {
                    const firstInput = form.querySelector('input');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }, 500);
            }
        });
    }
}

/**
 * Form validation and submission feedback
 */
function initFormValidation() {
    const form = document.getElementById('contact-form');

    if (form) {
        const inputs = form.querySelectorAll('input, select, textarea');

        // Add focus/blur effects
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
                if (input.value.trim() !== '') {
                    input.parentElement.classList.add('has-value');
                } else {
                    input.parentElement.classList.remove('has-value');
                }
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<span>Sending...</span>';
                submitBtn.disabled = true;
            }
        });
    }
}
