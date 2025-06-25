<?php 
    // Inclusion des fichiers de configuration, utilitaires et base de données
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";

    // Initialisation de la session PHP (gestion des sessions utilisateur)
    init_php_session();

    // Initialisation de la connexion à la base de données via la classe Database
    Database::init_database();

    // Récupération des données stockées en session (ex : données utilisateur, stages, etc.)
    $data = $_SESSION["data"];

    // Contrôle du type d'utilisateur connecté (stocké en session dans "usertype")
    if ($_SESSION["usertype"] == "student")
    {
        // Si l'utilisateur est un étudiant, inclusion du script spécifique aux étudiants
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")
    {
        // Si l'utilisateur est un tuteur, inclusion du script spécifique aux tuteurs
        require_once "php/tuteur.php";
    }
    else
    {
        // Sinon, inclusion d'un script générique pour les autres types d'utilisateur
        require_once "php/other.php";
    }
?>
<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();
    $data = $_SESSION["data"];

    if ($_SESSION["usertype"] == "student")
    {
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")
    {
        require_once "php/tuteur.php";
    }
    else
    {
        require_once "php/other.php";
    }
?>
