// scroll-scale.js - Sektionen verkleinern sich beim Verlassen und vergrößern sich beim Erscheinen
document.addEventListener('DOMContentLoaded', function () {
    const sections = Array.from(document.querySelectorAll('section[id]'));
    if (!sections.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const MIN_SCALE = 0.85;

    // Bildet die Position der Sektions-Oberkante im Viewport (top) auf einen Skalierungsfaktor ab:
    // von unten hereinkommend -> wächst bis 1, mittig -> bleibt bei 1, oben hinausscrollend -> schrumpft
    function scaleForTop(top, vh) {
        const entryStart = vh;
        const entryEnd = vh * 0.5;
        const leaveEnd = -vh * 0.6;

        if (top >= entryStart) return MIN_SCALE;
        if (top > entryEnd) {
            const t = (entryStart - top) / (entryStart - entryEnd);
            return MIN_SCALE + (1 - MIN_SCALE) * t;
        }
        if (top >= 0) return 1;
        if (top > leaveEnd) {
            const t = top / leaveEnd;
            return 1 - (1 - MIN_SCALE) * t;
        }
        return MIN_SCALE;
    }

    let ticking = false;

    function updateScales() {
        const vh = window.innerHeight;
        sections.forEach(section => {
            const top = section.getBoundingClientRect().top;
            section.style.transform = `scale(${scaleForTop(top, vh)})`;
        });
        ticking = false;
    }

    function requestUpdate() {
        if (!ticking) {
            requestAnimationFrame(updateScales);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestUpdate, { passive: true });
    window.addEventListener('resize', requestUpdate);
    window.addEventListener('load', updateScales);
    updateScales();
});
