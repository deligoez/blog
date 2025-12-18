import '../css/site.css';
import 'alpinejs'
import mediumZoom from "medium-zoom";
import Alpine from 'alpinejs';

Alpine.start();

mediumZoom(document.querySelectorAll('[data-zoomable]'), {
    margin: 25,
    background: "rgba(33, 37, 48, 0.50)",
})

// Make article headings linkable with anchor tags
document.addEventListener('DOMContentLoaded', () => {
    const articleContent = document.querySelector('.article-content');
    if (!articleContent) return;

    const headings = articleContent.querySelectorAll('h1, h2, h3, h4, h5, h6');

    headings.forEach(heading => {
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
        heading.classList.add('scroll-mt-4');

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
    });
});