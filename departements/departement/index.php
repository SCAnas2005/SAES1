<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    Database::init_database();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /");
    }
    $data = $_SESSION["data"];
    $departement_id = $_GET["id"];
    $dep = Database::get_departement_from_id($departement_id);
    $students = Database::get_students_from_departement($departement_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Département - Suivi des Stages</title>
   <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
</head>
<body>
   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main>
        <h2>Liste des Étudiants du département <?= $dep["libelle"] ?></h2>
        <?php if (count($students) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'Étudiant</th>
                    <th>Prénom de l'Étudiant</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student["nom"] ?></td>
                            <td><?= $student["prenom"] ?></td>
                            <!-- <td><a href="" class="details-button">Détails stage</a></td> -->
                        </tr>
                    <?php endforeach; ?>
                    <!-- Ajouter d'autres étudiants ici -->
                </tbody>
            </table>
        <?php else: ?>
            <h3>Il n'y a aucun étudiant dans cette promotion</h3>
        <?php endif; ?>
        <a href=<?= L_DEPARTMENTS_FOLDER ?>>Retour à la liste des départements</a>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
