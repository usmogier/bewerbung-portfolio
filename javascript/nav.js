// nav.js - Hebt den Navigationspunkt der aktuell sichtbaren Sektion hervor und steuert das mobile Menü
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.navbar-toggle');
    const menu = document.getElementById('navbar-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            const isOpen = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    const navLinks = document.querySelectorAll('.navbar a[data-section]');
    const sections = Array.from(navLinks)
        .map(link => document.getElementById(link.dataset.section))
        .filter(Boolean);

    if (!sections.length) return;

    const setActive = (id) => {
        navLinks.forEach(link => {
            link.classList.toggle('active', link.dataset.section === id);
        });
    };

    const observer = new IntersectionObserver((entries) => {
        const visible = entries
            .filter(entry => entry.isIntersecting)
            .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

        if (visible.length > 0) {
            setActive(visible[0].target.id);
        }
    }, {
        rootMargin: '-45% 0px -50% 0px',
        threshold: [0, 0.25, 0.5, 0.75, 1]
    });

    sections.forEach(section => observer.observe(section));
});
