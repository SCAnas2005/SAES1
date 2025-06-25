<?php 
    // Inclusion des fichiers de configuration et utilitaires
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";

    // Initialisation de la session PHP
    init_php_session();

    // Initialisation de la base de données (connexion, setup, etc.)
    Database::init_database();

    // Récupération des données utilisateur en session
    $user = $_SESSION["data"];

    // Récupération des listes de tuteurs entreprise et pédagogiques depuis la base
    $tuteurs = Database::get_all_tuteur_entreprise();
    $tuteurs_peda = Database::get_all_profs();

    // Si l'utilisateur a déjà un stage, redirection vers sa page "mes stages"
    if ($_SESSION["has_stage"])
    {
        header("Location: ".L_MES_STAGES_FOLDER);
    }

    // Si le formulaire a été soumis (champ entreprise rempli)
    if (isset($_POST["entreprise"]))
    {
        // Récupération des données du formulaire
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
        $departement = $_SESSION["data"]["my_departement"]["id_Departement"];

        $competences = $_POST["competences"];

        // Préparation d'un tableau associatif des infos du stage
        $infos = [
            "titre" => $stagename,
            "entreprise" => $entreprise_nom,
            "entreprise_adresse" => $entreprise_adresse,
            "entreprise_ville" => $entreprise_ville,
            "entreprise_codepostal" => $entreprise_codepostal,
            "entreprise_email" => $entreprise_email,
            "entreprise_tel" => $entreprise_tel,
            "date_debut" => $date_debut,
            "date_fin" => $date_fin,
            "salle_soutenance" => $salle_soutenance,
            "date_soutenance" => $date_soutenance,
            "tuteur_stage" => $tuteur_stage,
            "tuteur_pedagogique" => $tuteur_pedagogique,
            "description" => $description,
            "taches" => $taches,
            "jury2" => $jury2,
            "departement" => $departement,
            "competences" => $competences
        ];
        
        // Ajout du stage dans la base de données avec les infos et les données utilisateur
        Database::add_stage($user["userinfo"], $infos);

        // Redirection vers la page d'accueil après ajout
        header("Location: /");
    }

    // Récupération de toutes les compétences disponibles en base pour afficher en checkbox
    $competences = Database::execute_sql_all("SELECT * FROM Competence");
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Encodage UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive -->
    <title>Ajouter un Stage - Suivi des Stages</title>
    <!-- CSS global -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <!-- CSS spécifique -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Inclusion de l'en-tête -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main class="main-content">
        <section class="section">
            <h2>Nouveau Stage</h2>
            <form method="POST">
                <!-- Titre du stage -->
                <label for="titre">Titre du stage :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre du stage" required>

                <!-- Informations entreprise -->
                <label for="entreprise">Entreprise : </label>
                <input type="text" id="entreprise" name="entreprise" placeholder="Nom de l'entreprise" required>
                <input type="text" id="entreprise_adresse" name="entreprise_adresse" placeholder="Adresse de l'entreprise" required>
                <input type="text" id="entreprise_ville" name="entreprise_ville" placeholder="Ville de l'entreprise" required>
                <input type="number" id="entreprise_codepostal" name="entreprise_codepostal" placeholder="Code postal de l'entreprise" required>
                <input type="email" id="entreprise_email" name="entreprise_email" placeholder="Email de l'entreprise">
                <input type="tel" id="entreprise_tel" name="entreprise_tel" pattern="^(0|\+33|0033)[1-9](\s?\d{2}){4}$" placeholder="Téléphone de l'entreprise">

                <!-- Durée du stage -->
                <label for="duree">Durée :</label>
                <input type="date" id="date-debut" name="date-debut" required>
                <input type="date" id="date-fin" name="date-fin" required>
                
                <!-- Soutenance -->
                <label for="date-soutenance">Date de soutenance :</label>
                <input type="date" id="date-soutenance" name="date-soutenance" required>
                <input type="text" id="lieu" name="salle_soutenance" placeholder="Salle de la soutenance" required>
                
                <!-- Sélection tuteur de stage -->
                <label for="tuteur-stage">Tuteur de stage :</label>
                <select id="tuteur-stage" name="tuteur-stage">
                    <option value="" disabled selected hidden>Choisir un tuteur de stage</option>
                    <?php foreach ($tuteurs as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Sélection tuteur pédagogique -->
                <label for="tuteur-pedagogique">Tuteur pédagogique :</label>
                <select id="tuteur-pedagogique" name="tuteur-pedagogique">
                    <option value="" disabled selected hidden>Choisir un tuteur pédagogique</option>
                    <?php foreach ($tuteurs_peda as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Deuxième jury -->
                <label for="jury-2">Deuxième jury</label>
                <select id="jury-2" name="jury-2">
                    <option value="" disabled selected hidden>Choisir un membre du jury</option>
                    <?php foreach ($tuteurs_peda as $tuteur): ?>
                        <option value=<?= $tuteur["id"] ?>><?= $tuteur["prenom"]." ".$tuteur["nom"] ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Description du stage -->
                <label for="description">Description :</label>
                <textarea id="description" name="description" placeholder="Décrivez les objectifs du stage" rows="5" required></textarea>

                <!-- Tâches effectuées -->
                <label for="taches">Tâches effectuées :</label>
                <textarea id="taches" name="taches" placeholder="Listez les tâches principales" rows="5" required></textarea>
                
                <!-- Compétences associées -->
                <label for="competences">Compétences associées au stage :</label>
                <div class="checkbox-group">
                    <?php foreach ($competences as $comp): ?>
                        <div class="checkbox-item">
                            <input type="checkbox" id="comp-<?= $comp["id_Competence"] ?>" name="competences[]" value="<?= $comp["id_Competence"] ?>">
                            <label for="comp-<?= $comp["id_Competence"] ?>"><?= htmlspecialchars($comp["titre"]) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" name="submit_form">Ajouter le Stage</button>

            </form>
        </section>
    </main>

    <!-- Inclusion du footer -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
