<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    if (!is_logged() or $_SESSION["usertype"] != "secretaire" or !isset($_POST["id_ens"]))
    {
        header("Location: /");
    }

    $prof_id = $_POST["id_ens"];
    $sql = "SELECT 
            s.*,
            Entreprise.nom AS entreprise_nom,
            Entreprise.adresse AS entreprise_adresse,
            student.*

        FROM Stage s
        JOIN Enseignant e ON e.id = s.id_1
        JOIN Utilisateur u ON u.id = e.id
        JOIN Tuteur_entreprise te ON te.id = s.id_3
        JOIN Entreprise ON Entreprise.id_Entreprise = te.id_Entreprise
        JOIN Utilisateur student ON student.id = s.id
        WHERE e.id = $prof_id;
    ";
    $stages = Database::execute_sql_all($sql);
    // echo "<pre>";print_r($stages);exit;
    $n = count($stages);
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir mes Stages - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Les Stages</h2>
            <?php if ($n > 0): ?>
                <ul class="stage-list">
                    <?php foreach ($stages as $stage): ?>
                        <li class="stage-item">
                            <div>
                                <h3><?= $stage["titre"] ?></h3>
                                <span>
                                    Entreprise : <?= $stage["entreprise_nom"] ?> |
                                    <?= $stage["date_debut"] ?>
                                </span>
                            </div>
                            <div class="stage-actions">
                                <!-- <a href="<?= L_USERAREA_FOLDER . "/stage?id=" . $stage["id"] ?>">Voir Détails</a> -->

                                <form method="POST" action="<?= L_MES_STAGES_FOLDER . "/php/delete_stage.php" ?>" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?');">
                                    <input type="hidden" name="stage_id" value="<?= $stage["id_Stage"] ?>">
                                    <input type="hidden" name="student_id" value="<?= $stage["id"] ?>">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Vous n'avez actuellement pas de stage</p>
            <?php endif; ?>

        </section>
    </main>


    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
