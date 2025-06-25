<?php 
    $stages = [];
    $data = $_SESSION["data"];
 // Si l'utilisateur a au moins un stage
    if (isset($_SESSION["has_stage"]) and $_SESSION["has_stage"])
    {
        $stages = $data["stages"];
        $notifications_number = 0;
        foreach ($stages as $stage) {
            $notifications_number+=count($stage["actions"]);
        }
        // $notifications_number = count($_SESSION["data"]["actions"]);
    }
    
    $n_stages = count($stages);
?>
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
    <!-- Inclusion du header (barre de navigation, logo, etc.) depuis un fichier externe -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    
    <div class="container">
        
        <section>
            <h2>Bienvenue sur la plateforme de suivi des stages</h2>
            <p>Cette plateforme vous permet de gérer efficacement les informations liées aux stages des étudiants. <br>
                Vous pourrez retrouver les documents rendus pas les étudiants dans l'espace "Document rendus".
            </p>
        </section>

       
        <section>
            <h2>Vos Notifications</h2>
            <ul>
                <?php if($_SESSION["has_stage"] and $notifications_number > 0): ?> <!-- Si l'utilisateur a des stages et au moins une action à faire -->
                    <li>Vous avez <?= $notifications_number ?> actions à faire</li>
                <?php else: ?>
                    <li>AUCUNE NOTIFICATION POUR LE MOMENT</li>
                <?php endif; ?>
            </ul>
            <a href=<?= L_NOTIFICATIONS_FOLDER ?> >Voir plus</a>
        </section>
    </div>
      



    <div class="container">
        
        <section>
            <h2>Mes Stagiaires</h2> <!-- Affichage des stagiaires gérés par l'utilisateur -->
            <p>Vous avez <?= $n_stages ?> stages en cours</p>
            <button><a href=<?= L_DASHBOARD_FOLDER ?>>Voir mes Stagiaires</a></button>
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
    <!-- Inclusion du footer depuis un fichier externe -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
    
</body>
</html>
