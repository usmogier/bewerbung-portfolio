// learning.js - Die Logikzentrale

// --- 1. GLOBALE VARIABLEN ---
let currentCategoryKey = "";
let currentModuleId = "";     
let currentThemaDbId = 0;     
let currentTopicCode = "";    
let currentTopicTitel = "";   

let geladeneKarten = [];      
let geladeneQuizze = [];      
let currentCardIndex = 0; 

// --- 2. NAVIGATIONS-HELFER ---
function showView(viewId) {
    document.querySelectorAll('.view-section').forEach(el => {
        el.classList.remove('active');
    });
    document.getElementById(viewId).classList.add('active');
}

// --- 3. KATEGORIE WÄHLEN (Neu: Asynchron) ---
async function selectCategory(catKey) {
    currentCategoryKey = catKey;
    const titelMap = { "kern": "Kernqualifikationen", "fach": "Fachqualifikationen", "ergaenz": "Ergänzungsqualifikationen" };
    document.getElementById('dashboard-title').innerText = titelMap[catKey] || "Kategorie";
    
    const grid = document.getElementById('dynamic-module-grid');
    grid.innerHTML = "<p style='text-align:center;'>Lade Module aus der Datenbank...</p>"; 
    
    try {
        const response = await fetch(`api.php?action=getModule&kategorie=${catKey}`);
        const geladeneModule = await response.json();
        
        grid.innerHTML = ""; 
        
        geladeneModule.forEach((modul) => {
            const btn = document.createElement('div');
            btn.className = `module-btn ${modul.color_class}`;
            btn.onclick = function() { selectModule(modul.modul_id); };
            btn.innerHTML = `
                <span class="module-code">${modul.modul_id}</span>
                <span class="module-title">${modul.name}</span>
            `;
            grid.appendChild(btn);
        });
        showView('view-dashboard');
    } catch (error) {
        console.error("Fehler beim Laden der Module:", error);
        grid.innerHTML = "<p style='color:red;'>Fehler beim Verbinden mit der Datenbank.</p>";
    }
}

// --- 4. MODUL WÄHLEN (Themen aus DB laden) ---
async function selectModule(modul_id) {
    currentModuleId = modul_id;
    document.getElementById('topic-module-title').innerText = "Modul: " + modul_id;
    
    const topicList = document.getElementById('dynamic-topic-list');
    topicList.innerHTML = "<p style='text-align:center;'>Lade Themen...</p>";
    showView('view-topics');

    try {
        const response = await fetch(`api.php?action=getThemen&modul_id=${modul_id}`);
        const themen = await response.json();
        
        topicList.innerHTML = "";

        if (themen.length > 0) {
            themen.forEach(thema => {
                const btn = document.createElement('button');
                btn.className = 'topic-btn';
                btn.innerHTML = `<span class="topic-id">${thema.thema_code}</span> ${thema.titel}`;
                btn.onclick = function() { selectTopic(thema.id, thema.thema_code, thema.titel); };
                topicList.appendChild(btn);
            });
        } else {
            topicList.innerHTML = "<p style='text-align:center;'>Keine Themen für dieses Modul gefunden.</p>";
        }
    } catch (error) {
        console.error("Fehler:", error);
        topicList.innerHTML = "<p style='color:red;'>Fehler beim Laden der Themen.</p>";
    }
}

// --- 4b. THEMA WÄHLEN ---
function selectTopic(db_id, code, titel) {
    currentThemaDbId = db_id;
    currentTopicCode = code;
    currentTopicTitel = titel;
    
    document.getElementById('selected-module-title').innerHTML = 
        `<small>${currentModuleId}</small><br>${code} ${titel}`;

    const backBtn = document.querySelector('#view-selection .back-btn');
    backBtn.onclick = function() { showView('view-topics'); };

    showView('view-selection');
}

