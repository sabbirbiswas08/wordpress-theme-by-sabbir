document.addEventListener('DOMContentLoaded', () => {

    // ── Smooth scroll for anchor links ──
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });

    // ── Header shrink on scroll ──
    const header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.style.padding = window.scrollY > 60 ? '.8rem 0' : '1.2rem 0';
        }, { passive: true });
    }

    // ── Highlight active nav link ──
    const currentPath = window.location.pathname;
    document.querySelectorAll('nav a').forEach(a => {
        if (a.getAttribute('href') && a.getAttribute('href') !== '#' && currentPath.includes(a.getAttribute('href').replace(window.location.origin, ''))) {
            a.classList.add('active');
        }
    });

    // ── Intersection Observer: fade-in cards ──
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.blog-card, .bio-highlight, .timeline-item, .philosophy-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity .5s ease, transform .5s ease';
        observer.observe(el);
    });

});
