<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
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
                <tr>
                    <td>Dupont</td>
                    <td>Jean</td>
                    <td><a href="details_stage.html" class="details-button">Détails stage</a></td>
                </tr>
                <tr>
                    <td>Lemoine</td>
                    <td>Sophie</td>
                    <td><a href="details_stage.html" class="details-button">Détails stage</a></td>
                </tr>
                <!-- Ajouter d'autres étudiants ici -->
            </tbody>
        </table>
        <a href="index.html">Retour à la liste des départements</a>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
