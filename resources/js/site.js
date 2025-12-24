import '../css/site.css';
import mediumZoom from "medium-zoom";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Dark Mode Alpine Component
Alpine.data('darkMode', () => ({
    dark: false,
    init() {
        // Check localStorage or system preference
        this.dark = localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

        // Watch for system preference changes (only if no manual preference set)
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!('theme' in localStorage)) {
                this.dark = e.matches;
            }
        });
    },
    toggle() {
        this.dark = !this.dark;
        localStorage.theme = this.dark ? 'dark' : 'light';
    }
}));

Alpine.start();

mediumZoom(document.querySelectorAll('[data-zoomable]'), {
    margin: 25,
    background: "rgba(33, 37, 48, 0.50)",
})

// Make article headings linkable with anchor tags and add scroll-to-top
document.addEventListener('DOMContentLoaded', () => {
    const articleContent = document.querySelector('.article-content');
    if (!articleContent) return;

    const headings = articleContent.querySelectorAll('h1, h2, h3, h4, h5, h6');
    const scrollToTopButtons = []; // Collect all buttons for scroll visibility

    headings.forEach(heading => {
        // Skip custom heading sets (numbered headings from bard)
        if (heading.querySelector('.font-index')) return;

        // Get text content, handling nested elements like <strong>
        const text = heading.textContent.trim();
        if (!text) return;

        // Generate slug from text
        const slug = text
            .toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-')     // Replace spaces with hyphens
            .replace(/-+/g, '-')      // Replace multiple hyphens with single
            .trim();

        // Set ID on heading
        heading.id = slug;
        heading.classList.add('scroll-mt-24');

        // Wrap content in anchor tag
        const anchor = document.createElement('a');
        anchor.href = `#${slug}`;
        anchor.innerHTML = heading.innerHTML;
        heading.innerHTML = '';
        heading.appendChild(anchor);

        // Click handler to update URL
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            history.pushState(null, '', `#${slug}`);
            heading.scrollIntoView({ behavior: 'smooth' });
        });

        // Add scroll-to-top button only for h1 and h2
        const tagName = heading.tagName.toLowerCase();
        if (tagName === 'h1' || tagName === 'h2') {
            const scrollToTop = document.createElement('a');
            scrollToTop.href = '#top';
            // Initially hidden until user scrolls
            scrollToTop.className = 'scroll-to-top-btn scroll-to-top-hidden';
            scrollToTop.dataset.tooltip = document.documentElement.lang === 'tr' ? 'Başa dön' : 'Scroll to top';
            scrollToTop.innerHTML = '<svg viewBox="0 0 256 256" fill="currentColor"><path d="M204.4,51.6a108,108,0,1,0,0,152.8A108.16,108.16,0,0,0,204.4,51.6Zm-17,135.82a84,84,0,1,1,0-118.84A84.12,84.12,0,0,1,187.42,187.42ZM168.5,159.53a12,12,0,0,1-17,17L128,153l-23.53,23.53a12,12,0,0,1-17-17l32-32a12,12,0,0,1,17,0Zm0-56a12,12,0,1,1-17,17L128,97l-23.53,23.52a12,12,0,1,1-17-17l32-32a12,12,0,0,1,17,0Z"/></svg>';
            scrollToTop.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                // Fast scroll to top
                const start = window.scrollY;
                const duration = 200; // 200ms - very fast
                const startTime = performance.now();

                function scroll(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease out quad
                    const easeOut = 1 - (1 - progress) * (1 - progress);
                    window.scrollTo(0, start * (1 - easeOut));
                    if (progress < 1) requestAnimationFrame(scroll);
                }
                requestAnimationFrame(scroll);
            });
            heading.appendChild(scrollToTop);
            scrollToTopButtons.push(scrollToTop);
        }
    });

    // Show/hide scroll-to-top buttons based on scroll position
    if (scrollToTopButtons.length > 0) {
        let hasScrolled = false;

        const updateButtonVisibility = () => {
            const shouldShow = window.scrollY > 50;
            if (shouldShow && !hasScrolled) {
                hasScrolled = true;
                scrollToTopButtons.forEach(btn => btn.classList.remove('scroll-to-top-hidden'));
            } else if (!shouldShow && hasScrolled) {
                hasScrolled = false;
                scrollToTopButtons.forEach(btn => btn.classList.add('scroll-to-top-hidden'));
            }
        };

        window.addEventListener('scroll', updateButtonVisibility, { passive: true });
        // Check initial state
        updateButtonVisibility();
    }
});

// Prevent sidenotes from overlapping
function adjustSidenotes() {
    const articleContent = document.querySelector('.article-content');
    if (!articleContent) return;

    const allSidenotes = Array.from(articleContent.querySelectorAll('.sidenote'));

    // On narrow screens, reset all transforms and return
    if (window.innerWidth < 1440) {
        allSidenotes.forEach(note => {
            note.style.transform = '';
        });
        return;
    }

    const minGap = 16; // Minimum gap between sidenotes in pixels

    // Process right sidenotes
    const rightSidenotes = Array.from(articleContent.querySelectorAll('.sidenote-right'));
    adjustSidenoteGroup(rightSidenotes, minGap);

    // Process left sidenotes
    const leftSidenotes = Array.from(articleContent.querySelectorAll('.sidenote-left'));
    adjustSidenoteGroup(leftSidenotes, minGap);
}

function adjustSidenoteGroup(sidenotes, minGap) {
    if (sidenotes.length < 2) return;

    // Reset all transforms first
    sidenotes.forEach(note => {
        note.style.transform = '';
    });

    // Sort by their natural position (top offset)
    sidenotes.sort((a, b) => a.offsetTop - b.offsetTop);

    // Track the bottom of each sidenote after adjustment
    let lastBottom = -Infinity;

    sidenotes.forEach(note => {
        const noteTop = note.offsetTop;
        const noteHeight = note.offsetHeight;

        // Check if this sidenote overlaps with the previous one
        if (noteTop < lastBottom + minGap) {
            const offset = lastBottom + minGap - noteTop;
            note.style.transform = `translateY(${offset}px)`;
            lastBottom = noteTop + offset + noteHeight;
        } else {
            lastBottom = noteTop + noteHeight;
        }
    });
}

// Run on load and resize
document.addEventListener('DOMContentLoaded', adjustSidenotes);
window.addEventListener('resize', adjustSidenotes);
// Also run after images load (which might affect positions)
window.addEventListener('load', adjustSidenotes);