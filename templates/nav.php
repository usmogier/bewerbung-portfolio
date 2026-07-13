<?php $current = basename($_SERVER['PHP_SELF']); ?>
<nav class="navbar">
    <ul>
        <li><a href="index.php" class="<?php echo $current === 'index.php' ? 'active' : ''; ?>">Startseite</a></li>
        <li><a href="uebermich.php" class="<?php echo $current === 'uebermich.php' ? 'active' : ''; ?>">Über mich</a></li>
        <li><a href="projekte.php" class="<?php echo $current === 'projekte.php' ? 'active' : ''; ?>">Projekte</a></li>
        <li><a href="umschulung.php" class="<?php echo $current === 'umschulung.php' ? 'active' : ''; ?>">Umschulung</a></li>
        <li><a href="kontakt.php" class="<?php echo $current === 'kontakt.php' ? 'active' : ''; ?>">Kontakt</a></li>
    </ul>
</nav>
