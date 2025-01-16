
<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
?>
<header>
    <h1>Suivi des Stages</h1>
    <nav>
        <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
        <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a>
        <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
        <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents</a>
    </nav>
    <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo"> <!-- Logo IUT ajouté ici -->
</header>