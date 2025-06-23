<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    require_once "doc_secretaire.php";

    if (!is_logged())
    {
        header("Location: /");
        exit;
    }
    
    if (isset($_SESSION["download_bordereau"]))
    {
        download_file($_SESSION["download_bordereau"]);
        unset($_SESSION["download_bordereau"]);
        exit;
    } 
    if (isset($_SESSION["download_convention"]))
    {
        download_file($_SESSION["download_convention"]);
        unset($_SESSION["download_convention"]);
        exit;
    }
?>
