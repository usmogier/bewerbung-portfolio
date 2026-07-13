<?php
$pageTitle = 'Über mich – Moritz Gierlinger';
$pageDescription = 'Werdegang, Skills und Ausbildungsstand von Moritz Gierlinger, angehender Fachinformatiker für Anwendungsentwicklung.';
include "templates/head.php" ?>

<body>
    <canvas id="matrixCanvas"></canvas>
    <?php include "templates/nav.php" ?>

    <div class="container profile">
        <img src="images/moritz-gierlinger.jpg" alt="Moritz Gierlinger" class="profile-photo">
        <p class="eyebrow">Über mich</p>
        <h1>Vom Sozialökonomen zum Anwendungsentwickler</h1>

        <p>
            Seit Juni 2025 mache ich bei der GFN in Nürnberg eine Umschulung zum
            Fachinformatiker für Anwendungsentwicklung &ndash; im Zuge dessen suche
            ich einen Platz für mein neunmonatiges Pflichtpraktikum.
        </p>
        <p>
            Vorher habe ich Sozialökonomie an der Friedrich-Alexander-Universität
            Erlangen-Nürnberg studiert (B.A. und M.Sc.) und dabei intensiv mit
            Statistik-Software wie R und Stata gearbeitet. Die Faszination, mit
            Code und logischen Strukturen funktionierende Lösungen zu bauen, hat
            mich schließlich zur Anwendungsentwicklung geführt. Erste praktische
            Erfahrung im Umgang mit Datenbanken habe ich bereits während eines
            Praktikums gesammelt, in dem ich eine Datenbank zur Erfassung von
            KPIs aufgebaut habe.
        </p>
        <p>
            Ich bin zuverlässig, kommunikativ und arbeite gerne im Team &ndash;
            und beschäftige mich auch über die Umschulung hinaus eigenständig mit
            dem Programmieren, unter anderem an dieser Website.
        </p>

        <h2>Skills</h2>
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
    </div>
    <?php include "templates/footer.php" ?>
</body>

