// project-carousel.js - Zeigt das aktive Projekt mit vorherigem/nächstem an den Seiten, zyklisch navigierbar
document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.querySelector('.project-viewport');
    const counter = document.getElementById('project-counter');
    const prevBtn = document.querySelector('.carousel-arrow--prev');
    const nextBtn = document.querySelector('.carousel-arrow--next');

    if (!viewport || !counter || !prevBtn || !nextBtn) return;

    const cards = Array.from(viewport.querySelectorAll('.project-card'));
    const total = cards.length;
    if (!total) return;

    let index = cards.findIndex(card => card.classList.contains('is-active'));
    if (index === -1) index = 0;

    function render() {
        const prevIndex = (index - 1 + total) % total;
        const nextIndex = (index + 1) % total;

        cards.forEach((card, i) => {
            card.classList.toggle('is-active', i === index);
            card.classList.toggle('is-prev', i === prevIndex);
            card.classList.toggle('is-next', i === nextIndex);
        });

        counter.textContent = `${index + 1} / ${total}`;
    }

    prevBtn.addEventListener('click', function () {
        index = (index - 1 + total) % total;
        render();
    });

    nextBtn.addEventListener('click', function () {
        index = (index + 1) % total;
        render();
    });

    render();
});
