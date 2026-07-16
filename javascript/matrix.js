// js/matrix.js — Matrix-Regen läuft dauerhaft im Hintergrund
const canvas = document.getElementById('matrixCanvas');
const ctx = canvas.getContext('2d');

const matrixChars = "GIERLINGER";
const fontSize = 16;

let width = canvas.width = window.innerWidth;
let height = canvas.height = window.innerHeight;
let columns = Math.floor(width / fontSize);
let drops = Array(columns).fill(1);

window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
    columns = Math.floor(width / fontSize);
    drops = Array(columns).fill(1);
});

const matrixColor = getComputedStyle(document.body).getPropertyValue('--matrix-accent').trim();

function drawMatrix() {
    ctx.fillStyle = 'rgba(10, 10, 10, 0.05)';
    ctx.fillRect(0, 0, width, height);

    ctx.fillStyle = matrixColor;
    ctx.font = `${fontSize}px monospace`;

    for (let i = 0; i < drops.length; i++) {
        const text = matrixChars.charAt(Math.floor(Math.random() * matrixChars.length));
        ctx.fillText(text, i * fontSize, drops[i] * fontSize);

        if (drops[i] * fontSize > height && Math.random() > 0.975) {
            drops[i] = 0;
        }
        drops[i]++;
    }
}

setInterval(drawMatrix, 60);
