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
                    <p><strong>Nom :</strong> </p>
                    <p><strong>Prénom :</strong> </p>
                    <p><strong>E-mail :</strong> </p>
                    <p><strong>Téléphone :</strong> </p>

                </section>
            
            
            </div>
       
        </div>
        
        
        <div class="main-content">
        
        <section class="profile-actions">
            
            
            <a href="#">Se déconnecter</a>
        
        </section>
        
        </div>


    </main>
    
    
    
 
    <script>
        
        function showSection(sectionId) {
            
            
            var sections = document.querySelectorAll('.infoperso, .infostage, .infotuteur, .infoentreprise');
            sections.forEach(function(section) {
                section.style.display = 'none';
                
            });

            
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
            
            
            
        }


    </script>

<?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
