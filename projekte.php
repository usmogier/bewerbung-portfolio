<?php
$pageTitle = 'Projekte – Moritz Gierlinger';
$pageDescription = 'Eigene Softwareprojekte von Moritz Gierlinger aus der Umschulung zum Fachinformatiker Anwendungsentwicklung – mit Code auf GitHub.';
include "templates/head.php" ?>

<body>
    <canvas id="matrixCanvas"></canvas>
    <?php include "templates/nav.php" ?>

    <div class="container projects">
        <p class="eyebrow">Projekte</p>
        <h1>Was ich bisher gebaut habe</h1>
        <p>
            Eine Auswahl an Projekten, an denen ich während und neben der Umschulung
            arbeite. Der Code ist öffentlich auf GitHub einsehbar.
        </p>

        <div class="project-grid">
            <article class="project-card">
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
                    <a href="https://github.com/usmogier/kochrezepte" class="button button--primary" target="_blank" rel="noopener noreferrer">GitHub</a>
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
                    <a href="https://github.com/usmogier/pvs-nuernberg" class="button button--primary" target="_blank" rel="noopener noreferrer">GitHub</a>
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
                    <a href="https://github.com/usmogier/medknow" class="button button--primary" target="_blank" rel="noopener noreferrer">GitHub</a>
                </div>
            </article>

            <article class="project-card">
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
                    <a href="umschulung.php" class="button button--primary">Live ansehen</a>
                    <a href="https://github.com/usmogier/bewerbung-portfolio" class="button" target="_blank" rel="noopener noreferrer">GitHub</a>
                </div>
            </article>

            <article class="project-card">
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
                    <a href="https://github.com/usmogier/bewerbung-portfolio" class="button button--primary" target="_blank" rel="noopener noreferrer">GitHub</a>
                </div>
            </article>
        </div>
    </div>

    <?php include "templates/footer.php" ?>
</body>
