<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    init_php_session();  // Démarrage ou reprise de la session PHP
    Database::init_database();

    include_once "doc_secretaire.php";

    if (!is_logged()) // Vérification que l'utilisateur est connecté
    {
        header("Location: /");
    }
    
    if ($_SESSION["usertype"] == "student")  // Si l'utilisateur connecté est un étudiant
    {
        $ret = send_convention_to_secretaire($_FILES["convention"], $_SESSION["data"]["userinfo"]["id"]);
        if ($ret)  // Si l'envoi a réussi
        {
            Database::add_stage_document($_SESSION["data"]["userinfo"]["id"], $_SESSION["data"]["stages"][0]["infostage"]["id_Stage"], "convention", "", "attente", "");
        }
        header("Location: ".L_DOCUMENTS_FOLDER);
    }
    else if ($_SESSION["usertype"] == "secretaire")  // Sinon, si l'utilisateur connecté est un secrétaire
    {
        $id_student = $_POST["id_student"];
        $id_stage = $_POST["id_stage"];
        $ret = send_convention_to_secretaire($_FILES["convention"], $id_student);
        if ($ret)   // Si l'envoi a réussi
        {   // Ajout en base d'une entrée pour ce document "convention" avec statut "recu"
            // Cela signifie que le secrétariat a bien reçu et validé ce document
            Database::add_stage_document($id_student, $id_stage, "convention", "", "recu", "");
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);//retour sur l'url précédente
    }

?>
