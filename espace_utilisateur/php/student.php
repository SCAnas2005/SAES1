<?php 
    
    $user = $data["userinfo"];
    
    if ($_SESSION["has_stage"])
    {
        $stages = $data["stages"];
        $tuteur_entreprise = $data["current_stage"]["tuteur_entreprise"];
        $tuteur_peda = $data["current_stage"]["tuteur_pedagogique"];
        $entreprise = $data["current_stage"]["entreprise"];
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon espace - Suivi des Stages</title>

    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_USERAREA_FOLDER."/css/style.css" ?> rel="stylesheet">
   
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
                    <li id="nav_infotuteur"><a href="javascript:void(0)" onclick="showSection('infotuteur')" id="tuteur">Mon tuteur de stage</a></li>
                    <li id="nav_infotuteurpeda"><a href="javascript:void(0)" onclick="showSection('infotuteurpeda')" id="tuteur">Mon tuteur pédagogique</a></li>
                    <li id="nav_infoentreprise"><a href="javascript:void(0)" onclick="showSection('infoentreprise')" id="tuteur">Mon Entreprise</a></li>
                </ul>
            </div>
        
            
            <div class="main-content">
                
                <section id="info" class="infoperso">
                    <h1>Mes Informations</h1>
                    <p><strong>Nom :</strong> <?= $user["nom"] ?></p>
                    <p><strong>Prénom :</strong> <?= $user["prenom"] ?></p>
                    <p><strong>INE :</strong> <?= $user["login"] ?></p>
                    <!-- <p><strong>Département :</strong> </p> -->
                    <p><strong>E-mail :</strong> <?= $user["email"] ?></p>
                    <p><strong>Téléphone :</strong> <?= $user["telephone"] ?></p>

                </section>
        
                <section id="stages" class="infostage">
                    <h1>Mes Stages</h1>
                    <?php if($_SESSION["has_stage"]):?>
                        <?php foreach ($stages as $stage): ?>
                            <ul>
                                <li><a href=<?= L_STAGE_FOLDER ?>>Stage : <?= $stage["infostage"]["titre"] ?></a></li>
                            </ul>
                        <?php endforeach; ?>
                    <?php else:?>
                        <p>Aucun stage</p>
                    <?php endif;?>

                </section>

                <section id="infotuteur" class="infotuteur">
                    <h1>Mon tuteur</h1>
                    <?php if($_SESSION["has_stage"]):?>
                        <p><strong>Nom :</strong> <?= $tuteur_entreprise["tuteur_nom"] ?></p>
                        <p><strong>Prénom :</strong> <?= $tuteur_entreprise["tuteur_prenom"] ?> </p>
                        <p><strong>E-mail :</strong> <?= $tuteur_entreprise["tuteur_email"] ?> </p>
                        <p><strong>Téléphone :</strong> <?= $tuteur_entreprise["tuteur_tel"] ?> </p>
                    <?php else:?>
                        <p>Aucun tuteur d'entreprise</p>
                    <?php endif;?>
                </section>

                <section id="infotuteurpeda" class="infotuteurpeda">
                    <h1>Mon tuteur pédagogique</h1>
                    <?php if($_SESSION["has_stage"]):?>
                        <p><strong>Nom :</strong> <?= $tuteur_peda["tuteur_pedagogique_nom"] ?></p>
                        <p><strong>Prénom :</strong> <?= $tuteur_peda["tuteur_pedagogique_prenom"] ?> </p>
                        <p><strong>E-mail :</strong> <?= $tuteur_peda["tuteur_pedagogique_email"] ?> </p>
                        <p><strong>Téléphone :</strong> <?= $tuteur_peda["tuteur_pedagogique_tel"] ?> </p>
                    <?php else:?>
                        <p>Aucun tuteur pédagogique</p>
                    <?php endif;?>
                </section>

                <section id="infoentreprise" class="infoentreprise">
                    <h1>Mon Entreprise</h1>
                    <?php if($_SESSION["has_stage"]):?>
                        <p><strong>Nom :</strong> <?= $entreprise["entreprise_nom"] ?></p>
                        <p><strong>Adresse :</strong> <?= $entreprise["entreprise_adresse"] ?></p>
                        <p><strong>Ville :</strong> <?= $entreprise["entreprise_ville"] ?></p>
                        <p><strong>Téléphone :</strong> <?= $entreprise["entreprise_tel"] ?></p>
                    <?php else:?>
                        <p>Aucune entreprise</p>
                    <?php endif;?>
                </section>
            
            
            </div>
       
        </div>
        
        
        <div class="main-content">
        
        <section class="profile-actions">
            
            <!-- <a href="#">Voir mes évaluations</a> -->
            <a href="/php/deconnexion.php">Deconnexion</a>
                
        
        </section>
        
        </div>


    </main>


    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
    
    
 
    <script src="../js/userspace.js"></script>

</body>