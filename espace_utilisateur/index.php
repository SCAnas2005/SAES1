<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false) // Vérification que l'utilisateur est bien connecté (variable de session 'logged' à true)
    {
        header("Location: /");
    }

    $data = $_SESSION["data"];  // Récupération des données stockées en session, notamment infos utilisateur, stages, etc.

    if ($_SESSION["usertype"] == "student") // Si c'est un étudiant, on inclut les fonctionnalités spécifiques aux étudiants
    {
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur") // Si c'est un tuteur (encadrant), on inclut le script dédié aux tuteurs
    {
        require_once "php/tuteur.php";
    }
    else
    {
        require_once "php/other.php";
    }
?>
