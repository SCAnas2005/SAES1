<?php
    // Inclusion des fichiers de configuration, utilitaires et base de données
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";  // Configuration globale
    require_once ROOTPATH."/php/util.php";                          // Fonctions utilitaires, session, etc.
    require_once DATABASE_FOLDER."/database.php";                   // Classe et fonctions d'accès à la base de données

    // Initialisation de la session PHP personnalisée
    init_php_session();

    // Initialisation de la connexion à la base de données
    Database::init_database();

    // Vérification que la requête est de type POST et que les paramètres nécessaires sont présents
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["stage_id"]) && isset($_POST["student_id"])) {

        // Récupération et conversion en entier des identifiants envoyés via le formulaire
        $stage_id = intval($_POST["stage_id"]);
        $student_id = intval($_POST["student_id"]);

        // Appel à la méthode statique pour supprimer le stage dans la base de données
        Database::delete_stage($student_id, $stage_id);

        // Redirection vers la page d'accueil après suppression réussie
        header("Location: /");
        exit; // Arrêt du script après redirection

    } else {
        // Si la requête n'est pas conforme (pas POST ou paramètres manquants), redirection vers la liste des stages
        header("Location: " . L_MES_STAGES_FOLDER);
        exit; // Arrêt du script après redirection
    }
?>
