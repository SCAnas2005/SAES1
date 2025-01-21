<?php 

    $notifications = [];
    $etudiant = $data["userinfo"];
    if (isset($_SESSION["has_stage"]) and $_SESSION["has_stage"])
    {
        $notifications = $data["actions"];
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
                <ul class="notification-list">
                    <?php foreach ($notifications as $notification): ?>
                        <li class="notification-item">
                            <h2></h2>
                            <div>
                                <h3><?= $notification["libelle"] ?></h3>
                                <p>Vous avez des actions à faire pour le <?= $notification["date_realisation"] ?></p>
                            </div>
                            <!-- <a href="gestion_documents.html">Voir</a> -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Vous n'avez aucune actions à faire</p>   
            <?php endif; ?>
        </section>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
