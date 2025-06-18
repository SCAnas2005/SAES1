<?php 

    $notifications = [];
    $etudiant = $data["userinfo"];
    $stages = $data["stages"];
    if (isset($_SESSION["has_stage"]) and $_SESSION["has_stage"])
    {
        $notifications = [];
        foreach ($stages as $stage) {
            $notifications[$stage["infostage"]["id"]] = ["student"=>$stage["student"], "entreprise"=>$stage["entreprise"], "actions"=>$stage["actions"]];
        }
        // $notifications = $data["actions"];
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_NOTIFICATIONS_FOLDER."/css/style.css" ?> rel="stylesheet">
</head>
<body>
 <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Notifications</h2>
            <?php if (count($notifications) > 0): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="stagiaire-nom">
                        <span><?= $notification["student"]["prenom"]." ".$notification["student"]["nom"] ?></span>
                        <span class="entreprise-nom"><?= $notification["entreprise"]["entreprise_nom"] ?></span>
                    </div>
                    <?php if(count($notification["actions"]) > 0): ?>
                        <ul class="notification-list">
                            <?php foreach ($notification["actions"] as $action): ?>
                                <li class="notification-item">
                                    <!-- <h2></h2> -->
                                    <div>
                                        <h3><?= $action["libelle"] ?></h3>
                                        <p>Vous avez des actions à faire pour le <?= $action["date_realisation"] ?></p>
                                    </div>
                                    <!-- <a href="gestion_documents.html">Voir</a> -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Vous n'avez aucune actions à faire</p>   
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Vous n'avez aucune actions à faire</p>   
            <?php endif; ?>
        </section>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
