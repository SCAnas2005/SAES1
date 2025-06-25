<?php 
    // Inclusion des fichiers de configuration et fonctions utilitaires
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";  // Configuration globale du site
    require_once ROOTPATH."/php/util.php";                          // Fonctions utilitaires (dont init_php_session)
    require_once DATABASE_FOLDER."/database.php";                   // Accès à la base de données

    // Initialisation de la session PHP personnalisée
    init_php_session();

    // Vérification des droits d'accès :
    // On s'assure que l'utilisateur est connecté (logged = true) et qu'il est de type 'student'
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false or $_SESSION["usertype"] != "student")
    {
        // Si ce n'est pas le cas, on le redirige vers la page d'accueil
        header("Location: /");
    }

    // Récupération des données utilisateur depuis la session, notamment la liste des stages
    $data = $_SESSION["data"];
    $stages = $data["stages"];  // Tableau contenant les stages de l'étudiant
    $n = count($stages);        // Nombre de stages à afficher
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir mes Stages - Suivi des Stages</title>
    <!-- Inclusion des fichiers CSS globaux et spécifiques à cette page -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php 
    // Inclusion du header commun à toutes les pages
    require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";
?>

    <main class="main-content">
        <section class="section">
            <h2>Mes Stages</h2>

            <!-- Vérification s'il y a au moins un stage -->
            <?php if ($n > 0): ?>
                <ul class="stage-list">
                    <!-- Boucle d'affichage des stages -->
                    <?php foreach ($stages as $stage): ?>
                        <li class="stage-item">
                            <div>
                                <!-- Affichage du titre du stage -->
                                <h3><?= $stage["infostage"]["titre"] ?></h3>
                                <!-- Affichage du nom de l'entreprise et date de début du stage -->
                                <span>
                                    Entreprise : <?= $stage["entreprise"]["entreprise_nom"] ?> |
                                    <?= $stage["infostage"]["date_debut"] ?>
                                </span>
                            </div>

                            <div class="stage-actions">
                                <!-- Lien vers la page détaillée du stage avec l'ID passé en paramètre -->
                                <a href="<?= L_USERAREA_FOLDER . "/stage?id=" . $stage["infostage"]["id_Stage"] ?>">Voir Détails</a>

                                <!-- Formulaire pour supprimer un stage -->
                                <form method="POST" action="<?= L_MES_STAGES_FOLDER . "/php/delete_stage.php" ?>" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?');">
                                    <!-- Passage de l'ID du stage et de l'étudiant en champs cachés -->
                                    <input type="hidden" name="stage_id" value="<?= $stage["infostage"]["id_Stage"] ?>">
                                    <input type="hidden" name="student_id" value="<?= $stage["student"]["id"] ?>">
                                    <!-- Bouton de suppression avec icône corbeille -->
                                    <button type="submit" class="delete-button" title="Supprimer le stage">🗑️</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <!-- Message affiché si l'étudiant n'a aucun stage enregistré -->
                <p>Vous n'avez actuellement pas de stage</p>
            <?php endif; ?>

            <!-- Lien pour ajouter un nouveau stage -->
            <a href="<?= L_MES_STAGES_FOLDER . "/nouveau" ?>" class="add-button">Ajouter un stage</a>
        </section>
    </main>

    <?php 
    // Inclusion du footer commun à toutes les pages
    require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";
    ?>
</body>
</html>
