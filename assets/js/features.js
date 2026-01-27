/**
 * Automatdo Features Page JavaScript
 * Handles scroll-triggered animations, counters, and category tabs
 */

(function() {
    'use strict';

    // DOM Elements
    const spotlightFeatures = document.querySelectorAll('.spotlight-feature');
    const categoryTabs = document.querySelectorAll('.category-tab');
    const featureGrids = document.querySelectorAll('.feature-grid');
    const counters = document.querySelectorAll('.counter');

    /**
     * Initialize all features functionality
     */
    function init() {
        // Set up Intersection Observer for scroll animations
        setupScrollAnimations();

        // Set up category tabs
        setupCategoryTabs();

        // Set up counter animations
        setupCounters();
    }

    /**
     * Set up Intersection Observer for spotlight features
     */
    function setupScrollAnimations() {
        if (!('IntersectionObserver' in window)) {
            // Fallback: show all elements immediately
            spotlightFeatures.forEach(feature => feature.classList.add('visible'));
            return;
        }

        const observerOptions = {
            root: null,
            rootMargin: '-50px 0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');

                    // Trigger counter animation if this spotlight has counters
                    const countersInView = entry.target.querySelectorAll('.counter');
                    countersInView.forEach(counter => {
                        animateCounter(counter);
                    });
                }
            });
        }, observerOptions);

        spotlightFeatures.forEach(feature => {
            observer.observe(feature);
        });
    }

    /**
     * Set up category tab switching
     */
    function setupCategoryTabs() {
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const category = tab.dataset.category;

                // Update active tab
                categoryTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Update active grid
                featureGrids.forEach(grid => {
                    if (grid.dataset.category === category) {
                        grid.classList.add('active');
                    } else {
                        grid.classList.remove('active');
                    }
                });
            });
        });
    }

    /**
     * Set up counter animations with Intersection Observer
     */
    function setupCounters() {
        if (!('IntersectionObserver' in window)) {
            // Fallback: show final values immediately
            counters.forEach(counter => {
                counter.textContent = counter.dataset.target;
            });
            return;
        }

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    animateCounter(entry.target);
                }
            });
        }, observerOptions);

        // Only observe counters not inside spotlight features (they're handled separately)
        counters.forEach(counter => {
            if (!counter.closest('.spotlight-feature')) {
                counterObserver.observe(counter);
            }
        });
    }

    /**
     * Animate a counter from 0 to target value
     */
    function animateCounter(counter) {
        if (counter.classList.contains('counted')) return;

        const target = parseInt(counter.dataset.target, 10);
        const duration = 1500; // ms
        const startTime = performance.now();
        const startValue = 0;

        counter.classList.add('counted');

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function (ease-out)
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const currentValue = Math.floor(startValue + (target - startValue) * easeOut);

            counter.textContent = currentValue;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        }

        requestAnimationFrame(updateCounter);
    }

    /**
     * Handle keyboard navigation for category tabs
     */
    function handleTabKeyboard(e) {
        const tabs = Array.from(categoryTabs);
        const currentIndex = tabs.indexOf(document.activeElement);

        if (currentIndex === -1) return;

        let newIndex;

        switch (e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                newIndex = currentIndex > 0 ? currentIndex - 1 : tabs.length - 1;
                tabs[newIndex].focus();
                tabs[newIndex].click();
                break;
            case 'ArrowRight':
                e.preventDefault();
                newIndex = currentIndex < tabs.length - 1 ? currentIndex + 1 : 0;
                tabs[newIndex].focus();
                tabs[newIndex].click();
                break;
            case 'Home':
                e.preventDefault();
                tabs[0].focus();
                tabs[0].click();
                break;
            case 'End':
                e.preventDefault();
                tabs[tabs.length - 1].focus();
                tabs[tabs.length - 1].click();
                break;
        }
    }

    // Add keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (document.activeElement.classList.contains('category-tab')) {
            handleTabKeyboard(e);
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
