<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /");
    }
    $data = $_SESSION["data"];
    $students = $data["my_departement_students"];
    $dep = $data["my_departement"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Département Informatique - Suivi des Stages</title>
   <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"] . "/php/header.php"; ?>

    <main class="main-content">
        <h2>Liste des Étudiants et Stages de votre département <?= $dep["libelle"] ?></h2>

        <?php if (count($students) > 0): ?>
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
                            <td><?= $student["student"]["nom"] ?></td>
                            <td><?= $student["student"]["prenom"] ?></td>
                            <td>
                                <?php $stageActif = $student["has_stage"] ? "Oui" : "Non"; ?>
                                <span class="stage-status <?= $student["has_stage"] ? 'active' : 'inactive' ?>">
                                    <?= $stageActif ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= L_STAGE_FOLDER . "/index.php?id=" . $student["stages"][0]["infostage"]["id"] ?>" class="arrow-button" title="Voir détails">→</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <h3 class="no-data">Vous n'avez pas d'étudiants</h3>
        <?php endif; ?>

        <a href="<?= L_DEPARTMENTS_FOLDER ?>" class="back-link">← Retour à la liste des départements</a>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"] . "/php/footer.php"; ?>
</body>
</html>

