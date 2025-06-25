<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    // Initialisation de la session
    init_php_session();
// Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        
        header("Location: ".L_LOGIN_FOLDER);
    }
    // Si c'est un étudiant
    if ($_SESSION["usertype"] == "student")
    {
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")  // Si c'est un tuteur
    {
        require_once "php/tuteur.php";
    } else if ($_SESSION["usertype"] == "secretaire") { // Si c'est une secrétaire
        require_once "php/secretaire.php";
    }
    else{
        require_once "php/other.php"; // Si c'est un autre type d'utilisateur 
    }

?>