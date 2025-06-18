<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false or $_SESSION["usertype"] != "student")
    {
        header("Location: /");
    }

    $data = $_SESSION["data"];
    $stages = $data["stages"];
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
            <h2>Mes Stages</h2>
            <?php if ($n > 0): ?>
                <ul class="stage-list">
                    <?php foreach ($stages as $stage): ?>
                        <li class="stage-item">
                            <div>
                                <h3><?= $stage["infostage"]["titre"] ?></h3>
                                <span>
                                    Entreprise : <?= $stage["entreprise"]["entreprise_nom"] ?> |
                                    <?= $stage["infostage"]["date_debut"] ?>
                                </span>
                            </div>
                            <div class="stage-actions">
                                <a href="<?= L_USERAREA_FOLDER . "/stage?id=" . $stage["infostage"]["id"] ?>">Voir Détails</a>

                                <form method="POST" action="<?= L_MES_STAGES_FOLDER . "/php/delete_stage.php" ?>" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?');">
                                    <input type="hidden" name="stage_id" value="<?= $stage["infostage"]["id_Stage"] ?>">
                                    <input type="hidden" name="student_id" value="<?= $stage["student"]["id"] ?>">
                                    <button type="submit" class="delete-button" title="Supprimer le stage">🗑️</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Vous n'avez actuellement pas de stage</p>
            <?php endif; ?>

            <a href="<?= L_MES_STAGES_FOLDER . "/nouveau" ?>" class="add-button">Ajouter un stage</a>
        </section>
    </main>


    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
