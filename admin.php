<?php
session_start(); 

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy(); 
    header("Location: admin.php");
    exit;
}

$adminConfig = require __DIR__ . '/inc/admin-config.php';

// Prüfen, ob jemand auf "Einloggen" geklickt hat
if (isset($_POST['passwort_eingabe'])) {
    if (password_verify($_POST['passwort_eingabe'], $adminConfig['password_hash'])) {
        $_SESSION['admin_logged_in'] = true; // Ticket stempeln!
    } else {
        $fehler = "Falsches Passwort! Zugriff verweigert.";
    }
}

// Wenn man NICHT eingeloggt ist, zeige nur den Login-Bildschirm
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <style>
            body {
                background-color: #0d0d0d;
                color: #00ff41;
                font-family: monospace;
                display: flex;
                justify-content: center;
                padding-top: 100px;
            }

            input {
                background: #222;
                color: #fff;
                border: 1px solid #444;
                padding: 10px;
                margin-bottom: 20px;
                width: 100%;
                box-sizing: border-box;
            }

            button {
                width: 100%;
                background: #00ff41;
                color: #000;
                padding: 10px;
                border: none;
                font-weight: bold;
                cursor: pointer;
            }

            button:hover {
                background: #00cc33;
            }

            .login-box {
                background: #1a1a1a;
                padding: 30px;
                border: 1px solid #00ff41;
                border-radius: 8px;
                text-align: center;
                width: 300px;
            }

        </style>
    </head>

    <body>
        <div class="login-box">
            <h2>🔒 System-Zugang</h2>
            <?php if (isset($fehler)) echo "<p style='color:red;'>$fehler</p>"; ?>
            <form method="POST">
                <input type="password" name="passwort_eingabe" placeholder="Passwort eingeben..." required>
                <button type="submit">Einloggen</button>
            </form>
        </div>
    </body>

    </html>
<?php
    exit; 
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Admin-Panel: Neue Karteikarte</title>
    <style>
        body {
            background-color: #0d0d0d;
            color: #00ff41;
            font-family: monospace;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            padding-top: 50px;
        }

        .admin-box {
            background: #1a1a1a;
            padding: 30px;
            border: 1px solid #00ff41;
            border-radius: 8px;
            width: 400px;
        }

        input,
        textarea {
            width: 100%;
            background: #222;
            color: #fff;
            border: 1px solid #444;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background: #00ff41;
            color: #000;
            padding: 15px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #00cc33;
        }

        #message {
            margin-top: 15px;
            font-weight: bold;
        }

        .fmt-toolbar {
            display: flex;
            gap: 6px;
            margin-bottom: 6px;
        }

        .fmt-btn {
            width: auto;
            background: #333;
            color: #00ff41;
            border: 1px solid #555;
            padding: 3px 10px;
            font-size: 0.85em;
            cursor: pointer;
            border-radius: 3px;
        }

        .fmt-btn:hover {
            background: #444;
        }
    </style>
</head>

