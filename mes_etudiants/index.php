<?php 
    // Inclusion des fichiers de configuration et des fonctions utilitaires
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";

    // Initialisation de la session PHP
    init_php_session();

    // Redirection vers la page d'accueil si l'utilisateur n'est pas connecté
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /");
    }

    // Récupération des données utilisateur stockées en session
    $data = $_SESSION["data"];
    $students = $data["my_departement_students"]; // Liste des étudiants du département
    $dep = $data["my_departement"]; // Informations sur le département
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Adaptation mobile -->
    <title>Département Informatique - Suivi des Stages</title> <!-- Titre de la page -->
    
    <!-- Feuilles de styles globales et spécifiques -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Inclusion de l'en-tête commun -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"] . "/php/header.php"; ?>

    <main class="main-content">
        <!-- Titre principal avec le nom du département -->
        <h2>Liste des Étudiants et Stages de votre département <?= $dep["libelle"] ?></h2>

        <?php if (count($students) > 0): ?>
            <!-- Tableau affichant les étudiants et le statut de leur stage -->
            <table class="students-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th class="small-col">Stage actif</th>
                        <th class="small-col">Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <!-- Nom de l'étudiant -->
                            <td><?= $student["student"]["nom"] ?></td>

                            <!-- Prénom de l'étudiant -->
                            <td><?= $student["student"]["prenom"] ?></td>

                            <!-- Indication si l'étudiant a un stage actif -->
                            <td>
                                <?php $stageActif = $student["has_stage"] ? "Oui" : "Non"; ?>
                                <span class="stage-status <?= $student["has_stage"] ? 'active' : 'inactive' ?>">
                                    <?= $stageActif ?>
                                </span>
                            </td>

                            <!-- Lien vers les détails du stage si stage actif -->
                            <td>
                                <?php if ($student["has_stage"]): ?>
                                    <a href="<?= L_STAGE2_FOLDER . "/stage.php?stage_id=" . $student["stages"][0]["infostage"]["id_Stage"] ?>" class="arrow-button" title="Voir détails">→</a>
                                <?php endif; ?>        
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <!-- Message affiché si aucun étudiant n'est trouvé -->
            <h3 class="no-data">Vous n'avez pas d'étudiants</h3>
        <?php endif; ?>

        <!-- Lien pour revenir à la liste des départements -->
        <a href="<?= L_DEPARTMENTS_FOLDER ?>" class="back-link">← Retour à la liste des départements</a>
    </main>

    <!-- Inclusion du pied de page commun -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"] . "/php/footer.php"; ?>
</body>
</html>
