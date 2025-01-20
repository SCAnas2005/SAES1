<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        
        header("Location: ".L_LOGIN_FOLDER);
    }

    if ($_SESSION["usertype"] == "student")
    {
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur")
    {
        require_once "php/tuteur.php";
    }
    else{
        require_once "php/other.php";
    }

?>