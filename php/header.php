<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
?>
<header>
    <h1>Suivi des Stages</h1>
    <nav>
        <?php if ($_SESSION["usertype"] == "student"):?>
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
            <a href=<?= L_NOTIFICATIONS_FOLDER ?>>Mes actions</a>
            <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents</a>
        <?php elseif ($_SESSION["usertype"] == "tuteur"):?>
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
            <a href=<?= L_NOTIFICATIONS_FOLDER ?>>Mes actions</a>
            <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents Rendus</a>

        <?php else: ?> 
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <!-- <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a> -->
            <a href=<?= L_DEPARTMENTS_FOLDER ?>>Départements</a>
            <a href=<?= L_STUDENTS_FOLDER ?>>Mes étudiants</a>
            <?php if($_SESSION["usertype"] == "secretaire"): ?>
                <a href=<?= L_TEACHERS_FOLDER ?>>Enseignants</a>
            <?php endif; ?>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
             <?php if($_SESSION["usertype"] == "secretaire"): ?>
                <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
    <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo"> <!-- Logo IUT ajouté ici -->
</header>