<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    Database::init_database();
     // Vérification que l'utilisateur est connecté
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /"); // Redirection vers la page d'accueil si non connecté
    }
    $data = $_SESSION["data"];
    $departement_id = $_GET["id"];  // Récupération de l'identifiant du département passé en paramètre GET
    if ($data["my_departement"]["id_Departement"] == $departement_id)
    {
        header("Location: ".L_STUDENTS_FOLDER);
    }

    $dep = Database::get_departement_from_id($departement_id);  // Récupération des informations du département via la base
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
                
                    <?php foreach ($students as $student): ?>  <!-- Boucle affichant chaque étudiant dans une ligne -->
                        <tr>
                            <td><?= $student["nom"] ?></td>
                            <td><?= $student["prenom"] ?></td>
                            <!-- <td><a href="" class="details-button">Détails stage</a></td> -->
                        </tr>
                    <?php endforeach; ?>
                    <!-- Ajouter d'autres étudiants ici -->
                </tbody>
            </table>
        <?php else: ?> <!-- Sinon, affichage d'un message si aucun étudiant -->
            <h3>Il n'y a aucun étudiant dans cette promotion</h3>
        <?php endif; ?>
        <a href=<?= L_DEPARTMENTS_FOLDER ?>>Retour à la liste des départements</a>
    </main>

   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
