<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

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
    }
?>

