<?php
// Vorlage für inc/admin-config.php – Datei kopieren, umbenennen und echten Hash eintragen.
// inc/admin-config.php selbst ist in .gitignore und wird nie committet.
//
// Hash erzeugen: php -r "echo password_hash('dein-passwort', PASSWORD_DEFAULT);"

return [
    'password_hash' => '$2y$10$Platzhalter.Platzhalter.Platzhalter.Platzhalter.Platzhalter',
];
