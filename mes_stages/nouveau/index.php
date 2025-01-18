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
    <title>Ajouter un Stage - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Nouveau Stage</h2>
            <form action="ajouter_stage_process.php" method="POST">
                <label for="titre">Titre du stage :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre du stage" required>

                <label for="entreprise">Entreprise :</label>
                <input type="text" id="entreprise" name="entreprise" placeholder="Nom de l'entreprise" required>

                <label for="duree">Durée :</label>
                <input type="text" id="duree" name="duree" placeholder="Ex : 1er Juin 2024 - 30 Août 2024" required>

                <label for="lieu">Lieu :</label>
                <input type="text" id="lieu" name="lieu" placeholder="Ex : Paris, France" required>

                <label for="date-soutenance">Date de soutenance :</label>
                <input type="date" id="date-soutenance" name="date-soutenance" required>

                <label for="tuteur-stage">Tuteur de stage :</label>
                <input type="text" id="tuteur-stage" name="tuteur-stage" placeholder="Nom du tuteur de stage" required>

                <label for="tuteur-pedagogique">Tuteur pédagogique :</label>
                <input type="text" id="tuteur-pedagogique" name="tuteur-pedagogique" placeholder="Nom du tuteur pédagogique" required>

                <label for="description">Description :</label>
                <textarea id="description" name="description" placeholder="Décrivez les objectifs du stage" rows="5" required></textarea>

                <label for="taches">Tâches effectuées :</label>
                <textarea id="taches" name="taches" placeholder="Listez les tâches principales" rows="5" required></textarea>

                <button type="submit">Ajouter le Stage</button>
            </form>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
