
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
    <title>Suivi des Stages - Accueil</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    
    <?php require "../php/header.php"; ?>
    <main>
        <section class="connexion">
            <h2>Connectez-nous</h2>
            <form action="/SAES1-main/php/PageAccueil.php" method="post">
                <ul>
                    <li>
                    <label for="name">Nom&nbsp;:</label>
                    <input type="text" id="name" name="user_name" />
                    </li>
                    <li>
                    <label for="mdp">Mot de passe&nbsp;:</label>
                    <input type="text" id="mdp" name="motdepasse" />
                    </li>
                </ul>
                <div class="button">
                <button type="submit">Me connecter</button>
                </div>
            </form>
        </section>
    </main>

    <?php require "../php/footer.php"; ?>
</body>
</html>
