<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    Database::init_database();
    if (!is_logged())
    {
        header("Location: /"); //redirection
    }

    if (!($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["stage_id"]))) { 
        header("Location: /"); //redirection
    }
    
    $id = $_GET["stage_id"];
    
    $stage = Database::get_stage_from_id($id);

    $competences = $stage["competences"];
    $competence_id_array = explode(",", $stage["infostage"]["competences"]);

        // Vérifie que le tableau n'est pas vide
        if (!empty($competence_id_array)) {
            // Convertit le tableau en une chaîne de type "1,2,3"
            $ids_string = implode(",", array_map("intval", $competence_id_array)); // sécurise chaque valeur

            $sql = "SELECT * FROM Competence WHERE id_Competence IN ($ids_string)";
            $competences_name_array = Database::execute_sql_all($sql);
            // echo "<pre>";print_r($stage);exit;
        } else {
            $competences_name_array = [];
        }
    // echo $id;
    // echo "<pre>"; print_r($stage); echo "</pre>"; exit;

    $dateDebut = (new DateTime($stage["date_debut"]))->format("d F Y");
    $dateFin = (new DateTime($stage["date_fin"]))->format("d F Y");

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
                <h3>Stage - <?= $stage["etudiant_prenom"]." ".$stage["etudiant_nom"] ?></h3>
                <p><strong>Titre du stage :</strong> <?= $stage["titre"] ?></p>
                <p><strong>Entreprise :</strong> <?= $stage["entreprise_nom"] ?> </p>
                <p><strong>Durée :</strong> <?=$dateDebut ?> - <?= $dateFin ?></p>
                <p><strong>Lieu :</strong> <?= $stage["entreprise_adresse"].", ".$stage["entreprise_ville"] ?></p>
                <p><strong>Date de soutenance :</strong> <?= $stage["date_soutenance"] ?></p>
                <p><strong>Tuteur de stage :</strong> <?= $stage["tuteur_entreprise_prenom"]." ".$stage["tuteur_entreprise_nom"].", (".$stage["tuteur_entreprise_email"].")" ?></p>
                <p><strong>Tuteur pédagogique :</strong> <?= $stage["tuteur_pedagogique_prenom"]." ".$stage["tuteur_pedagogique_nom"].", (".$stage["tuteur_pedagogique_email"].")" ?></p>
                <p><strong>Description :</strong> <?= $stage["description"] ?></p> 
                <p><strong>Tâches effectuées :</strong></p>
                <ul>
                    <?php foreach (explode("\n", $stage["taches"]) as $task):?>
                        <li><?= $task ?></li> 
                    <?php endforeach; ?>
                </ul>
                <p><strong>Validé :</strong> <?= $stage["valide"] ? "Oui" : "Non" ?></p>
                <!-- <p><strong>Évaluations :</strong> Note globale : 18/20</p> -->
            </div>
        </section>

         <?php if ($_SESSION["usertype"] == "student"):?>
                <a href=<?= L_MES_STAGES_FOLDER ?> class="back-button">Retour à la liste des stages</a>
        <?php elseif ($_SESSION["usertype"] == "tuteur"): ?>
            <a href=<?= L_DASHBOARD_FOLDER ?> class="back-button">Retour</a>
        <?php elseif ($_SESSION["usertype"] == "prof" || $_SESSION["usertype"] == "secretaire"): ?>
            <a href=<?= L_STUDENTS_FOLDER ?> class="back-button">Retour</a>
        <?php endif; ?>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
