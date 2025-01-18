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
    <title>Suivi des Stages - Gestion des Documents</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/tuteur.css" rel="stylesheet">

</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Gestion des Documents</h2>
            
            <div class="document-item">
            
                <p>Dans cet espace vous pouvez consultez et gérez les documents associés à vos stagiaires. <br>
                Vous pouvez également télécharger de nouveaux documents.</p>
            
            </div>
        
        </section>


        <section class="section document-list">
            <h3>Documents Rendus</h3>
            <div class="document-item">
                <span>Rapport de Stage - Juin 2024</span>
                <div>
                    <button class="form-button" onclick="window.location.href='download-link'">Télécharger</button>
                    <button class="form-button" onclick="alert('Document supprimé')">Supprimer</button>
                </div>
            </div>
            <div class="document-item">
                <span>Convention de Stage - Décembre 2023</span>
                <div>
                    <button class="form-button" onclick="window.location.href='download-link'">Télécharger</button>
                    <button class="form-button" onclick="alert('Document supprimé')">Supprimer</button>
                </div>
            </div>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
