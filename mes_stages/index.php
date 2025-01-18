<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir mes Stages - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Mes Stages</h2>
            <p>Voici la liste de vos stages :</p>
            <ul class="stage-list">
                <li class="stage-item">
                    <div>
                        <h3>Stage Développement Web</h3>
                        <span>Entreprise : TechCorp | Juin 2024</span>
                    </div>
                    <a href="stage_detail_web.html">Voir Détails</a>
                </li>
                <li class="stage-item">
                    <div>
                        <h3>Stage Analyse de Données</h3>
                        <span>Entreprise : DataAnalytica | Décembre 2024</span>
                    </div>
                    <a href="stage_detail_data.html">Voir Détails</a>
                </li>
                <li class="stage-item">
                    <div>
                        <h3>Stage Sécurité Informatique</h3>
                        <span>Entreprise : SecureTech | Mars 2025</span>
                    </div>
                    <a href="stage_detail_security.html">Voir Détails</a>
                </li>
            </ul>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
