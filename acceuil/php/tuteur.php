
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Accueil</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_HOME_FOLDER."/css/other.css" ?> rel="stylesheet">
    
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    
    <div class="container">
        
        <section>
            <h2>Bienvenue sur la plateforme de suivi des stages</h2>
            <p>Cette plateforme vous permet de gérer efficacement les informations liées aux stages des étudiants. <br>
                Vous pourrez retrouver les documents rendus pas les étudiants dans l'espace "Document rendus".
            </p>
        </section>

       
        <!-- <section>
            <h2>Vos Notifications</h2>
            <ul>
                <li>NOM PRENOM a rendu son rapport</li>
                <li>Un nouveau message vous attend dans votre espace.</li>
            </ul>
            
        </section> -->
    </div>
      



    <div class="container">
        
        <section>
            <h2>Mes Stagiaires</h2>
            <p>Vous avez 2 stages en cours. Dernière mise à jour : <span id="last-update">15 septembre 2024</span></p>
            <button><a href="Espace_UsersV2.html">Voir mes Stagiaires</a></button>
        </section>

       
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
    </div>

    </main>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
    
</body>
</html>
