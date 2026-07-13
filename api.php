<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');


$dbConfig = require __DIR__ . '/inc/db-config.php';
$host = $dbConfig['host'];
$db   = $dbConfig['name'];
$user = $dbConfig['user'];
$pass = $dbConfig['pass'];


try {

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";


    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Wenn die Verbindung fehlschlägt, geben wir einen JSON-Fehler zurück
    die(json_encode(["error" => "Datenbankverbindung fehlgeschlagen: " . $e->getMessage()]));
}

// 4. Routing: Prüfen, was das JavaScript (Frontend) haben möchte
$action = $_GET['action'] ?? '';

// --- AKTION 1: MODULE LADEN ---
if ($action === 'getModule') {
    $kategorie = $_GET['kategorie'] ?? '';

    if (empty($kategorie)) {
        die(json_encode(["error" => "Keine Kategorie angegeben"]));
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM module WHERE kategorie = :kategorie");
        $stmt->execute(['kategorie' => $kategorie]);
        $module = $stmt->fetchAll();


        echo json_encode($module);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Fehler bei der Datenbankabfrage: " . $e->getMessage()]);
    }
    exit;
}
if ($action === 'getThemen') {
    $modul_id = $_GET['modul_id'] ?? '';
    try {
        $stmt = $pdo->prepare("SELECT * FROM themen WHERE modul_id = :modul_id");
        $stmt->execute(['modul_id' => $modul_id]);
        echo json_encode($stmt->fetchAll());
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit;
}

// --- KARTEIKARTEN LADEN ---
if ($action === 'getFlashcards') {
    $thema_id = $_GET['thema_id'] ?? 0;
    try {
        $stmt = $pdo->prepare("SELECT * FROM karteikarten WHERE thema_id = :thema_id");
        $stmt->execute(['thema_id' => $thema_id]);
        echo json_encode($stmt->fetchAll());
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit;
}

// --- QUIZ LADEN ---
if ($action === 'getQuiz') {
    $thema_id = $_GET['thema_id'] ?? 0;
    try {
        $stmt = $pdo->prepare("SELECT * FROM quiz WHERE thema_id = :thema_id");
        $stmt->execute(['thema_id' => $thema_id]);
        $quizDaten = $stmt->fetchAll();

        foreach ($quizDaten as &$q) {
            $q['antworten'] = json_decode($q['antworten'], true);
            $decoded = json_decode($q['richtig'], true);
            $q['richtig'] = is_array($decoded) ? $decoded : [(int)$q['richtig']];
        }

        echo json_encode($quizDaten);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit;
}

if ($action === 'addFlashcard') {



    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert! Du bist nicht eingeloggt."]);
        exit;
    }


    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Daten aus dem Javascript abfangen
    $thema_id = $data['thema_id'] ?? 0;
    $front = $data['front'] ?? '';
    $back = $data['back'] ?? '';


    if (empty($thema_id) || empty($front) || empty($back)) {
        echo json_encode(["status" => "error", "message" => "Bitte alle Felder ausfüllen!"]);
        exit;
    }

    try {

        $stmt = $pdo->prepare("INSERT INTO karteikarten (thema_id, front, back) VALUES (:thema_id, :front, :back)");

        $stmt->execute([
            'thema_id' => $thema_id,
            'front' => $front,
            'back' => $back
        ]);

        echo json_encode(["status" => "success", "message" => "Karteikarte erfolgreich gespeichert!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

// ---KARTEIKARTE AKTUALISIEREN ---
if ($action === 'updateFlashcard') {

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert!"]);
        exit;
    }

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $id = $data['id'] ?? 0;
    $front = $data['front'] ?? '';
    $back = $data['back'] ?? '';

    if (empty($id) || empty($front) || empty($back)) {
        echo json_encode(["status" => "error", "message" => "Bitte alle Felder ausfüllen!"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE karteikarten SET front = :front, back = :back WHERE id = :id");
        $stmt->execute(['id' => $id, 'front' => $front, 'back' => $back]);
        echo json_encode(["status" => "success", "message" => "Karteikarte erfolgreich aktualisiert!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

// --- KARTEIKARTE LÖSCHEN ---
if ($action === 'deleteFlashcard') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert!"]);
        exit;
    }

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $id = $data['id'] ?? 0;

    if (empty($id)) {
        echo json_encode(["status" => "error", "message" => "Keine ID übergeben!"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM karteikarten WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo json_encode(["status" => "success", "message" => "Karteikarte gelöscht!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

// --- QUIZ HINZUFÜGEN ---
if ($action === 'addQuiz') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert!"]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $thema_id = $data['thema_id'] ?? 0;
    $frage    = $data['frage'] ?? '';
    $antworten = $data['antworten'] ?? [];
    $richtig  = $data['richtig'] ?? [];
    if (!is_array($richtig)) $richtig = [$richtig];

    if (empty($thema_id) || empty($frage) || count($antworten) < 2 || count($richtig) === 0) {
        echo json_encode(["status" => "error", "message" => "Bitte alle Felder ausfüllen (mind. 2 Antworten, mind. 1 richtige Antwort)!"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO quiz (thema_id, frage, antworten, richtig) VALUES (:thema_id, :frage, :antworten, :richtig)");
        $stmt->execute([
            'thema_id' => $thema_id,
            'frage'    => $frage,
            'antworten'=> json_encode($antworten, JSON_UNESCAPED_UNICODE),
            'richtig'  => json_encode($richtig)
        ]);
        echo json_encode(["status" => "success", "message" => "Quiz-Frage gespeichert!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

// --- QUIZ AKTUALISIEREN ---
if ($action === 'updateQuiz') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert!"]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $id       = $data['id'] ?? 0;
    $frage    = $data['frage'] ?? '';
    $antworten = $data['antworten'] ?? [];
    $richtig  = $data['richtig'] ?? [];
    if (!is_array($richtig)) $richtig = [$richtig];

    if (empty($id) || empty($frage) || count($antworten) < 2 || count($richtig) === 0) {
        echo json_encode(["status" => "error", "message" => "Bitte alle Felder ausfüllen!"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE quiz SET frage = :frage, antworten = :antworten, richtig = :richtig WHERE id = :id");
        $stmt->execute([
            'id'       => $id,
            'frage'    => $frage,
            'antworten'=> json_encode($antworten, JSON_UNESCAPED_UNICODE),
            'richtig'  => json_encode($richtig)
        ]);
        echo json_encode(["status" => "success", "message" => "Quiz-Frage aktualisiert!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

// --- QUIZ LÖSCHEN ---
if ($action === 'deleteQuiz') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(["status" => "error", "message" => "Zugriff verweigert!"]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? 0;

    if (empty($id)) {
        echo json_encode(["status" => "error", "message" => "Keine ID übergeben!"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM quiz WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo json_encode(["status" => "success", "message" => "Quiz-Frage gelöscht!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Datenbank-Fehler: " . $e->getMessage()]);
    }
    exit;
}

echo json_encode(["error" => "Ungültige API-Anfrage"]);
