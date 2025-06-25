<?php 
    $data = $_SESSION["data"];  // Récupération des données utilisateur depuis la session
    $docs_number = get_docs_number($data["userinfo"]["id"]);     // Récupère le nombre de documents envoyés par l'utilisateur (via une fonction définie ailleurs)
    $stages_number = count($data["stages"]);  // Compte le nombre de stages associés à l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Tableau de Bord</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_DASHBOARD_FOLDER."/css/style.css" ?> rel="stylesheet">
</head>
<body>

    <?php require ROOTPATH."/php/header.php"; ?>  <!-- Inclusion du header commun au site -->

    <main class="main-content">
        <section class="section">  <!-- Section de bienvenue et présentation du tableau de bord -->
            <h2>Tableau de Bord</h2>
            <p>Bienvenue sur votre tableau de bord, où vous pouvez consulter les informations importantes concernant vos stages.</p>
        </section>

        <section class="section dashboard-summary"> <!-- Section récapitulative avec nombre de stages et documents -->
            <div class="summary-box">
                <h3>Stages en cours</h3>
                <p><?= $stages_number ?> stages actifs</p>
                <!-- <span class="status">En cours</span> -->
            </div>
            <div class="summary-box"> <!-- Sections commentées pouvant servir à afficher notifications ou échéances -->
                <h3>Documents envoyés</h3>
                <p><?= $docs_number ?> documents envoyés</p>
                <!-- <span class="status">Validés</span> -->
            </div>
            <!-- <div class="summary-box">
                <h3>Notifications récentes</h3>
                <p>3 notifications</p>
                <span class="status">Non lues</span>
            </div>
            <div class="summary-box">
                <h3>Prochaine échéance</h3>
                <p>Rapport de stage à soumettre</p>
                <span class="status">12 janvier 2025</span>
            </div> -->
        </section>

        <section class="section">  <!-- Section proposant des liens rapides vers des actions usuelles -->
            <h2>Actions rapides</h2>
            <ul>
                <li><a href=<?= L_MES_STAGES_FOLDER ?>>Voir mes stages</a></li>
                <li><a href=<?= L_DOCUMENTS_FOLDER ?>>Déposer un document</a></li>
                <li><a href=<?= L_NOTIFICATIONS_FOLDER ?>>Voir mes notifications</a></li>
            </ul>
        </section>
    </main>

    <?php require ROOTPATH."/php/footer.php"; ?> <!-- Inclusion du footer commun au site -->
</body>
</html>
