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
                    <li id="nav_info"><a href="javascript:void(0)" onclick="showSection('info')" id="exemple" >Mes Informations</a></li>
                    <li id="nav_stages"><a href="javascript:void(0)" onclick="showSection('stages')" id="exemplee">Mes Stages</a></li>
                    <li id="nav_infotuteur"><a href="javascript:void(0)" onclick="showSection('infotuteur')" id="tuteur">Mon Tuteur</a></li>
                    <li id="nav_infoentreprise"><a href="javascript:void(0)" onclick="showSection('infoentreprise')" id="tuteur">Mon Entreprise</a></li>
                </ul>
            </div>
        
            
            <div class="main-content">
                
                <section id="info" class="infoperso">
                    <h1>Mes Informations</h1>
                    <p><strong>Nom :</strong> </p>
                    <p><strong>Prénom :</strong> </p>
                    <p><strong>INE :</strong> </p>
                    <p><strong>Département :</strong> </p>
                    <p><strong>E-mail :</strong> </p>
                    <p><strong>Téléphone :</strong> </p>

                </section>
        
                <section id="stages" class="infostage">
                    <h1>Mes Stages</h1>

                    <ul>
                        <li>Stage 1 : Développement Web - 2024</li>
                        
                    </ul>

                </section>

                <section id="infotuteur" class="infotuteur">
                    <h1>Mon tuteur</h1>
                    
                    <p><strong>Nom :</strong> </p>
                    <p><strong>Prénom :</strong> </p>
                    <p><strong>E-mail :</strong> </p>
                    <p><strong>Téléphone :</strong> </p>
                        
                    
                </section>

                <section id="infoentreprise" class="infoentreprise">
                    <h1>Mon Entreprise</h1>
                    
                    <p><strong>Nom :</strong> </p>
                    <p><strong>Adresse :</strong> </p>
                    <p><strong>E-mail :</strong> </p>
                    <p><strong>Téléphone :</strong> </p>
                        
                    
                </section>
            
            
            </div>
       
        </div>
        
        
        <div class="main-content">
        
        <section class="profile-actions">
            
            <a href="#">Voir mes évaluations</a>
            <a href="#">Se déconnecter</a>
        
        </section>
        
        </div>


    </main>


    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
    
    
 
    <script src="../js/userspace.js"></script>

</body>
</html>
