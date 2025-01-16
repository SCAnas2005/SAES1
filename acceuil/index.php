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
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <div class="container">
        
        <section>
            <h2>Bienvenue sur la plateforme de suivi des stages</h2>
            <p>Cette plateforme vous permet de gérer efficacement les informations liées aux stages des étudiants.</p>
        </section>

       
        <section>
            <h2>Vos Notifications</h2>
            <ul>
                <li>Votre rapport de stage a été validé par le tuteur.</li>
                <li>Le stage chez XYZ commence le 15 janvier.</li>
                <li>Un nouveau message vous attend dans votre espace.</li>
            </ul>
            
        </section>
    </div>
      



    <div class="container">
        
        <section>
            <h2>Mes Stages</h2>
            <p>Vous avez 2 stages en cours. Dernière mise à jour : <span id="last-update">15 septembre 2024</span></p>
            <button><a href="Espace_UsersV2.html">Voir mes stages</a></button>
        </section>

       
        <section>
            <h2>Déposer un document</h2>
            <form action="upload_document.php" method="post" enctype="multipart/form-data">
                <label for="document">Choisir un fichier :</label>
                <input type="file" id="document" name="document" required>
                <button type="submit">Soumettre</button>
            </form>
        </section>
    </div>

        
    
        <section>
            <h2>Contactez-nous</h2>
            <form action="contact.php" method="post">
                <label for="name">Votre nom :</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Votre email :</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Votre message :</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit">Envoyer</button>
            </form>
        </section>

    
        <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
    
    </main>
</body>
</html>
