<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";  // Inclusion des fonctions utilitaires
    init_php_session();  // Démarrage ou reprise de session 

    $deps = $_SESSION["data"]["departements"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Départements - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
	
<body>
	<!-- Inclusion du header commun (logo, navigation, etc.) -->
   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Départements</h2>
            <div class="departments-list">
                <?php foreach ($deps as $dep): ?> 
                <!-- Boucle sur tous les départements pour créer un lien vers chacun -->
                    <a href="departement/index.php?id=<?= $dep["id_Departement"] ?>" class="department-link">Département <?= $dep["libelle"] ?></a>
                <?php endforeach; ?>

            </div>
        </section>
    </main>
	 <!-- Inclusion du footer commun -->
   <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
