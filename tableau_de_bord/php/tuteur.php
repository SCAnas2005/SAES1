<?php 
    $data = $_SESSION["data"];

    $students = [];
    if (isset($_SESSION["has_stage"]))
    {
        $stages = $data["stages"];
        for ($i = 0; $i < count($stages); $i++)
        {
            $stage = $stages[$i];
            $students[$i] = $stage["student"];
        }
    }
    $document_recu = 0;

    if (isset($_POST["submit"]))
?>

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
                <p><?= $document_recu ?> documents reçus</p>
                <!-- <span class="status">Validés</span> -->
            </div>
        
        </section>
        

        <section class="section">
            <?php if (count($students) > 0): ?>
                <?php for ($i = 0; $i < count($students); $i++): ?>
                    <div class="document-item">
                        <p> Etudiant : <strong> <?= $students[$i]["prenom"]." ".$students[$i]["nom"] ?> </strong></p> 
                        <a href=<?= L_STAGE_FOLDER."/index.php?id=".$stage["infostage"]["id"] ?>>Voir les détails du stages</a>
                    </div>
                <?php endfor; ?>
            
            <?php else: ?>
                <p>Vous n'avez pas d'étudiant</p>
            <?php endif; ?>
        </section>

        
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
