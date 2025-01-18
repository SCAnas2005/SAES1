<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();

    $id_stage = $_GET["stageid"];

    

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
                <h3>Stage : Développement Web</h3>
                <p><strong>Titre du stage :</strong> Conception et développement d'une application de gestion</p>
                <p><strong>Entreprise :</strong> <?= $user["nom_entreprise"] ?> </p>
                <p><strong>Durée :</strong> <?= $user["date_debut"] ?> - <?= $user["date_fin"] ?></p>
                <p><strong>Lieu :</strong> <?= $user["adresse_entreprise"].", ".$user["ville_entreprise"] ?></p>
                <p><strong>Date de soutenance :</strong> 15 Septembre 2024</p>
                <p><strong>Tuteur de stage :</strong> <?= $user["prenom_tuteur_stage"]." ".$user["nom_tuteur_stage"].", (".$user["email_tuteur_stage"].")" ?></p>
                <p><strong>Tuteur pédagogique :</strong> <?= $user["prenom_tuteur_enseignant_1"]." ".$user["nom_tuteur_enseignant_1"].", (".$user["email_tuteur_enseignant_1"].")" ?></p>
                <!-- <p><strong>Description :</strong> Participation à la conception et au développement d'une application web pour la gestion des clients.</p> -->
                <!-- <p><strong>Tâches effectuées :</strong></p> -->
                <!-- <ul>
                    <li>Développement des interfaces utilisateurs (HTML, CSS, JavaScript).</li>
                    <li>Création de fonctionnalités backend avec PHP et MySQL.</li>
                    <li>Tests et débogage des fonctionnalités.</li>
                </ul> -->
                <!-- <p><strong>Évaluations :</strong> Note globale : 18/20</p> -->
                <a href=<?= L_MES_STAGES_FOLDER ?> class="back-button">Retour à la liste des stages</a>
            </div>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
