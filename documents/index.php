<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    if (!isset($_SESSION["logged"])) // Vérifie si l'utilisateur est connecté (la variable de session "logged" est définie)
    {
        header("Location: /");  // Sinon, redirige vers la page d'accueil (ou page de login)
    }

    if ($_SESSION["usertype"] == "student")  // Selon le type d'utilisateur stocké en session, on inclut les fichiers correspondants
    {
        include "php/doc_managment.php";  // Inclusion de la gestion des documents (upload, download, etc.)
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")
    {
        require_once "php/tuteur.php";
    } else if ($_SESSION["usertype"] == "secretaire") {
        require_once "php/secretaire.php";
    }
?>

