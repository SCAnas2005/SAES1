<?php 

    // Initialisation d'un tableau vide pour stocker les notifications
    $notifications = [];

    // Récupération des informations de l'étudiant depuis la variable $data
    $etudiant = $data["userinfo"];

    // Récupération de la liste des stages liés à l'étudiant
    $stages = $data["stages"];

    // Vérification si la session indique que l'utilisateur a au moins un stage
    if (isset($_SESSION["has_stage"]) and $_SESSION["has_stage"])
    {
        // Réinitialisation du tableau des notifications
        $notifications = [];

        // Parcours de chaque stage pour construire la liste des notifications
        foreach ($stages as $stage) {
            // Pour chaque stage, on associe un tableau contenant :
            // - les informations de l'étudiant ("student")
            // - les informations de l'entreprise ("entreprise")
            // - les actions liées au stage ("actions")
            // On utilise l'ID du stage comme clé dans le tableau $notifications
            $notifications[$stage["infostage"]["id"]] = [
                "student" => $stage["student"], 
                "entreprise" => $stage["entreprise"], 
                "actions" => $stage["actions"]
            ];
        }

        // Variante non utilisée : on pourrait utiliser directement $data["actions"] pour les notifications
        // $notifications = $data["actions"];
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Suivi des Stages</title>

    <!-- Inclusion de la feuille de style globale -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">

    <!-- Inclusion de la feuille de style spécifique aux notifications -->
    <link href=<?= L_NOTIFICATIONS_FOLDER."/css/style.css" ?> rel="stylesheet">
</head>
<body>

    <!-- Inclusion du header commun depuis le chemin stocké en session -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Notifications</h2>

            <?php if (count($notifications) > 0): ?>
                <!-- Pour chaque notification (associée à un stage), on affiche les infos -->
                <?php foreach ($notifications as $notification): ?>
                    <div class="stagiaire-nom">
                        <!-- Affichage du prénom et nom de l'étudiant -->
                        <span><?= $notification["student"]["prenom"]." ".$notification["student"]["nom"] ?></span>
                        <!-- Affichage du nom de l'entreprise -->
                        <span class="entreprise-nom"><?= $notification["entreprise"]["entreprise_nom"] ?></span>
                    </div>

                    <?php if(count($notification["actions"]) > 0): ?>
                        <!-- Liste des actions à faire pour ce stage -->
                        <ul class="notification-list">
                            <?php foreach ($notification["actions"] as $action): ?>
                                <li class="notification-item">
                                    <div>
                                        <!-- Titre de l'action -->
                                        <h3><?= $action["libelle"] ?></h3>
                                        <!-- Date limite pour réaliser cette action -->
                                        <p>Vous avez des actions à faire pour le <?= $action["date_realisation"] ?></p>
                                    </div>
                                    <!-- Lien vers la gestion des documents désactivé pour l'instant -->
                                    <!-- <a href="gestion_documents.html">Voir</a> -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <!-- Message affiché s'il n'y a aucune action à faire pour ce stage -->
                        <p>Vous n'avez aucune actions à faire</p>   
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message affiché si aucun stage/notification n'existe -->
                <p>Vous n'avez aucune actions à faire</p>   
            <?php endif; ?>
        </section>
    </main>

    <!-- Inclusion du footer commun depuis le chemin stocké en session -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