<body>
    <div class="admin-box">
        <div style="text-align: right; margin-bottom: -10px;">
            <a href="admin.php?action=logout" style="color: #ff4444; text-decoration: none; font-weight: bold; font-family: monospace;">[✖ Logout]</a>
        </div>
        <h2> Neue Karteikarte</h2>
        <label>Thema ID (Zahl aus der Datenbank):</label>
        <input type="number" id="thema_id" placeholder="z.B. 1" required>
        <label>Frage (Vorderseite):</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('front','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('front','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('front','&lt;br&gt;')">↵</button>
        </div>
        <textarea id="front" rows="3" placeholder="Wie lautet die Frage?" required></textarea>
        <label>Antwort (Rückseite):</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('back','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('back','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('back','&lt;br&gt;')">↵</button>
        </div>
        <textarea id="back" rows="3" placeholder="Wie lautet die Antwort?" required></textarea>
        <button onclick="saveCard()">Karteikarte speichern</button>
        <div id="message"></div>
    </div>

    <div class="admin-box">
        <h2> Karten bearbeiten / löschen</h2>
        <label>Thema ID eingeben, um Karten zu laden:</label>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <input type="number" id="load_thema_id" placeholder="z.B. 1" style="margin-bottom: 0;">
            <button onclick="loadCardsForEdit()">Laden</button>
        </div>
        
        <div id="edit-cards-container"></div>
    </div>

    <div class="admin-box">
        <h2>Neue Quiz-Frage</h2>
        <label>Thema ID:</label>
        <input type="number" id="quiz_thema_id" placeholder="z.B. 1" required>
        <label>Frage:</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('quiz_frage','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('quiz_frage','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('quiz_frage','&lt;br&gt;')">↵</button>
        </div>
        <textarea id="quiz_frage" rows="3" placeholder="Wie lautet die Frage?" required></textarea>
        <label>Antwort 1:</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a0','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a0','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('quiz_a0','&lt;br&gt;')">↵</button>
        </div>
        <input type="text" id="quiz_a0" placeholder="Antwort 1">
        <label>Antwort 2:</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a1','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a1','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('quiz_a1','&lt;br&gt;')">↵</button>
        </div>
        <input type="text" id="quiz_a1" placeholder="Antwort 2">
        <label>Antwort 3:</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a2','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a2','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('quiz_a2','&lt;br&gt;')">↵</button>
        </div>
        <input type="text" id="quiz_a2" placeholder="Antwort 3 (optional)">
        <label>Antwort 4:</label>
        <div class="fmt-toolbar">
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a3','strong')"><b>B</b></button>
            <button type="button" class="fmt-btn" onclick="formatText('quiz_a3','em')"><i>I</i></button>
            <button type="button" class="fmt-btn" onclick="insertAtCursor('quiz_a3','&lt;br&gt;')">↵</button>
        </div>
        <input type="text" id="quiz_a3" placeholder="Antwort 4 (optional)">
        <label>Richtige Antwort(en):</label>
        <div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:20px;padding:10px;border:1px solid #444;border-radius:4px;">
            <label style="color:#fff;cursor:pointer;"><input type="checkbox" id="quiz_r0" style="margin-right:6px;">Antwort 1</label>
            <label style="color:#fff;cursor:pointer;"><input type="checkbox" id="quiz_r1" style="margin-right:6px;">Antwort 2</label>
            <label style="color:#fff;cursor:pointer;"><input type="checkbox" id="quiz_r2" style="margin-right:6px;">Antwort 3</label>
            <label style="color:#fff;cursor:pointer;"><input type="checkbox" id="quiz_r3" style="margin-right:6px;">Antwort 4</label>
        </div>
        <button onclick="saveQuiz()">Quiz-Frage speichern</button>
        <div id="quiz-message"></div>
    </div>

    <div class="admin-box">
        <h2>Quiz bearbeiten / löschen</h2>
        <label>Thema ID eingeben, um Quiz zu laden:</label>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <input type="number" id="load_quiz_thema_id" placeholder="z.B. 1" style="margin-bottom: 0;">
            <button onclick="loadQuizForEdit()">Laden</button>
        </div>
        <div id="edit-quiz-container"></div>
    </div>

    <script>
        function formatText(id, tag) {
            const el = document.getElementById(id);
            if (!el) return;
            const start = el.selectionStart;
            const end   = el.selectionEnd;
            const selected = el.value.substring(start, end);
            const open = `<${tag}>`, close = `</${tag}>`;
            el.value = el.value.substring(0, start) + open + selected + close + el.value.substring(end);
            el.selectionStart = start + open.length;
            el.selectionEnd   = start + open.length + selected.length;
            el.focus();
        }

        function insertAtCursor(id, text) {
            const el = document.getElementById(id);
            if (!el) return;
            const start = el.selectionStart;
            el.value = el.value.substring(0, start) + text + el.value.substring(el.selectionEnd);
            el.selectionStart = el.selectionEnd = start + text.length;
            el.focus();
        }

        function fmtBar(id) {
            return `<div class="fmt-toolbar">
                <button type="button" class="fmt-btn" onclick="formatText('${id}','strong')"><b>B</b></button>
                <button type="button" class="fmt-btn" onclick="formatText('${id}','em')"><i>I</i></button>
                <button type="button" class="fmt-btn" onclick="insertAtCursor('${id}','&lt;br&gt;')">↵</button>
            </div>`;
        }

        async function saveCard() {
            const thema_id = document.getElementById('thema_id').value;
            const front = document.getElementById('front').value;
            const back = document.getElementById('back').value;

            if (!thema_id || !front || !back) {
                document.getElementById('message').innerHTML = "<p style='color:red;'>Bitte alle Felder ausfüllen!</p>";
                return;
            }

            try {
                const res = await fetch('api.php?action=addFlashcard', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ thema_id: parseInt(thema_id), front: front, back: back })
                });
                const result = await res.json();

                if (result.status === 'success') {
                    document.getElementById('message').innerHTML = "<p style='color:#00ff41;'>" + result.message + "</p>";
                    document.getElementById('front').value = '';
                    document.getElementById('back').value = '';
                } else {
                    document.getElementById('message').innerHTML = "<p style='color:red;'>" + result.message + "</p>";
                }
            } catch (e) {
                document.getElementById('message').innerHTML = "<p style='color:red;'>Fehler beim Speichern!</p>";
            }
        }

        // --- BEARBEITEN UND LÖSCHEN ---

        async function loadCardsForEdit() {
            const themaId = document.getElementById('load_thema_id').value;
            if(!themaId) return alert("Bitte eine Thema ID eingeben!");
            
            const container = document.getElementById('edit-cards-container');
            container.innerHTML = "<p style='color: yellow;'>Lade Karten...</p>";

            try {
                // Wir recyceln unseren getFlashcards Endpoint!
                const response = await fetch(`api.php?action=getFlashcards&thema_id=${themaId}`);
                const cards = await response.json();
                
                if(cards.length === 0) {
                    container.innerHTML = "<p style='color: red;'>Keine Karten für dieses Thema gefunden.</p>";
                    return;
                }

                let html = "";
                cards.forEach(card => {
                    html += `
                        <div style="background: #222; padding: 15px; margin-bottom: 15px; border: 1px solid #444; border-radius: 5px;">
                            <label style="color: #888; font-size: 0.8em;">Karten-ID: ${card.id}</label>
                            ${fmtBar('edit_front_' + card.id)}
                            <textarea id="edit_front_${card.id}" rows="2">${card.front}</textarea>
                            ${fmtBar('edit_back_' + card.id)}
                            <textarea id="edit_back_${card.id}" rows="2">${card.back}</textarea>
                            <div style="display: flex; gap: 10px;">
                                <button onclick="updateCard(${card.id})" style="background: #00ff41; color: black; padding: 10px;">💾 Speichern</button>
                                <button onclick="deleteCard(${card.id})" style="background: #ff4444; color: white; padding: 10px;">🗑️ Löschen</button>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;

            } catch(e) {
                container.innerHTML = "<p style='color: red;'>Fehler beim Laden.</p>";
            }
        }

        async function updateCard(id) {
            const front = document.getElementById(`edit_front_${id}`).value;
            const back = document.getElementById(`edit_back_${id}`).value;
            
            try {
                const res = await fetch('api.php?action=updateFlashcard', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, front: front, back: back })
                });
                const result = await res.json();
                alert(result.message);
            } catch (e) {
                alert("Fehler beim Aktualisieren!");
            }
        }

        async function deleteCard(id) {
            
            if(!confirm("Bist du sicher, dass du diese Karteikarte für immer löschen willst?")) return;
            
            try {
                const res = await fetch('api.php?action=deleteFlashcard', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                });
                const result = await res.json();
                alert(result.message);
                
                
                loadCardsForEdit(); 
            } catch (e) {
                alert("Fehler beim Löschen!");
            }
        }

        // --- QUIZ ERSTELLEN ---

        async function saveQuiz() {
            const thema_id = document.getElementById('quiz_thema_id').value;
            const frage    = document.getElementById('quiz_frage').value;
            const richtig  = [0,1,2,3].filter(i => document.getElementById(`quiz_r${i}`).checked);

            const antworten = [
                document.getElementById('quiz_a0').value,
                document.getElementById('quiz_a1').value,
                document.getElementById('quiz_a2').value,
                document.getElementById('quiz_a3').value,
            ].filter(a => a.trim() !== '');

            const msg = document.getElementById('quiz-message');

            if (!thema_id || !frage || antworten.length < 2) {
                msg.innerHTML = "<p style='color:red;'>Bitte Thema ID, Frage und mind. 2 Antworten ausfüllen!</p>";
                return;
            }
            if (richtig.length === 0) {
                msg.innerHTML = "<p style='color:red;'>Bitte mindestens eine richtige Antwort auswählen!</p>";
                return;
            }

            try {
                const res = await fetch('api.php?action=addQuiz', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ thema_id: parseInt(thema_id), frage, antworten, richtig })
                });
                const result = await res.json();
                if (result.status === 'success') {
                    msg.innerHTML = "<p style='color:#00ff41;'>" + result.message + "</p>";
                    document.getElementById('quiz_frage').value = '';
                    ['quiz_a0','quiz_a1','quiz_a2','quiz_a3'].forEach(id => document.getElementById(id).value = '');
                    [0,1,2,3].forEach(i => document.getElementById(`quiz_r${i}`).checked = false);
                } else {
                    msg.innerHTML = "<p style='color:red;'>" + result.message + "</p>";
                }
            } catch(e) {
                msg.innerHTML = "<p style='color:red;'>Fehler beim Speichern!</p>";
            }
        }

        // --- QUIZ LADEN / BEARBEITEN / LÖSCHEN ---

        async function loadQuizForEdit() {
            const themaId = document.getElementById('load_quiz_thema_id').value;
            if (!themaId) return alert("Bitte eine Thema ID eingeben!");

            const container = document.getElementById('edit-quiz-container');
            container.innerHTML = "<p style='color:yellow;'>Lade Quiz-Fragen...</p>";

            try {
                const res = await fetch(`api.php?action=getQuiz&thema_id=${themaId}`);
                const quizze = await res.json();

                if (quizze.length === 0) {
                    container.innerHTML = "<p style='color:red;'>Keine Quiz-Fragen für dieses Thema gefunden.</p>";
                    return;
                }

                let html = "";
                quizze.forEach(q => {
                    const antworten = q.antworten;
                    const richtigArray = Array.isArray(q.richtig) ? q.richtig : [q.richtig];
                    let antwortenInputs = '';
                    for (let i = 0; i < 4; i++) {
                        antwortenInputs += fmtBar(`eq_a${i}_${q.id}`);
                        antwortenInputs += `<input type="text" id="eq_a${i}_${q.id}" value="${antworten[i] || ''}" placeholder="Antwort ${i+1} (optional)">`;
                    }
                    let checkboxes = '<div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:15px;padding:10px;border:1px solid #444;border-radius:4px;">';
                    for (let i = 0; i < 4; i++) {
                        const checked = richtigArray.includes(i) ? 'checked' : '';
                        checkboxes += `<label style="color:#fff;cursor:pointer;"><input type="checkbox" id="eq_r${i}_${q.id}" ${checked} style="margin-right:6px;">Antwort ${i+1}</label>`;
                    }
                    checkboxes += '</div>';

                    html += `
                        <div style="background:#222;padding:15px;margin-bottom:15px;border:1px solid #444;border-radius:5px;">
                            <label style="color:#888;font-size:0.8em;">Frage-ID: ${q.id}</label>
                            ${fmtBar('eq_frage_' + q.id)}
                            <textarea id="eq_frage_${q.id}" rows="2">${q.frage}</textarea>
                            ${antwortenInputs}
                            <label style="color:#aaa;font-size:0.85em;">Richtige Antwort(en):</label>
                            ${checkboxes}
                            <div style="display:flex;gap:10px;">
                                <button onclick="updateQuiz(${q.id})" style="background:#00ff41;color:black;padding:10px;">💾 Speichern</button>
                                <button onclick="deleteQuiz(${q.id})" style="background:#ff4444;color:white;padding:10px;">🗑️ Löschen</button>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            } catch(e) {
                container.innerHTML = "<p style='color:red;'>Fehler beim Laden.</p>";
            }
        }

        async function updateQuiz(id) {
            const frage = document.getElementById(`eq_frage_${id}`).value;
            const richtig = [0,1,2,3].filter(i => document.getElementById(`eq_r${i}_${id}`).checked);
            if (richtig.length === 0) { alert("Bitte mindestens eine richtige Antwort auswählen!"); return; }
            const antworten = [0,1,2,3]
                .map(i => document.getElementById(`eq_a${i}_${id}`).value)
                .filter(a => a.trim() !== '');

            try {
                const res = await fetch('api.php?action=updateQuiz', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id, frage, antworten, richtig })
                });
                const result = await res.json();
                alert(result.message);
            } catch(e) {
                alert("Fehler beim Aktualisieren!");
            }
        }

        async function deleteQuiz(id) {
            if (!confirm("Quiz-Frage wirklich löschen?")) return;
            try {
                const res = await fetch('api.php?action=deleteQuiz', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });
                const result = await res.json();
                alert(result.message);
                loadQuizForEdit();
            } catch(e) {
                alert("Fehler beim Löschen!");
            }
        }
    </script>
</body>
</html>