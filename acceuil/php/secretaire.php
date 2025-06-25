<?php 
    $student_count = count($_SESSION["data"]["my_departement_students"]);
    $profs_count = count($_SESSION["data"]["my_departement_profs"]);
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
            <p>Cette plateforme vous permet de gérer efficacement les informations liées aux stages des étudiants.</p>
        </section>

       
        <section>
            <h2>Vos Notifications</h2>
            <ul>
                <li>AUCUNE NOTIFICATION POUR LE MOMENT</li>
            </ul>
            
        </section>
    </div>
      



    <div class="container">
        
        <section>
            <h2>Mes Etudiants</h2>
            <p>Vous avez <?= $student_count ?> etudiants dans votre promotions.</p>
            <a href=<?= L_STUDENTS_FOLDER ?>>Voir ma promotion</a>
        </section>

       
        <section>
            <h2>Les enseignants</h2>
            <p>Vous avez <?= $profs_count ?> enseignants dans votre promotions.</p>
            <a href=<?= L_TEACHERS_FOLDER ?>>Voir</a>
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

    
        </main>
        <!-- Inclusion du footer depuis un fichier externe -->
        <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
