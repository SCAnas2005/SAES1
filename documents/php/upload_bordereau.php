<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    init_php_session();  // Démarre ou reprend la session PHP
    Database::init_database();

    include_once "doc_secretaire.php";

    if (!is_logged())  // Vérification que l'utilisateur est connecté
    {
        header("Location: /");
    }
    
    if ($_SESSION["usertype"] == "student") // Si l'utilisateur connecté est un étudiant
    {
        $ret = send_bordereau_to_secretaire($_FILES["bordereau"], $_SESSION["data"]["userinfo"]["id"]);
        if ($ret) // Si l'envoi a réussi
        {
              // On ajoute en base une nouvelle entrée pour ce document "bordereau" lié au stage de l'étudiant
            // Le statut initial est "attente" (document reçu mais pas encore validé)
            Database::add_stage_document($_SESSION["data"]["userinfo"]["id"], $_SESSION["data"]["stages"][0]["infostage"]["id_Stage"], "bordereau", "", "attente", "");
        }
        header("Location: ".L_DOCUMENTS_FOLDER);
    }
    else if ($_SESSION["usertype"] == "secretaire")
    {
        $id_student = $_POST["id_student"];
        $id_stage = $_POST["id_stage"];
        $ret = send_bordereau_to_secretaire($_FILES["bordereau"], $id_student);
        if ($ret)
        {
            Database::add_stage_document($id_student, $id_stage, "bordereau", "", "recu", "");
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);//retour sur l'url précédente
    }

?>
