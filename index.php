<?php
$status = $_GET['status'] ?? '';
include "templates/head.php" ?>

<body>
     <canvas id="matrixCanvas"></canvas>
     <?php include "templates/nav.php" ?>

     <section id="start" class="container hero">
          <img src="images/Gierlinger_Logo_rund.svg" alt="Logo Moritz Gierlinger – Anwendungsentwicklung" class="logo-round">
          <p class="eyebrow scramble-text">Angehender Fachinformatiker · Anwendungsentwicklung</p>
          <h1 id="hero-name" class="scramble-text">Moritz Gierlinger</h1>
          <p class="scramble-text">
               Ich befinde mich in einer Umschulung zum Fachinformatiker für
               Anwendungsentwicklung bei der GFN in Nürnberg und suche einen
               Platz für ein neunmonatiges Pflichtpraktikum. Vorher habe ich
               Sozialökonomie studiert und dabei gelernt, mit Daten und Code
               Lösungen zu bauen &ndash; das vertiefe ich jetzt in der Softwareentwicklung.
          </p>
          <div class="hero-actions">
               <a href="#ueber-mich" class="button button--primary">Über mich</a>
               <a href="#kontakt" class="button">Kontakt aufnehmen</a>
          </div>
     </section>

     <section id="ueber-mich" class="container profile">
          <img src="images/moritz-gierlinger.jpg" alt="Moritz Gierlinger" class="profile-photo">
          <p class="eyebrow scramble-text">Über mich</p>
          <h1 class="scramble-text">Vom Sozialökonomen zum Anwendungsentwickler</h1>

          <p class="scramble-text">
               Seit Juni 2025 mache ich bei der GFN in Nürnberg eine Umschulung zum
               Fachinformatiker für Anwendungsentwicklung &ndash; im Zuge dessen suche
               ich einen Platz für mein neunmonatiges Pflichtpraktikum.
          </p>
          <p class="scramble-text">
               Zuvor habe ich Sozialökonomie an der Friedrich-Alexander-Universität
               Erlangen-Nürnberg studiert (B.A. und M.Sc.) und dabei intensiv mit
               Statistik-Software wie R und Stata gearbeitet. Die Faszination, mit
               Code und logischen Strukturen funktionierende Lösungen zu bauen, hat
               mich schließlich zur Anwendungsentwicklung geführt. Erste praktische
               Erfahrung im Umgang mit Datenbanken habe ich bereits während eines
               Praktikums gesammelt, in dem ich eine Datenbank zur Erfassung von
               KPIs aufgebaut habe.
          </p>
          <p class="scramble-text">
               Ich bin zuverlässig, kommunikativ und arbeite gerne im Team &ndash;
               und beschäftige mich auch über die Umschulung hinaus eigenständig mit
               dem Programmieren, unter anderem an dieser Website.
          </p>

          <h2>Skills</h2>
          <div class="skills-marquee">
               <div class="skills-track">
                    <ul class="skill-list">
                         <li>HTML</li>
                         <li>CSS</li>
                         <li>JavaScript</li>
                         <li>PHP</li>
                         <li>SQL</li>
                         <li>Python</li>
                         <li>Java</li>
                         <li>R</li>
                         <li>Stata</li>
                    </ul>
                    <ul class="skill-list" aria-hidden="true">
                         <li>HTML</li>
                         <li>CSS</li>
                         <li>JavaScript</li>
                         <li>PHP</li>
                         <li>SQL</li>
                         <li>Python</li>
                         <li>Java</li>
                         <li>R</li>
                         <li>Stata</li>
                    </ul>
               </div>
          </div>

          <h2>Werdegang</h2>
          <ul class="timeline">
               <li>
                    <span class="timeline-date">seit 06/2025</span>
                    <span class="timeline-text">Umschulung zum Fachinformatiker &ndash; Anwendungsentwicklung, GFN Nürnberg</span>
               </li>
               <li>
                    <span class="timeline-date">2018 &ndash; 2022</span>
                    <span class="timeline-text">M.Sc. Sozialökonomik, Friedrich-Alexander-Universität Erlangen-Nürnberg</span>
               </li>
               <li>
                    <span class="timeline-date">2013 &ndash; 2017</span>
                    <span class="timeline-text">B.A. Sozialökonomik, Friedrich-Alexander-Universität Erlangen-Nürnberg</span>
               </li>
               <li>
                    <span class="timeline-date">2016</span>
                    <span class="timeline-text">Praktikum bei PAMEC PAPP GmbH &ndash; Erstellung einer Datenbank zur KPI-Erfassung</span>
               </li>
          </ul>
     </section>

     <section id="projekte" class="container projects">
          <p class="eyebrow scramble-text">Projekte</p>
          <h1 class="scramble-text">Meine bisherigen Projekte:</h1>
          <p class="scramble-text">
               Eine Auswahl an Projekten, an denen ich während und neben der Umschulung
               arbeite und gearbeitet habe. Der Code ist öffentlich auf GitHub einsehbar.
          </p>

          <div class="project-carousel">
               <p class="project-counter"><span id="project-counter">1 / 5</span></p>
               <div class="project-carousel-nav">
                    <button type="button" class="carousel-arrow carousel-arrow--prev" aria-label="Vorheriges Projekt">&#10094;</button>
                    <div class="project-viewport">
               <article class="project-card is-active">
                    <img src="images/kochrezepte-screenshot.png" alt="Screenshot der Kochrezepte-Anwendung: Rezeptliste mit Detailansicht">
                    <h3>Kochrezepte</h3>
                    <p>
                         JavaFX-Desktopanwendung zur Verwaltung von Kochrezepten mit Kategorien,
                         Zutatenlisten und Suche. Sauber getrennt nach MVC mit zusätzlicher
                         DAO- und Service-Schicht; die Datenbank inkl. Schema wird beim ersten
                         Start automatisch angelegt.
                    </p>
                    <ul class="project-tags">
                         <li>Java</li>
                         <li>JavaFX</li>
                         <li>MySQL</li>
                         <li>MVC + DAO</li>
                    </ul>
                    <div class="project-links">
                         <a href="https://github.com/usmogier/kochrezepte" class="button button--primary button--github" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>GitHub</a>
                    </div>
               </article>

               <article class="project-card">
                    <img src="images/pvs-screenshot.jpg" alt="Screenshot der PVS-Nürnberg-Anwendung: Mitarbeiterverwaltung">
                    <h3>PVS Nürnberg – Projektverwaltungssystem</h3>
                    <p>
                         Im 3er-Team entwickelte JavaFX-Desktopanwendung zur Verwaltung
                         städtischer Vorhaben: Mitarbeiter- und Stammdatenpflege, Projektbesetzung
                         mit historisierter Projektleitung sowie ein Ticketing-Modul nach dem
                         Vier-Augen-Prinzip. Mein Schwerpunkt war die Datenbankentwicklung –
                         Schema (3NF), SQL und die DAO-Schicht.
                    </p>
                    <ul class="project-tags">
                         <li>Java</li>
                         <li>JavaFX</li>
                         <li>MySQL</li>
                         <li>MVC + DAO</li>
                         <li>Teamprojekt</li>
                    </ul>
                    <div class="project-links">
                         <a href="https://github.com/usmogier/pvs-nuernberg" class="button button--primary button--github" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>GitHub</a>
                    </div>
               </article>

               <article class="project-card">
                    <img src="images/medknow-screenshot.png" alt="Screenshot der MedKnow-Anwendung: Dashboard mit Live-Kennzahlen">
                    <h3>MedKnow</h3>
                    <p>
                         Desktop-Anwendung (JavaFX + MySQL) zur Vorbereitung auf medizinische
                         Prüfungen, nach MVC- und DAO-Architektur. Mit Login inkl. BCrypt-Hashing,
                         Prüfungsmodus mit Timer und Auswertung, Admin-Bereich für Fragen-CRUD
                         sowie einem Dashboard mit Lernfortschritt und Statistiken.
                    </p>
                    <ul class="project-tags">
                         <li>Java</li>
                         <li>JavaFX</li>
                         <li>MySQL / JDBC</li>
                         <li>MVC + DAO</li>
                    </ul>
                    <div class="project-links">
                         <a href="https://github.com/usmogier/medknow" class="button button--primary button--github" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>GitHub</a>
                    </div>
               </article>

               <article class="project-card">
                    <img src="images/lernplattform-screenshot.png" alt="Screenshot der Lernplattform: Ausbildungsinhalte mit Kategorieauswahl">
                    <h3>Lernplattform für die Umschulung</h3>
                    <p>
                         Interaktives Karteikarten- und Quiz-Tool für die Lerninhalte meiner
                         Umschulung, mit eigenem Admin-Panel zur Verwaltung von Kategorien,
                         Modulen und Fragen. Die Inhalte kommen live aus einer MySQL-Datenbank
                         über eine selbst gebaute PHP-API.
                    </p>
                    <ul class="project-tags">
                         <li>PHP</li>
                         <li>MySQL / PDO</li>
                         <li>JavaScript</li>
                         <li>REST-API</li>
                    </ul>
                    <div class="project-links">
                         <a href="#umschulung" class="button button--primary">Live ansehen</a>
                         <a href="https://github.com/usmogier/bewerbung-portfolio" class="button button--github" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>GitHub</a>
                    </div>
               </article>

               <article class="project-card">
                    <img src="images/webseite-screenshot.png" alt="Screenshot der Bewerbungs-Website: Startseite im Matrix-Design">
                    <h3>Diese Bewerbungs-Website</h3>
                    <p>
                         Diese Seite selbst: ein PHP-Template-System mit eigenem Matrix-Theme,
                         einem funktionierenden Kontaktformular inkl. Spam-Schutz, DSGVO-konformer
                         Datenschutzerklärung und sauber abgesicherten Zugangsdaten.
                    </p>
                    <ul class="project-tags">
                         <li>PHP</li>
                         <li>HTML/CSS</li>
                         <li>JavaScript</li>
                    </ul>
                    <div class="project-links">
                         <a href="https://github.com/usmogier/bewerbung-portfolio" class="button button--primary button--github" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>GitHub</a>
                    </div>
               </article>
                    </div>
                    <button type="button" class="carousel-arrow carousel-arrow--next" aria-label="Nächstes Projekt">&#10095;</button>
               </div>
          </div>
     </section>

     <section id="umschulung" class="container learning-container">

          <div id="view-categories" class="view-section active">
               <h1 class="scramble-text">Ausbildungsinhalte</h1>
               <p class="scramble-text">Wähle einen Bereich aus:</p>

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

     </section>

     <section id="kontakt" class="container">
          <h1 class="scramble-text">Kontaktieren Sie mich!</h1>
          <p class="scramble-text">Haben Sie Fragen oder ein spannendes Praktikumsangebot? Schreiben Sie mir!</p>

          <p>
               E-Mail: <a href="mailto:info@moritz-gierlinger.de">info@moritz-gierlinger.de</a>
          </p>

          <?php if ($status === 'success'): ?>
               <p class="form-status form-status--success">Danke für deine Nachricht! Ich melde mich schnellstmöglich zurück.</p>
          <?php elseif ($status === 'error'): ?>
               <p class="form-status form-status--error">Da ist leider etwas schiefgelaufen. Bitte versuch es noch einmal oder schreib mir direkt per E-Mail.</p>
          <?php endif; ?>

          <form action="kontakt-handler.php" method="POST">

               <div class="form-group">
                    <label for="name">Ihr Name:</label>
                    <input type="text" id="name" name="name" required maxlength="100">
               </div>

               <div class="form-group">
                    <label for="email">Ihre E-Mail:</label>
                    <input type="email" id="email" name="email" required maxlength="150">
               </div>

               <div class="form-group">
                    <label for="nachricht">Ihre Nachricht:</label>
                    <textarea id="nachricht" name="nachricht" required maxlength="5000"></textarea>
               </div>

               <div class="form-group form-group--honeypot" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
               </div>

               <button type="submit" class="button button--primary">Absenden</button>

          </form>

     </section>

     <?php include "templates/footer.php"; ?>

</body>
