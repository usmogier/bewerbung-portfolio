// text-scramble.js - Der Text jeder Section löst sich beim ersten Sichtbarwerden aus kryptischen Zeichen auf
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('section[id]');
    if (!sections.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const chars = '!<>-_\\/[]{}=+*^?#01';
    // Zeitbasiert (ms) statt frame-basiert, damit die Dauer unabhängig von der Bildrate des Geräts gleich bleibt
    const STAGGER_SPAN_MS = 500;
    const REVEAL_MIN_MS = 250;
    const REVEAL_RANGE_MS = 250;

    function randomChar() {
        return chars.charAt(Math.floor(Math.random() * chars.length));
    }

    function scrambleElement(el) {
        // Zeilenumbrüche/Einrückungen aus dem Template auf einzelne Leerzeichen reduzieren
        const finalText = el.textContent.trim().replace(/\s+/g, ' ');
        const length = finalText.length;

        const queue = finalText.split('').map(function (char, i) {
            const start = (i / Math.max(length - 1, 1)) * STAGGER_SPAN_MS + Math.random() * 100;
            return { to: char, start: start, end: start + Math.random() * REVEAL_RANGE_MS + REVEAL_MIN_MS };
        });
        const maxEnd = Math.max.apply(null, queue.map(function (item) { return item.end; }));

        // Startzustand: komplett verschlüsselt, Leerzeichen bleiben Leerzeichen
        el.textContent = finalText.split('').map(function (char) {
            return /\s/.test(char) ? char : randomChar();
        }).join('');

        let startTime = null;

        function update(timestamp) {
            if (startTime === null) startTime = timestamp;
            const elapsed = timestamp - startTime;

            let output = '';

            for (let i = 0; i < queue.length; i++) {
                const item = queue[i];

                if (/\s/.test(item.to)) {
                    output += item.to;
                } else if (elapsed >= item.end) {
                    output += item.to;
                } else {
                    output += randomChar();
                }
            }

            el.textContent = output;

            if (elapsed < maxEnd) {
                requestAnimationFrame(update);
            } else {
                el.textContent = finalText;
            }
        }

        requestAnimationFrame(update);
    }

    function decodeSection(section) {
        const elements = section.querySelectorAll('.scramble-text');
        elements.forEach(scrambleElement);
    }

    const observer = new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                decodeSection(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    sections.forEach(function (section) {
        if (section.querySelector('.scramble-text')) {
            observer.observe(section);
        }
    });
});
