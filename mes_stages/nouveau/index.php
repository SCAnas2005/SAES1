<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    $user = $_SESSION["data"];
    $tuteurs = Database::get_all_tuteur_entreprise();
    $tuteurs_peda = Database::get_all_profs();

    if (isset($_POST["entreprise"]))
    {
        $stagename = $_POST["titre"];
        $entreprise_nom = $_POST["entreprise"];
        $entreprise_adresse = $_POST["entreprise_adresse"];
        $entreprise_ville = $_POST["entreprise_ville"];
        $entreprise_codepostal = $_POST["entreprise_codepostal"];
        $entreprise_email = $_POST["entreprise_email"];
        $entreprise_tel = $_POST["entreprise_tel"];


        $date_debut = $_POST["date-debut"];
        $date_fin = $_POST["date-fin"];

        $salle_soutenance = $_POST["salle_soutenance"];
        $date_soutenance = $_POST["date-soutenance"];

        $tuteur_stage = $_POST["tuteur-stage"];
        $tuteur_pedagogique = $_POST["tuteur-pedagogique"];
        $jury2 = $_POST["jury-2"];

        $description = $_POST["description"];
        $taches = $_POST["taches"];


        $infos = ["titre"=>$stagename, "entreprise"=>$entreprise_nom, "entreprise_adresse"=>$entreprise_adresse, "entreprise_ville"=>$entreprise_ville, "entreprise_codepostal"=>$entreprise_codepostal, "entreprise_email"=>$entreprise_email,
            "entreprise_tel"=>$entreprise_tel, "date_debut"=>$date_debut, "date_fin"=>$date_fin, "salle_soutenance"=>$salle_soutenance, "date_soutenance"=>$date_soutenance, "tuteur_stage"=>$tuteur_stage, "tuteur_pedagogique"=>$tuteur_pedagogique,
            "description"=>$description, "taches"=>$taches, "jury2"=>$jury2
        ];
        
        Database::add_stage($user["userinfo"], $infos);
        header("Location: /");
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Stage - Suivi des Stages</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Nouveau Stage</h2>
            <form method="POST">
                <label for="titre">Titre du stage :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre du stage" required>

                <label for="entreprise">Entreprise : </label>
                <input type="text" id="entreprise" name="entreprise" placeholder="Nom de l'entreprise" required>
                <input type="text" id="entreprise_adresse" name="entreprise_adresse" placeholder="Adresse de l'entreprise" required>
                <input type="text" id="entreprise_ville" name="entreprise_ville" placeholder="Ville de l'entreprise" required>
                <input type="number" id="entreprise_codepostal" name="entreprise_codepostal" placeholder="Code postal de l'entreprise" required>
                <input type="email" id="entreprise_email" name="entreprise_email" placeholder="Email de l'entreprise">
                <input type="tel" id="entreprise_tel" name="entreprise_tel" pattern="^(0|\+33|0033)[1-9](\s?\d{2}){4}$" placeholder="Téléphone de l'entreprise">
                

                <label for="duree">Durée :</label>
                <input type="date" id="date-debut" name="date-debut" required>
                <input type="date" id="date-fin" name="date-fin" required>
                <!-- <input type="text" id="duree" name="duree" placeholder="Ex : 1er Juin 2024 - 30 Août 2024" required> -->

                
                <label for="date-soutenance">Date de soutenance :</label>
                <input type="date" id="date-soutenance" name="date-soutenance" required>
                <input type="text" id="lieu" name="salle_soutenance" placeholder="Salle de la soutenance" required>
                
                <label for="tuteur-stage">Tuteur de stage :</label>
                <select id="tuteur-stage" name="tuteur-stage">
                    <option value="" disabled selected hidden>Choisir un tuteur de stage</option>
                    <?php foreach ($tuteurs as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="text" id="tuteur-stage" name="tuteur-stage" placeholder="Nom du tuteur de stage" required> -->

                <label for="tuteur-pedagogique">Tuteur pédagogique :</label>
                <select id="tuteur-pedagogique" name="tuteur-pedagogique">
                    <option value="" disabled selected hidden>Choisir un tuteur de stage</option>
                    <?php foreach ($tuteurs_peda as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="jury-2">Deuxième jury</label>
                <select id="jury-2" name="jury-2">
                    <option value="" disabled selected hidden>Choisir un tuteur de stage</option>
                    <?php foreach ($tuteurs_peda as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="text" id="tuteur-pedagogique" name="tuteur-pedagogique" placeholder="Nom du tuteur pédagogique" required> -->

                <label for="description">Description :</label>
                <textarea id="description" name="description" placeholder="Décrivez les objectifs du stage" rows="5" required></textarea>

                <label for="taches">Tâches effectuées :</label>
                <textarea id="taches" name="taches" placeholder="Listez les tâches principales" rows="5" required></textarea>

                <button type="submit" name="submit_form">Ajouter le Stage</button>
            </form>
        </section>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
