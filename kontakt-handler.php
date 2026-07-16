<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Startseite#kontakt');
    exit;
}

// Spam-Falle: Bots füllen versteckte Felder aus, echte Besucher nicht
if (($_POST['website'] ?? '') !== '') {
    header('Location: Startseite?status=success#kontakt');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$nachricht = trim((string) ($_POST['nachricht'] ?? ''));

// Zeilenumbrüche aus Name/E-Mail entfernen, um Header-Injection zu verhindern
$name = preg_replace('/[\r\n]+/', ' ', $name);
$email = preg_replace('/[\r\n]+/', '', $email);

$isValid = $name !== '' && mb_strlen($name) <= 100
    && filter_var($email, FILTER_VALIDATE_EMAIL) !== false && mb_strlen($email) <= 150
    && $nachricht !== '' && mb_strlen($nachricht) <= 5000;

if (!$isValid) {
    header('Location: Startseite?status=error#kontakt');
    exit;
}

$empfaenger = 'info@moritz-gierlinger.de';
$betreff = 'Neue Nachricht über das Kontaktformular';
$inhalt = "Name: {$name}\n"
    . "E-Mail: {$email}\n\n"
    . "Nachricht:\n{$nachricht}\n";

$headers = [
    'From: Kontaktformular <no-reply@moritz-gierlinger.de>',
    'Reply-To: ' . mb_encode_mimeheader($name) . " <{$email}>",
    'Content-Type: text/plain; charset=UTF-8',
];

$erfolg = mail($empfaenger, $betreff, $inhalt, implode("\r\n", $headers));

header('Location: Startseite?status=' . ($erfolg ? 'success' : 'error') . '#kontakt');
exit;
