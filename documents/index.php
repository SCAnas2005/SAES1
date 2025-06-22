<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    if (!isset($_SESSION["logged"]))
    {
        header("Location: /");
    }

    if ($_SESSION["usertype"] == "student")
    {
        include "php/doc_managment.php";
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")
    {
        require_once "php/tuteur.php";
    } else if ($_SESSION["usertype"] == "secretaire") {
        require_once "php/secretaire.php";
    }
?>

