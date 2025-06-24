<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    Database::init_database();

    if (!is_logged() or $_SESSION["usertype"] != "secretaire")
    {
        header("Location: /");
    }
    $data = $_SESSION["data"];

    $departement_id = $data["userinfo"]["id_Departement"];

    $dep = Database::get_departement_from_id($departement_id);
    $profs = Database::get_profs_from_dep($departement_id); 

    foreach ($profs as &$prof) {
        $prof["stages"] = Database::get_stage_from_tuteur_ens($prof["id"]);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignants - Suivi des Stages</title>
   <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
   <link href="css/style.css" rel="stylesheet">
</head>
<body>
   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main>
        <h2>Liste des Enseignants du département <?= $dep["libelle"] ?></h2>
        <?php if (count($profs) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Tuteur</th>
                    <th>Stagiaires</th>
                    <th>Détails</th>    
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($profs as $prof): ?>
                        <tr>
                            <td><?= $prof["nom"] ?></td>
                            <td><?= $prof["prenom"] ?></td>
                            <td><?= count($prof["stages"]) > 0 ? "Oui" : "Non" ?></td>
                            <td><?= count($prof["stages"]) ?></td>
                            <td>
                                <form method="post" action="<?= L_TEACHERS_FOLDER . "/stage/index.php" ?>">
                                    <input type="hidden" name="id_ens" value="<?= $prof["id"] ?>"> 
                                    <input type="submit" class="details-button" value="📄 Détails">
                                </form>
                            </td>
                            
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
