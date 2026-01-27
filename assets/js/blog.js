/**
 * Automatdo Blog
 * Interactive behaviors for blog pages
 */

document.addEventListener('DOMContentLoaded', () => {
    initCategoryFilters();
    initScrollAnimations();
});

/**
 * Category filter functionality
 */
function initCategoryFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const posts = document.querySelectorAll('.post-card, .featured-post');
    const postsCount = document.querySelector('.posts-count');

    if (!filterButtons.length) return;

    filterButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            if (button.tagName === 'A' && !(event.metaKey || event.ctrlKey || event.shiftKey || event.altKey)) {
                event.preventDefault();
            }
            const filter = button.dataset.filter;

            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Filter posts
            let visibleCount = 0;
            posts.forEach(post => {
                const category = post.dataset.category;
                const shouldShow = filter === 'all' || category === filter;

                if (shouldShow) {
                    post.style.display = '';
                    post.style.opacity = '0';
                    post.style.transform = 'translateY(20px)';

                    // Staggered animation
                    setTimeout(() => {
                        post.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                        post.style.opacity = '1';
                        post.style.transform = 'translateY(0)';
                    }, visibleCount * 100);

                    visibleCount++;
                } else {
                    post.style.display = 'none';
                }
            });

            // Update count
            if (postsCount) {
                const totalPosts = document.querySelectorAll('.post-card').length;
                const countText = filter === 'all'
                    ? `Showing ${visibleCount} of ${totalPosts + 1} articles`
                    : `Showing ${visibleCount} articles in ${button.textContent}`;
                postsCount.textContent = countText;
            }
        });
    });
}

/**
 * Scroll-triggered animations for blog elements
 */
function initScrollAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -50px 0px',
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

    // Observe blog-specific elements
    const animateElements = document.querySelectorAll(
        '.post-card, .featured-post, .blog-cta-card, .article-content > *'
    );

    animateElements.forEach((el, index) => {
        if (!el.classList.contains('animate-target')) {
            el.classList.add('animate-target');
            el.style.transitionDelay = `${index * 0.05}s`;
            observer.observe(el);
        }
    });
}

/**
 * Reading progress indicator (for article pages)
 */
function initReadingProgress() {
    const progressBar = document.querySelector('.reading-progress-bar');
    const article = document.querySelector('.article-content');

    if (!progressBar || !article) return;

    window.addEventListener('scroll', () => {
        const articleRect = article.getBoundingClientRect();
        const articleTop = articleRect.top + window.pageYOffset;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrolled = window.pageYOffset;

        // Calculate progress through the article
        const progress = Math.min(
            Math.max(
                (scrolled - articleTop + windowHeight * 0.3) / articleHeight,
                0
            ),
            1
        );

        progressBar.style.transform = `scaleX(${progress})`;
    }, { passive: true });
}

/**
 * Copy link functionality for article headings
 */
function initHeadingLinks() {
    const headings = document.querySelectorAll('.article-content h2, .article-content h3');

    headings.forEach(heading => {
        if (!heading.id) {
            // Generate ID from heading text
            heading.id = heading.textContent
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }

        // Add copy link button
        const linkBtn = document.createElement('button');
        linkBtn.className = 'heading-link-btn';
        linkBtn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M6.5 9.5L9.5 6.5M7 4.5L8.5 3C9.88071 1.61929 12.1193 1.61929 13.5 3C14.8807 4.38071 14.8807 6.61929 13.5 8L12 9.5M4.5 7L3 8.5C1.61929 9.88071 1.61929 12.1193 3 13.5C4.38071 14.8807 6.61929 14.8807 8 13.5L9.5 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        `;
        linkBtn.setAttribute('aria-label', 'Copy link to section');
        linkBtn.addEventListener('click', () => {
            const url = `${window.location.origin}${window.location.pathname}#${heading.id}`;
            navigator.clipboard.writeText(url).then(() => {
                linkBtn.classList.add('copied');
                setTimeout(() => linkBtn.classList.remove('copied'), 2000);
            });
        });

        heading.appendChild(linkBtn);
    });

    // Add styles for heading links
    const style = document.createElement('style');
    style.textContent = `
        .article-content h2,
        .article-content h3 {
            position: relative;
        }

        .heading-link-btn {
            position: absolute;
            left: -28px;
            top: 50%;
            transform: translateY(-50%);
            padding: 4px;
            background: transparent;
            border: none;
            color: var(--text-tertiary);
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease, color 0.2s ease;
        }

        .article-content h2:hover .heading-link-btn,
        .article-content h3:hover .heading-link-btn {
            opacity: 1;
        }

        .heading-link-btn:hover {
            color: var(--accent-primary);
        }

        .heading-link-btn.copied {
            color: var(--success);
        }

        @media (max-width: 768px) {
            .heading-link-btn {
                display: none;
            }
        }
    `;
    document.head.appendChild(style);
}

// Initialize article-specific features if on an article page
if (document.querySelector('.article-content')) {
    initReadingProgress();
    initHeadingLinks();
}
