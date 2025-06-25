<?php 
/**
 * inscription.php
 * 
 * Gère le processus d'inscription des utilisateurs à la plateforme de suivi des stages.
 * L'utilisateur choisit un rôle (étudiant, enseignant, tuteur entreprise), 
 * remplit un formulaire personnalisé, puis les données sont validées et enregistrées.
 * 
 * Dépendances :
 * - config.php : constantes globales (chemins, configurations)
 * - util.php : fonctions utilitaires (ex. : gestion des sessions)
 * - database.php : classe Database pour les opérations SQL
 */

// Inclusion des fichiers de configuration et utilitaires nécessaires
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php"; // Chargement des constantes globales
require_once ROOTPATH."/php/util.php";                         // Chargement des utilitaires (ex : session)
require_once DATABASE_FOLDER."/database.php";                  // Chargement des fonctions de base de données

// Initialisation de la session PHP pour gérer les utilisateurs connectés
init_php_session();

// Initialisation de la connexion à la base de données via la classe Database
Database::init_database();

// Récupération de toutes les entreprises depuis la base pour alimenter le formulaire
$entreprises = Database::get_all_entreprises();

// Récupération de tous les départements depuis la base pour alimenter le formulaire
$departements = Database::get_all_departements();

// Variables d’état utilisées pour contrôler le flux et afficher les erreurs/messages
$role = "";             // Rôle choisi par l’utilisateur (ex : student, prof, tuteur_entreprise)
$used_login = null;     // Message d’erreur si le login est déjà pris
$inscription_reussi = false; // Booléen indiquant si l’inscription a réussi

