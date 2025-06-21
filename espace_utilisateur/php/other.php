<?php 
    $user = $data["userinfo"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon espace - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
   
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">

        <div class="user-space-container">
     
            <div class="menu">
                <h2>Espace Utilisateur</h2>
                <ul>
                    <li ><a href="javascript:void(0)" onclick="showSection('info')" id="exemple" >Mes Informations</a></li>
                </ul>
            </div>
        
            
            <div class="main-content">
                
                <section id="info" class="infoperso">
                <h1>Mes Informations</h1>
                    <p><strong>Nom :</strong> <?= $user["nom"] ?></p>
                    <p><strong>Prénom :</strong> <?= $user["prenom"] ?></p>
                    <!-- <p><strong>Département :</strong> </p> -->
                    <p><strong>E-mail :</strong> <?= $user["email"] ?></p>
                    <p><strong>Téléphone :</strong> <?= $user["telephone"] ?></p>
                    <p><strong>Département :</strong> <?= $data["my_departement"]["libelle"] ?></p>
                    <p><strong>Statut :</strong> <?= get_userstatut($_SESSION["usertype"]) ?></p>
                </section>
            
            </div>
       
        </div>
        
        
        <div class="main-content">
        
        <section class="profile-actions">
            
            
            <a href="/php/deconnexion.php">Deconnexion</a>
        
        </section>
        
        </div>


    </main>
    
    
    
 
    <script src="../js/userspace.js"></script>

<?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
