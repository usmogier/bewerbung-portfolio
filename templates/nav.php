<?php $prefix = basename($_SERVER['PHP_SELF']) === 'index.php' ? '' : 'Startseite'; ?>
<nav class="navbar">
    <button type="button" class="navbar-toggle" aria-label="Menü öffnen" aria-expanded="false" aria-controls="navbar-menu">
        <span class="navbar-toggle-bar"></span>
        <span class="navbar-toggle-bar"></span>
        <span class="navbar-toggle-bar"></span>
    </button>
    <ul id="navbar-menu">
        <li><a href="<?php echo $prefix; ?>#start" data-section="start">Startseite</a></li>
        <li><a href="<?php echo $prefix; ?>#ueber-mich" data-section="ueber-mich">Über mich</a></li>
        <li><a href="<?php echo $prefix; ?>#projekte" data-section="projekte">Projekte</a></li>
        <li><a href="<?php echo $prefix; ?>#umschulung" data-section="umschulung">Umschulung</a></li>
        <li><a href="<?php echo $prefix; ?>#kontakt" data-section="kontakt">Kontakt</a></li>
    </ul>
</nav>
