<?php
$status = $_GET['status'] ?? '';
include "templates/head.php" ?>

<body>
    <?php include "templates/nav.php" ?>
    <canvas id="matrixCanvas"></canvas>
    <div class="container">
        <h1>Kontaktieren Sie mich!</h1>
        <p>Haben Sie Fragen oder ein spannendes Praktikumsangebot? Schreiben Sie mir!</p>

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
                <label for="name">Dein Name:</label>
                <input type="text" id="name" name="name" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="email">Deine E-Mail:</label>
                <input type="email" id="email" name="email" required maxlength="150">
            </div>

            <div class="form-group">
                <label for="nachricht">Deine Nachricht:</label>
                <textarea id="nachricht" name="nachricht" required maxlength="5000"></textarea>
            </div>

            <div class="form-group form-group--honeypot" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <button type="submit" class="button button--primary">Absenden</button>

        </form>

    </div>
    <?php include "templates/footer.php" ?>

</body>