// --- 5. LERNEN STARTEN (Datenbank-Abfrage je nach Modus) ---
async function startLearning(mode) {
    const modeTitel = mode === 'flashcards' ? "Karteikarten" : "Quiz";
    
    document.getElementById('content-headline').innerText = 
        `${currentModuleId} / ${currentTopicCode} - ${modeTitel}`;

    const fcContainer = document.getElementById('flashcard-container');
    const qContainer = document.getElementById('quiz-container');

    fcContainer.style.display = 'none';
    qContainer.style.display = 'none';
    showView('view-content');

    if (mode === 'flashcards') {
        fcContainer.style.display = 'block';
        document.getElementById('single-card-area').innerHTML = "<p style='text-align:center;'>Lade Karten...</p>";
        
        try {
            const response = await fetch(`api.php?action=getFlashcards&thema_id=${currentThemaDbId}`);
            geladeneKarten = await response.json();
            currentCardIndex = 0; 
            renderFlashcards(); 
        } catch(e) {
            document.getElementById('single-card-area').innerHTML = "<p>Fehler beim Laden.</p>";
        }

    } else {
        qContainer.style.display = 'block';
        qContainer.innerHTML = "<p style='text-align:center;'>Lade Quiz...</p>";
        
        try {
            const response = await fetch(`api.php?action=getQuiz&thema_id=${currentThemaDbId}`);
            geladeneQuizze = await response.json();
            renderQuiz();
        } catch(e) {
            qContainer.innerHTML = "<p>Fehler beim Laden.</p>";
        }
    }
}

// --- 5a. KARTEIKARTEN GENERIEREN ---
function renderFlashcards() {
    const container = document.getElementById('single-card-area');
    const counterDisplay = document.getElementById('card-counter');
    const btnPrev = document.querySelector('.nav-btn[onclick="prevCard()"]');
    const btnNext = document.querySelector('.nav-btn[onclick="nextCard()"]');

    if (!geladeneKarten || geladeneKarten.length === 0) {
        container.innerHTML = "<div class='flashcard'><div class='card-front'>Keine Karten vorhanden</div></div>";
        if(counterDisplay) counterDisplay.innerText = "0 / 0";
        if(btnPrev) btnPrev.disabled = true;
        if(btnNext) btnNext.disabled = true;
        return;
    }

    const cardData = geladeneKarten[currentCardIndex];
    const totalCards = geladeneKarten.length;

    container.innerHTML = `
        <div class="flashcard" onclick="karteUmdrehen(this)">
            <div class="card-front">${cardData.front}</div>
            <div class="card-back">${cardData.back}</div>
        </div>
    `;

    if(counterDisplay) counterDisplay.innerText = `${currentCardIndex + 1} / ${totalCards}`;
    if(btnPrev) btnPrev.disabled = (currentCardIndex === 0); 
    if(btnNext) btnNext.disabled = (currentCardIndex === totalCards - 1); 
}

// --- HILFSFUNKTIONEN FÜR DIE BUTTONS ---
function nextCard() {
    if (currentCardIndex < geladeneKarten.length - 1) {
        currentCardIndex++;
        renderFlashcards();
    }
}

function prevCard() {
    if (currentCardIndex > 0) {
        currentCardIndex--;
        renderFlashcards();
    }
}

// --- 5b. QUIZ GENERIEREN ---
function renderQuiz() {
    const container = document.getElementById('quiz-container');
    container.innerHTML = ""; 

    if (!geladeneQuizze || geladeneQuizze.length === 0) {
        container.innerHTML = "<p style='text-align:center;'>Noch kein Quiz für dieses Thema angelegt.</p>";
        return;
    }

    geladeneQuizze.forEach((q, index) => {
        const richtigArray = Array.isArray(q.richtig) ? q.richtig : [q.richtig];
        const mehrere = richtigArray.length > 1;
        let buttonsHTML = "";

        q.antworten.forEach((antwort, btnIndex) => {
            const istRichtig = richtigArray.includes(btnIndex);
            buttonsHTML += `
                <button class="quiz-btn" onclick="checkAntwort(this, ${istRichtig})">
                    ${antwort}
                </button>
            `;
        });

        container.innerHTML += `
            <div class="quiz-box" style="margin-bottom: 30px;">
                <p class="question">${index + 1}. ${q.frage}</p>
                ${mehrere ? `<p style="color:#aaa;font-size:0.85em;margin-top:-8px;">&#9432; Mehrere Antworten sind richtig</p>` : ''}
                ${buttonsHTML}
            </div>
            <hr style="border-color: #333;">
        `;
    });
}

// --- 6. INTERAKTIONEN ---
function karteUmdrehen(karte) {
    karte.classList.toggle('flipped');
}

function checkAntwort(btn, istRichtig) {
    if (istRichtig) {
        btn.style.background = 'rgba(0, 255, 65, 0.4)';
        btn.style.borderColor = '#00ff41';
        if (!btn.innerText.includes("✅")) btn.innerText += " ✅";
    } else {
        btn.style.background = 'rgba(255, 0, 0, 0.4)';
        btn.style.borderColor = 'red';
        if (!btn.innerText.includes("❌")) btn.innerText += " ❌";
    }
}
