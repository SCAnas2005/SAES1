<?php 
    // Inclusion des fichiers de configuration et des fonctions nécessaires
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php"; 
    // Inclut le fichier config.php situé dans le dossier /config à la racine du serveur
    // Ce fichier contient probablement les constantes de configuration, comme ROOTPATH, DATABASE_FOLDER, etc.

    require DATABASE_FOLDER."/database.php"; 
    // Inclut le fichier database.php dans le dossier défini par la constante DATABASE_FOLDER
    // Ce fichier contient probablement les fonctions de gestion de la base de données (connexion, requêtes...)

    require ROOTPATH."/php/util.php"; 
    // Inclut le fichier util.php qui se trouve dans le dossier /php à la racine du projet
    // Ce fichier contient des fonctions utilitaires, ici notamment celles pour la gestion des sessions

    init_php_session(); 
    // Appelle une fonction définie dans util.php (ou ailleurs) qui initialise une session PHP
    // Cela démarre ou restaure une session utilisateur

    close_php_session(); 
    // Appelle une fonction qui ferme ou détruit la session PHP
    // Par exemple, elle peut supprimer les données de session et appeler session_destroy()

    header("Location: /"); 
    // Envoie un en-tête HTTP de redirection vers la racine du site (page d'accueil)
    // Important : aucune sortie ne doit être envoyée avant cet appel header()
?>