// Traitement du formulaire soumis (méthode POST avec champs login, password, role)
if (isset($_POST["login"], $_POST["password"], $_POST["role"]))
{
    // Récupération des données communes à tous les rôles
    $login = $_POST["login"];       // Nom d’utilisateur choisi
    $password = $_POST["password"]; // Mot de passe choisi
    $nom = $_POST["nom"];           // Nom de famille
    $prenom = $_POST["prenom"];     // Prénom
    $email = $_POST["email"];       // Adresse email
    $tel = $_POST["tel"];           // Numéro de téléphone
    $role = $_POST["role"];         // Rôle sélectionné dans le formulaire

    // Tableau associatif regroupant les informations utilisateurs
    $infos = [
        "login" => $login,
        "password" => $password,
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "tel" => $tel
    ];

    // Champs additionnels spécifiques selon le rôle sélectionné
    if ($role == "tuteur_entreprise")
    {
        // Pour le tuteur entreprise, on récupère l’entreprise choisie
        $choix_entreprise = $_POST["choix_entreprise"];
        $infos["choix_entreprise"] = $choix_entreprise;
    }
    if ($role == "prof" or $role == "student")
    {
        // Pour les professeurs et étudiants, on récupère le département choisi
        $choix_departement = $_POST["choix_departement"];
        $infos["choix_departement"] = $choix_departement;
    }
    if ($role == "prof" || $role == "tuteur_pedagogique")
    {
        // Pour les professeurs et tuteurs pédagogiques, on récupère le bureau
        $bureau = $_POST["bureau"];
        $infos["bureau"] = $bureau;
    }

    // Vérification que le login choisi n'existe pas déjà en base de données
    $user = Database::search_user($login);
    if ($user)
    {
        // Si le login est déjà pris, on prépare un message d’erreur à afficher
        $used_login = "Ce login est déjà utilisé";
    }
    else
    {
        // Si le login est libre, on crée le nouvel utilisateur dans la base avec son rôle
        Database::add_user($infos, $role);

        // Indique que l’inscription a réussi (utile si on souhaite afficher un message)
        $inscription_reussi = true;

        // Redirection vers la page de connexion pour se connecter immédiatement
        header("Location: ".L_LOGIN_FOLDER);
        exit; // On quitte le script après la redirection pour éviter toute exécution supplémentaire
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Chargement de la feuille de style globale -->
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <!-- Chargement de la feuille de style spécifique à la page inscription -->
    <link href="css/inscription.css" rel="stylesheet">
</head>

<body>
    <header>
        <!-- Titre principal de la page -->
        <h1>Suivi des Stages</h1>
        <!-- Logo IUT affiché dans l'en-tête -->
        <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo">
    </header>

    <div class="containerinscription">
        <!-- Affichage conditionnel du formulaire selon succès de l'inscription -->
        <?php if (!$inscription_reussi): ?>
            <!-- Formulaire d'inscription en méthode POST -->
            <form method="post">

                <!-- Sélection du rôle utilisateur : affichée uniquement si pas d'erreur de login -->
                <div id="role-selection" <?= ($used_login != null) ? "class='hidden'" : ""  ?>>
                    <h1>Bienvenue, inscrivez-vous pour commencer</h1>
                    <p>Choisissez votre rôle pour continuer :</p>

                    <!-- Boutons pour sélectionner le rôle (bouton simple déclenchant JS) -->
                    <button name="student" class="bouton-student" type="button" onclick="connexion('student')">Étudiant</button>
                    <button name="prof" class="bouton-teacher" type="button" onclick="connexion('prof')">Enseignant</button>
                    <!-- <button name="chef_dep" class="bouton-chef" type="button" onclick="connexion('chef_dep')">Chef de Département</button> -->
                    <button name="tuteur_entreprise" class="bouton-tuteurent" type="button" onclick="connexion('tuteur_entreprise')">Tuteur entreprise</button>
                    <!-- <button name="tuteur_pedagogique" class="bouton-tuteurpeda" type="button" onclick="connexion('tuteur_pedagogique')">Tuteur pédagogique</button> -->

                    <!-- Lien vers la page de connexion en cas de compte déjà existant -->
                    <p><a href=<?= L_LOGIN_FOLDER ?>>Se connecter</a></p> 
                </div>

                <!-- Formulaire détaillé pour inscription, caché au départ ou si erreur login -->
                <div id="student-login" <?= ($used_login == null) ? "class='hidden'" : ""  ?>>
                    <h2>Inscription</h2>

                    <!-- Champs personnels communs à tous -->
                    <input name="nom" type="text" placeholder="Nom" required>
                    <input name="prenom" type="text" placeholder="Prénom" required>
                    <input name="email" type="email" placeholder="e-mail" required>
                    <input name="tel" type="text" placeholder="Téléphone" required>

                    <!-- Champ bureau (visible uniquement pour certains rôles) -->
                    <input id="bureau" name="bureau" type="text" placeholder="Bureau" class="hidden" required>

                    <!-- Champs login et mot de passe -->
                    <input name="login" type="text" placeholder="login" required>
                    <input name="password" type="password" placeholder="Mot de passe" required>

                    <!-- Liste déroulante des entreprises (visible seulement pour tuteur entreprise) -->
                    <select id="choix_entreprise" name="choix_entreprise" class="hidden" required>
                        <option value="" disabled selected>Veuillez choisir une entreprise</option>
                        <?php foreach($entreprises as $entreprise): ?>
                            <option value=<?= $entreprise["id_Entreprise"] ?>><?= $entreprise["nom"] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Liste déroulante des départements (visible pour prof, étudiant, tuteur pédagogique) -->
                    <select id="choix_departement" name="choix_departement" class="hidden" required>
                        <option value="" disabled selected>Veuillez choisir un département</option>
                        <?php foreach($departements as $departement): ?>
                            <option value=<?= $departement["id_Departement"] ?>><?= $departement["libelle"] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Champ caché contenant le rôle sélectionné, envoyé avec le formulaire -->
                    <input type="hidden" id="role" name="role" value='<?= $role ?>'>

                    <!-- Affichage d'un message d'erreur si le login est déjà utilisé -->
                    <?= ($used_login != null) ? "<p>$used_login</p>" : "" ?>

                    <!-- Bouton pour soumettre le formulaire -->
                    <button type="submit" class="submit-bouton">S'inscrire</button>

                    <!-- Bouton retour permettant de revenir à la sélection de rôle -->
                    <button type="button" class="bouton-return" onclick="retour()">Retour</button>
                </div>
            </form>
        <?php else: ?>
            <!-- Message affiché en cas d'inscription réussie -->
            <h1>Inscription réussie !</h1>
            <p><a href=<?= L_LOGIN_FOLDER ?>>Se connecter</a></p> 
        <?php endif; ?>
    </div>

    <!-- Inclusion du footer standard -->
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>

    <!-- Script JavaScript pour gérer l'affichage dynamique des formulaires selon le rôle choisi -->
    <script>
        /**
         * Affiche le formulaire adapté au rôle sélectionné.
         * Masque la sélection de rôle et affiche le formulaire d'inscription.
         * Active/désactive les champs spécifiques (entreprise, département, bureau) selon le rôle.
         */
        function connexion(role) {
            event.preventDefault();

            // Masque la sélection de rôle
            document.getElementById('role-selection').classList.add('hidden');

            // Affiche le formulaire d'inscription
            document.getElementById('student-login').classList.remove('hidden');

            // Définit la valeur du champ caché "role"
            document.getElementById('role').value = role;

            // Gestion du champ entreprise : visible seulement pour tuteur entreprise
            if (role == "tuteur_entreprise")
            {
                var a = document.getElementById('choix_entreprise');
                a.classList.remove('hidden');
                a.required = true;
            }
            else{
                var a = document.getElementById('choix_entreprise');
                a.classList.add('hidden');
                a.required = false;
            }

            // Gestion du champ département : visible pour prof, student, tuteur pédagogique
            if (role == "prof" || role == "student" || role == "tuteur_pedagogique")
            {
                var a = document.getElementById('choix_departement');
                a.classList.remove('hidden');
                a.required = true;
            }
            else{
               var a =  document.getElementById('choix_departement');
               a.classList.add('hidden');
               a.required = false;
            }

            // Gestion du champ bureau : visible uniquement pour prof
            if (role == "prof")
            {
                var a = document.getElementById('bureau');
                a.classList.remove('hidden');
                a.required = true;
            }
            else{
                var a = document.getElementById('bureau');
                a.classList.add('hidden');
                a.required = false;
            }
        }

        /**
         * Retourne à la sélection du rôle utilisateur
         * Masque le formulaire d'inscription et réaffiche la sélection des rôles
         */
        function retour() {
            document.getElementById('role-selection').classList.remove('hidden');
            document.getElementById('student-login').classList.add('hidden');
        }
    </script>

    <!-- Script pour empêcher la soumission multiple du formulaire par rechargement de page -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</body>
</html>
