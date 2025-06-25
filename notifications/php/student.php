<?php 
    // Initialisation d'un tableau vide pour stocker les notifications à afficher
    $notifications = [];

    // Récupération des informations utilisateur depuis la variable $data (supposée préalablement définie)
    $userinfo = $data["userinfo"];

    // Vérification si l'utilisateur a un stage en cours, via une variable de session
    if (isset($_SESSION["has_stage"]) and $_SESSION["has_stage"] == true)
    {
        // Si l'utilisateur a un stage, on récupère les actions (notifications) liées à ce stage
        $notifications = $data["current_stage"]["actions"];

        // Décommenter la ligne ci-dessous pour debug : afficher les notifications et arrêter l'exécution
        // print_r($notifications);exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Suivi des Stages</title>
    <!-- Chargement des feuilles de style globales et spécifiques aux notifications -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_NOTIFICATIONS_FOLDER."/css/style.css" ?> rel="stylesheet">
</head>
<body>
    <!-- Inclusion du header commun, chemin dynamique depuis la session -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Notifications</h2>

            <?php if (count($notifications) > 0): ?>
                <!-- Affichage d'une liste des notifications/actions si elles existent -->
                <ul class="notification-list">
                    <?php foreach ($notifications as $notification): ?>
                        <li class="notification-item">
                            <div>
                                <!-- Titre de la notification -->
                                <h3><?= $notification["libelle"] ?></h3>
                                <!-- Description de l'action et date limite -->
                                <p>Vous avez des actions à faire pour le <?= $notification["date_realisation"] ?></p>
                            </div>
                            <!-- Lien vers une page de gestion des documents commenté pour l'instant -->
                            <!-- <a href="gestion_documents.html">Voir</a> -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <!-- Message affiché s'il n'y a aucune notification/action à faire -->
                <p>Vous n'avez aucune actions à faire</p>   
            <?php endif; ?>
        </section>
    </main>

    <!-- Inclusion du footer commun, chemin dynamique depuis la session -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
