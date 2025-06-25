<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    require_once "doc_secretaire.php";

    if (!is_logged())  // Vérifie si l'utilisateur est connecté
    {
        header("Location: /");
        exit;
    }
    
    if (isset($_SESSION["download_bordereau"]))  // Vérifie si une demande de téléchargement du bordereau est présente en session
    {
        download_file($_SESSION["download_bordereau"]); // Lance le téléchargement du fichier dont le chemin est stocké en session
        unset($_SESSION["download_bordereau"]);
        exit;
    } 
    if (isset($_SESSION["download_convention"])) // Vérifie si une demande de téléchargement de la convention est présente en session
    {
        download_file($_SESSION["download_convention"]);  // Lance le téléchargement du fichier dont le chemin est stocké en session
        unset($_SESSION["download_convention"]);
        exit;
    }
?>
