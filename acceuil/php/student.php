<?php 
    $stage_number = 0;
    if ($_SESSION["has_stage"])
    {
        $stage_number = count($_SESSION["data"]["stages"]);
    }
?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Accueil</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_HOME_FOLDER."/css/student.css" ?> rel="stylesheet">
        
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <div class="container">
        
        <section>
            <h2>Bienvenue sur la plateforme de suivi des stages</h2>
            <p>Cette plateforme vous permet de gérer efficacement les informations liées aux stages des étudiants.</p>
        </section>

       
        <!-- <section>
            <h2>Vos Notifications</h2>
            <ul>
                <li>Votre rapport de stage a été validé par le tuteur.</li>
                <li>Le stage chez XYZ commence le 15 janvier.</li>
                <li>Un nouveau message vous attend dans votre espace.</li>
            </ul>
        </section> -->
    </div>
      



    <div class="container">
        
        <section>
            <h2>Mes Stages</h2>
            <p>Vous avez <?= $stage_number ?> stages en cours</p>
            <button><a href=<?= L_MES_STAGES_FOLDER ?>>Voir mes stages</a></button>
        </section>

       
        <section>
            <h2>Déposer un document</h2>
            <form action="upload_document.php" method="post" enctype="multipart/form-data">
                <label for="document">Choisir un fichier :</label>
                <input type="file" id="document" name="document" required>
                <a href=<?= L_DOCUMENTS_FOLDER ?>>Voir mes documents</a>
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
</body>
</html>
