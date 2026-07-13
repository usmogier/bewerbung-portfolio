
<?php
$pageTitle = 'Umschulung – Moritz Gierlinger';
$pageDescription = 'Lerninhalte der Umschulung zum Fachinformatiker Anwendungsentwicklung als interaktive Karteikarten und Quiz.';
include "templates/head.php" ?>
<body>
    <canvas id="matrixCanvas"></canvas>

    <?php include "templates/nav.php" ?>
    <div class="container learning-container">

        <div id="view-categories" class="view-section active">
            <h1>Ausbildungsinhalte</h1>
            <p>Wähle einen Bereich aus:</p>

            <div class="category-grid">
                <button class="cat-btn" onclick="selectCategory('kern')">
                    Kernqualifikationen
                </button>

                <button class="cat-btn" onclick="selectCategory('fach')">
                    Fachqualifikationen
                </button>

                <button class="cat-btn" onclick="selectCategory('ergaenz')">
                    Ergänzungsqualifikationen
                </button>
            </div>
        </div>

        <div id="view-dashboard" class="view-section">
            <h1 id="dashboard-title">Bereich wählen...</h1>
            <p>Wähle ein Lernfeld aus:</p>

            <div id="dynamic-module-grid" class="module-grid"></div>

            <button class="back-btn" onclick="showView('view-categories')">← Zurück zur Auswahl</button>
        </div>

        <div id="view-topics" class="view-section">
            <h1 id="topic-module-title">Modul Themen</h1>
            <p>Wähle ein konkretes Thema:</p>

            <div id="dynamic-topic-list" class="topic-list"></div>

            <button class="back-btn" onclick="showView('view-dashboard')">← Zurück zur Modulübersicht</button>
        </div>

        <div id="view-selection" class="view-section">
            <h1 id="selected-module-title">Modul Name</h1>
            <p>Was möchtest du heute tun?</p>

            <div class="mode-selection">
                <button class="mode-btn" onclick="startLearning('flashcards')">
                    🧠<br>Karteikarten
                </button>
                <button class="mode-btn" onclick="startLearning('quiz')">
                    ❓<br>Quiz
                </button>
            </div>

            <button class="back-btn" onclick="showView('view-dashboard')">← Zurück zu den Lernfeldern</button>
        </div>

        <div id="view-content" class="view-section">
            <h2 id="content-headline">Lernen...</h2>
            <hr>

            <div id="flashcard-container" style="display:none;">
                <div id="single-card-area" class="single-card-view">
                </div>

                <div class="flashcard-controls">
                    <button class="nav-btn" onclick="prevCard()">❮ Zurück</button>
                    <span id="card-counter">1 / 1</span>
                    <button class="nav-btn" onclick="nextCard()">Weiter ❯</button>
                </div>
            </div>

            <div id="quiz-container" style="display:none;">
                <div class="quiz-box">
                    <p class="question">Platzhalter Frage...</p>
                    <button class="quiz-btn">Antwort A</button>
                    <button class="quiz-btn">Antwort B</button>
                </div>
            </div>

            <button class="back-btn" onclick="showView('view-selection')">← Modus ändern</button>
        </div>

    </div>

<?php include "templates/footer.php" ?>

</body>

