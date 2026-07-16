<?php
$pageTitle = $pageTitle ?? 'Moritz Gierlinger – Anwendungsentwicklung';
$pageDescription = $pageDescription ?? 'Portfolio von Moritz Gierlinger, angehender Fachinformatiker für Anwendungsentwicklung auf der Suche nach einem Praktikumsplatz.';
$prettyPaths = [
    'index.php' => 'Startseite',
    'impressum.php' => 'Impressum',
    'datenschutz.php' => 'Datenschutz',
];
$currentScript = basename($_SERVER['PHP_SELF']);
$canonicalUrl = 'https://moritz-gierlinger.de/' . ($prettyPaths[$currentScript] ?? $currentScript);
?>
<!DOCTYPE html>
<html lang="de">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php echo htmlspecialchars($pageTitle); ?></title>
     <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
     <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

     <meta property="og:type" content="website">
     <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
     <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
     <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
     <meta property="og:image" content="https://moritz-gierlinger.de/images/bild1.jpg">
     <meta property="og:locale" content="de_DE">
     <meta name="twitter:card" content="summary">

     <link rel="icon" type="image/x-icon" href="images/Favicon.svg">
     <link rel="stylesheet" href="css/fonts.css">
     <link rel="stylesheet" href="css/matrix.css">
     <link rel="stylesheet" href="css/body.css">
     <link rel="stylesheet" href="css/img.css">
     <link rel="stylesheet" href="css/container.css">
     <link rel="stylesheet" href="css/button.css">
     <link rel="stylesheet" href="css/navigation.css">
     <link rel="stylesheet" href="css/footer.css">
     <link rel="stylesheet" href="css/form.css">
     <link rel="stylesheet" href="css/lernplattform.css">
     <link rel="stylesheet" href="css/responsive.css">
</head>