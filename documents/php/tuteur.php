<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    $data = $_SESSION["data"];  // Récupération des données stockées en session (informations utilisateur, stages, etc.)
    $stages = [];
    if (isset($_SESSION["has_stage"]))   // Vérification si l'utilisateur a des stages associés
    {
        $stages = $data["stages"]; // Récupération des stages
    
        $output_tab = [];
        foreach ($stages as $stage) {  // Parcours de tous les stages
            $student_id = $stage["student"]["id"];  // Récupération de l'id de l'étudiant associé au stage
            array_push($output_tab, [$stage, get_user_docs($student_id)]);
        }
    
        if (isset($_POST["download"]))  // Si un téléchargement est demandé via POST
        {
            $_SESSION["download_file"] = $_POST["download"];
            header("Location: ". L_DOCUMENTS_FOLDER."/php/download.php");
        }
    
        if (isset($_POST["remove"]))  // Si une suppression est demandée via POST
        {
            $_SESSION["remove_file"] = $_POST["remove"];
            header("Location: ". L_DOCUMENTS_FOLDER."/php/remove.php");
        }

    }
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
            
                <p>Dans cet espace vous pouvez consultez les documents associés à vos stagiaires. <br>
                Vous pouvez également télécharger de nouveaux documents.</p>
            
            </div>
        
        </section>


        <section class="section document-list">
            <h3>Documents Rendus</h3>
            <?php if (count($stages) > 0): ?>
                <?php foreach ($output_tab as $tab): ?>
                    <div class="stagiaire-nom">
                        <span><?= $tab[0]["student"]["prenom"]." ".$tab[0]["student"]["nom"] ?></span>
                        <span class="entreprise-nom"><?= $tab[0]["entreprise"]["entreprise_nom"] ?></span>
                    </div>

                    <?php if (count($tab[1]) > 0): ?>
                        <?php foreach ($tab[1] as $doc): ?>
                            <div class="document-item">
                                <span><?= basename($doc) ?></span>
                                <div>
                                    <form method="post">
                                        <button class="form-button" name="download" value=<?= $doc ?>>Télécharger</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-doc">Aucun document fourni</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-doc">Il n'y a aucun document</p>
            <?php endif;?>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
