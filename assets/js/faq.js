/**
 * Automatdo FAQ Page JavaScript
 * Handles accordion interactions and category navigation
 */

(function() {
    'use strict';

    // DOM Elements
    const navItems = document.querySelectorAll('.faq-nav-item');
    const panels = document.querySelectorAll('.faq-panel');
    const faqItems = document.querySelectorAll('.faq-item');

    /**
     * Initialize FAQ functionality
     */
    function init() {
        // Category navigation
        navItems.forEach(item => {
            item.addEventListener('click', handleCategoryClick);
        });

        // Accordion functionality
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            if (question) {
                question.addEventListener('click', () => handleAccordionClick(item));
            }
        });

        // Handle keyboard navigation
        document.addEventListener('keydown', handleKeyboardNavigation);

        // Handle URL hash for deep linking
        handleHashNavigation();
    }

    /**
     * Handle category navigation click
     */
    function handleCategoryClick(e) {
        const button = e.currentTarget;
        const category = button.dataset.category;

        // Update nav items
        navItems.forEach(item => {
            const isActive = item === button;
            item.classList.toggle('active', isActive);
            item.setAttribute('aria-pressed', isActive);
        });

        // Update panels with animation
        panels.forEach(panel => {
            const isActive = panel.dataset.category === category;

            if (isActive) {
                panel.classList.add('active');
                // Re-trigger animations for FAQ items
                const items = panel.querySelectorAll('.faq-item');
                items.forEach((item, index) => {
                    item.style.animation = 'none';
                    item.offsetHeight; // Trigger reflow
                    item.style.animation = '';
                });
            } else {
                panel.classList.remove('active');
            }
        });

        // Close all open accordions when switching categories
        faqItems.forEach(item => {
            closeAccordion(item);
        });

        // Update URL hash
        history.replaceState(null, null, `#${category}`);
    }

    /**
     * Handle accordion toggle
     */
    function handleAccordionClick(item) {
        const isOpen = item.classList.contains('open');
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        if (isOpen) {
            closeAccordion(item);
        } else {
            // Close other accordions in the same panel (optional: comment out for multi-open)
            const panel = item.closest('.faq-panel');
            if (panel) {
                panel.querySelectorAll('.faq-item.open').forEach(openItem => {
                    if (openItem !== item) {
                        closeAccordion(openItem);
                    }
                });
            }

            openAccordion(item);
        }
    }

    /**
     * Open an accordion item
     */
    function openAccordion(item) {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        item.classList.add('open');
        question.setAttribute('aria-expanded', 'true');
        answer.setAttribute('aria-hidden', 'false');
    }

    /**
     * Close an accordion item
     */
    function closeAccordion(item) {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        item.classList.remove('open');
        question.setAttribute('aria-expanded', 'false');
        answer.setAttribute('aria-hidden', 'true');
    }

    /**
     * Handle keyboard navigation
     */
    function handleKeyboardNavigation(e) {
        const activeElement = document.activeElement;

        // Only handle if focus is on a FAQ question
        if (!activeElement.classList.contains('faq-question')) {
            return;
        }

        const item = activeElement.closest('.faq-item');
        const panel = item.closest('.faq-panel');
        const items = Array.from(panel.querySelectorAll('.faq-item'));
        const currentIndex = items.indexOf(item);

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                if (currentIndex < items.length - 1) {
                    items[currentIndex + 1].querySelector('.faq-question').focus();
                }
                break;
            case 'ArrowUp':
                e.preventDefault();
                if (currentIndex > 0) {
                    items[currentIndex - 1].querySelector('.faq-question').focus();
                }
                break;
            case 'Home':
                e.preventDefault();
                items[0].querySelector('.faq-question').focus();
                break;
            case 'End':
                e.preventDefault();
                items[items.length - 1].querySelector('.faq-question').focus();
                break;
        }
    }

    /**
     * Handle URL hash for deep linking to categories
     */
    function handleHashNavigation() {
        const hash = window.location.hash.slice(1);
        if (hash) {
            const targetNav = Array.from(navItems).find(item => item.dataset.category === hash);
            if (targetNav) {
                targetNav.click();
            }
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
