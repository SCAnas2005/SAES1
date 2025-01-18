<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Tableau de Bord</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_DASHBOARD_FOLDER."/css/tuteur.css" ?> rel="stylesheet">
    
</head>
<body>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Tableau de Bord</h2>
            <p>Bienvenue sur votre tableau de bord, où vous pouvez consulter les informations importantes concernant vos stages.</p>
        </section>

        <section class="section dashboard-summary">
            
            <div class="summary-box">
                <h3>Documents reçus</h3>
                <p>3 documents reçus</p>
                <span class="status">Validés</span>
            </div>
        
        </section>
        
        <section class="section">
            <div class="document-item">
                  <p> Etudiants : <strong> NOM prenom </strong></p> 
                  <a href="#">Voir les details du stage </a> 
            </div>
            </section>

        
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
