<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    require_once "doc_secretaire.php";

    if (isset($_SESSION["download_bordereau"]))
    {
        download_file($_SESSION["download_bordereau"]);
    }   

    if (isset($_SESSION["download_convention"]))
    {
        download_file($_SESSION["download_convention"]);
    }
?>
