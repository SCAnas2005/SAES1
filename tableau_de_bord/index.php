<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session(); // Démarrage ou récupération de la session PHP
 
    // Vérification que l'utilisateur est connecté
    // Si la variable de session "logged" n'existe pas ou vaut false,
    // on redirige vers la page d'accueil (ou page de connexion)
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: /");
    }

    if ($_SESSION["usertype"] == "student") // Chargement conditionnel du fichier PHP selon le type d'utilisateur connecté
    // Si c'est un étudiant, on inclut le fichier contenant la logique spécifique aux étudiants
    {
        require_once "php/student.php";
    }
    else if ($_SESSION["usertype"] == "tuteur") // Si c'est un tuteur, on inclut le fichier pour le tuteur
    {
        require_once "php/tuteur.php";
    }
?>

