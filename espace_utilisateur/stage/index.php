<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();

    $data = $_SESSION["data"];
    if ($_SESSION["usertype"] == "student")
    {
        $user = $data["userinfo"];
        $stage = $data["current_stage"];
        
    }else if ($_SESSION["usertype"] == "tuteur")
    {
        $id = $_GET["id"];
        foreach($data["stages"] as $stage)
        {
            if ($stage["infostage"]["id"] == $id)
            {
                $choosen_stage = $stage;
                break;
            }
        }

        $stage = $choosen_stage;
        $user = $choosen_stage["student"];
    }
    $dateDebut = (new DateTime($stage["infostage"]["date_debut"]))->format("d F Y");
    $dateFin = (new DateTime($stage["infostage"]["date_fin"]))->format("d F Y");
    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Stage - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Détails du Stage</h2>
            <div class="details-container">
                <h3>Stage</h3>
                <p><strong>Titre du stage :</strong> <?= $stage["infostage"]["titre"] ?></p>
                <p><strong>Entreprise :</strong> <?= $stage["entreprise"]["entreprise_nom"] ?> </p>
                <p><strong>Durée :</strong> <?=$dateDebut ?> - <?= $dateFin ?></p>
                <p><strong>Lieu :</strong> <?= $stage["entreprise"]["entreprise_adresse"].", ".$stage["entreprise"]["entreprise_ville"] ?></p>
                <p><strong>Date de soutenance :</strong> <?= $stage["infostage"]["date_soutenance"] ?></p>
                <p><strong>Tuteur de stage :</strong> <?= $stage["tuteur_entreprise"]["tuteur_prenom"]." ".$stage["tuteur_entreprise"]["tuteur_nom"].", (".$stage["tuteur_entreprise"]["tuteur_email"].")" ?></p>
                <p><strong>Tuteur pédagogique :</strong> <?= $stage["tuteur_pedagogique"]["tuteur_pedagogique_prenom"]." ".$stage["tuteur_pedagogique"]["tuteur_pedagogique_nom"].", (".$stage["tuteur_pedagogique"]["tuteur_pedagogique_email"].")" ?></p>
                <p><strong>Description :</strong> <?= $stage["infostage"]["description"] ?></p> 
                <p><strong>Tâches effectuées :</strong></p>
                <ul>
                    <?php foreach (explode("\n", $stage["infostage"]["taches"]) as $task):?>
                        <li><?= $task ?></li> 
                    <?php endforeach; ?>
                </ul>
                <!-- <p><strong>Évaluations :</strong> Note globale : 18/20</p> -->
            </div>
            <?php if ($_SESSION["usertype"] == "student"):?>
                <a href=<?= L_MES_STAGES_FOLDER ?> class="back-button">Retour à la liste des stages</a>
            <?php elseif ($_SESSION["usertype"] == "tuteur"): ?>
                <a href=<?= L_DASHBOARD_FOLDER ?> class="back-button">Retour</a>
            <?php endif; ?>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
