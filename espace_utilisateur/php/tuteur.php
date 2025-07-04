<?php 
    $user = $data["userinfo"]; // Récupération des informations de l'utilisateur depuis la variable $data (souvent initialisée en session)
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
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?> <!-- Inclusion de l'en-tête commun à toutes les pages -->

    <main class="main-content">

        <div class="user-space-container">
     
            <div class="menu">
                <h2>Espace Utilisateur</h2>
                <ul> <!-- Menu simple avec un seul lien affichant la section "Mes Informations" -->
                    <li ><a href="javascript:void(0)" onclick="showSection('info')" id="exemple" >Mes Informations</a></li>
                </ul>
            </div>
        
            
            <div class="main-content">
                
                <section id="info" class="infoperso"> <!-- Section contenant les informations personnelles de l'utilisateur -->
                <h1>Mes Informations</h1>
                    <p><strong>Nom :</strong> <?= $user["nom"] ?></p>
                    <p><strong>Prénom :</strong> <?= $user["prenom"] ?></p>
                    <!-- <p><strong>Département :</strong> </p> -->
                    <p><strong>E-mail :</strong> <?= $user["email"] ?></p>
                    <p><strong>Téléphone :</strong> <?= $user["telephone"] ?></p>
                    <p><strong>Statut :</strong> <?= get_userstatut($_SESSION["real_usertype"])  ?></p>
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
 <!-- Inclusion du pied de page commun -->
<?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
