<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php"; // Inclusion des fichiers de configuration, base de données et utilitaires
    require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    Database::init_database();
    if (!is_logged()) // Vérification que l'utilisateur est connecté, sinon redirection vers la page d'accueil
    {
        header("Location: /"); //redirection
    }

    if (!($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["stage_id"]))) {  // Vérifie que la requête est un GET et que le paramètre 'stage_id' est présent
        header("Location: /"); //redirection
    }
    
    $id = $_GET["stage_id"]; // Récupération de l'identifiant du stage depuis l'URL
    
    $stage = Database::get_stage_from_id($id);

    $competences = Database::get_competences_from_stage($id)["competences"];   // Récupère les compétences liées au stage sous forme de chaîne "1,2,3"
    $competence_id_array = explode(",", $competences);

        // Vérifie que le tableau n'est pas vide
        if (!empty($competence_id_array)) { // Si le tableau d'ID de compétences n'est pas vide
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

    $dateDebut = (new DateTime($stage["date_debut"]))->format("d F Y"); // Formatage des dates début et fin du stage au format "jour mois année"
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
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>  <!-- Inclusion de l'en-tête commun -->

    <main class="main-content">
        <section class="section">
            <h2>Détails du Stage</h2>
            <div class="details-container">  <!-- Affichage des informations principales du stage -->
                <h3>Stage - <?= $stage["etudiant_prenom"]." ".$stage["etudiant_nom"] ?></h3>
                <p><strong>Titre du stage :</strong> <?= $stage["titre"] ?></p>
                <p><strong>Entreprise :</strong> <?= $stage["entreprise_nom"] ?> </p>
                <p><strong>Durée :</strong> <?=$dateDebut ?> - <?= $dateFin ?></p>
                <p><strong>Lieu :</strong> <?= $stage["entreprise_adresse"].", ".$stage["entreprise_ville"] ?></p>
                <p><strong>Date de soutenance :</strong> <?= $stage["date_soutenance"] ?></p>
                <p><strong>Tuteur de stage :</strong> <?= $stage["tuteur_entreprise_prenom"]." ".$stage["tuteur_entreprise_nom"].", (".$stage["tuteur_entreprise_email"].")" ?></p>
                <p><strong>Tuteur pédagogique :</strong> <?= $stage["tuteur_pedagogique_prenom"]." ".$stage["tuteur_pedagogique_nom"].", (".$stage["tuteur_pedagogique_email"].")" ?></p>
                <p><strong>Description :</strong> <?= $stage["description"] ?></p> 
                 <!-- Liste des tâches effectuées, séparées par saut de ligne -->
                <p><strong>Tâches effectuées :</strong></p>
                <ul>
                    <?php foreach (explode("\n", $stage["taches"]) as $task):?>
                        <li><?= $task ?></li> 
                    <?php endforeach; ?>
                </ul>
                <p><strong>Compétences liées :</strong></p>

                <?php if (isset($competences_name_array) && !empty($competences_name_array)): ?>
                    <ul>
                        <?php foreach ($competences_name_array as $competence): ?>
                            <li><?= htmlspecialchars($competence["titre"]) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucune compétence renseignée.</p>
                <?php endif; ?>
                <p><strong>Validé :</strong> <?= $stage["valide"] ? "Oui" : "Non" ?></p>
                <!-- <p><strong>Évaluations :</strong> Note globale : 18/20</p> -->
            </div>
        </section>
         <!-- Boutons de retour selon le type d'utilisateur connecté -->

         <?php if ($_SESSION["usertype"] == "student"):?>
                <a href=<?= L_MES_STAGES_FOLDER ?> class="back-button">Retour à la liste des stages</a>
        <?php elseif ($_SESSION["usertype"] == "tuteur"): ?>
            <a href=<?= L_DASHBOARD_FOLDER ?> class="back-button">Retour</a>
        <?php elseif ($_SESSION["usertype"] == "prof" || $_SESSION["usertype"] == "secretaire"): ?>
            <a href=<?= L_STUDENTS_FOLDER ?> class="back-button">Retour</a>
        <?php endif; ?>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?> <!-- Inclusion du pied de page commun -->
</body>
</html>
