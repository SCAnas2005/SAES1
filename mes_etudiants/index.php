<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /");
    }
    $students = $_SESSION["data"]["students"];
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
   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main>
        <h2>Liste des Étudiants et Stages</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'Étudiant</th>
                    <th>Prénom de l'Étudiant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($students) > 0): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student["nom"] ?></td>
                            <td><?= $student["prenom"] ?></td>
                            <td><a href="" class="details-button">Détails stage</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3>Vous n'avez pas d'étudiants</h3>
                <?php endif; ?>
                <!-- Ajouter d'autres étudiants ici -->
            </tbody>
        </table>
        <a href="">Retour à la liste des départements</a>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
