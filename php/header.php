<?php 
    // Inclusion du fichier de configuration principal (contient probablement constantes, chemins, etc.)
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    
    // Inclusion des fonctions utilitaires PHP communes
    require_once ROOTPATH."/php/util.php";
    
    // Initialisation de la session PHP (démarre ou reprend une session existante)
    init_php_session();
?>
<header>
    <h1>Suivi des Stages</h1>
    <nav>
        <?php if ($_SESSION["usertype"] == "student"):?>
            <!-- Menu spécifique aux étudiants -->
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
            <a href=<?= L_NOTIFICATIONS_FOLDER ?>>Mes actions</a>
            <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents</a>

        <?php elseif ($_SESSION["usertype"] == "tuteur"):?>
            <!-- Menu spécifique aux tuteurs de stage -->
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
            <a href=<?= L_NOTIFICATIONS_FOLDER ?>>Mes actions</a>
            <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents Rendus</a>

        <?php else: ?> 
            <!-- Menu pour les autres types d'utilisateurs (ex : secrétaires, enseignants, administrateurs) -->
            <a href=<?= L_HOME_FOLDER ?>>Accueil</a>
            <!-- Le lien vers le tableau de bord est commenté pour ces utilisateurs -->
            <!-- <a href=<?= L_DASHBOARD_FOLDER ?>>Tableau de bord</a> -->
            <a href=<?= L_DEPARTMENTS_FOLDER ?>>Départements</a>
            <a href=<?= L_STUDENTS_FOLDER ?>>Mes étudiants</a>
            <?php if($_SESSION["usertype"] == "secretaire"): ?>
                <!-- Lien réservé aux secrétaires pour accéder aux enseignants -->
                <a href=<?= L_TEACHERS_FOLDER ?>>Enseignants</a>
            <?php endif; ?>
            <a href=<?= L_USERAREA_FOLDER ?>>Mon espace</a>
            <?php if($_SESSION["usertype"] == "secretaire"): ?>
                <!-- Lien réservé aux secrétaires pour accéder aux documents -->
                <a href=<?= L_DOCUMENTS_FOLDER ?>>Documents</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

    <!-- Affichage du logo de l'IUT, source dynamique via constante L_ASSETS_FOLDER -->
    <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo">
</header>
