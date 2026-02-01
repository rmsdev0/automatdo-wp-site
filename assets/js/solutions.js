/**
 * Solutions Page JavaScript
 * Handles voice demo triggers and page interactions
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        initSolutionDemos();
        initSmoothScroll();
        initProgressBars();
    });

    /**
     * Initialize voice demo triggers from solution cards
     * This works with the existing voice-demo.js widget
     */
    function initSolutionDemos() {
        const demoButtons = document.querySelectorAll('.solution-demo-btn');
        
        demoButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const agentId = this.dataset.agent;
                
                // Check if voice demo widget is available
                if (typeof window.voiceDemo !== 'undefined' && window.voiceDemo) {
                    // Open the voice demo
                    window.voiceDemo.open();
                    
                    // Select the appropriate agent
                    setTimeout(() => {
                        window.voiceDemo.selectAgent(agentId);
                    }, 100);
                    
                    // Track the interaction (if analytics is available)
                    trackDemoClick(agentId);
                } else {
                    // Fallback: Scroll to demo section or show message
                    console.log('Voice demo not available. Agent:', agentId);
                    
                    // Try to find and click the main voice demo trigger
                    const mainTrigger = document.querySelector('.voice-demo-trigger');
                    if (mainTrigger) {
                        mainTrigger.click();
                    } else {
                        // Show a message to the user
                        showNotification('Demo temporarily unavailable. Please try again later.');
                    }
                }
            });
        });
    }

    /**
     * Initialize smooth scroll for anchor links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    const navHeight = document.querySelector('.nav').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Animate progress bars when they come into view
     */
    function initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-fill');
        
        if (!progressBars.length) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const targetWidth = bar.style.width;
                    
                    // Reset and animate
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = targetWidth;
                    }, 100);
                    
                    observer.unobserve(bar);
                }
            });
        }, {
            threshold: 0.5
        });
        
        progressBars.forEach(bar => observer.observe(bar));
    }

    /**
     * Track demo clicks for analytics
     */
    function trackDemoClick(agentId) {
        // Microsoft Clarity tracking
        if (typeof window.clarity !== 'undefined') {
            window.clarity('event', 'solution_demo_click', {
                agent: agentId
            });
        }
        
        // Google Analytics 4 tracking (if available)
        if (typeof window.gtag !== 'undefined') {
            window.gtag('event', 'solution_demo_click', {
                agent_type: agentId,
                page: 'solutions'
            });
        }
        
        // Custom event for other analytics
        document.dispatchEvent(new CustomEvent('solutionDemoClick', {
            detail: { agent: agentId }
        }));
    }

    /**
     * Show notification message
     */
    function showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'solutions-notification';
        notification.textContent = message;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: var(--bg-elevated, #1f1f23);
            border: 1px solid var(--border-medium, rgba(255,255,255,0.1));
            border-radius: var(--radius-md, 10px);
            color: var(--text-primary, #fafafa);
            font-size: 0.9375rem;
            z-index: 9999;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
            animation: slideIn 0.3s ease;
        `;
        
        // Add animation keyframes
        if (!document.getElementById('notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideIn 0.3s ease reverse';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    /**
     * Add scroll animation for solution cards
     */
    function initScrollAnimations() {
        const cards = document.querySelectorAll('.solution-card');
        
        if (!cards.length) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Stagger animation
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    }

    // Initialize scroll animations
    initScrollAnimations();

})();