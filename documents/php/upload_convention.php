<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    include_once "doc_secretaire.php";

    if (!is_logged())
    {
        header("Location: /");
    }
    
    if ($_SESSION["usertype"] == "student")
    {
        $ret = send_convention_to_secretaire($_FILES["convention"], $_SESSION["data"]["userinfo"]["id"]);
        if ($ret)
        {
            Database::add_stage_document($_SESSION["data"]["userinfo"]["id"], $_SESSION["data"]["stages"][0]["infostage"]["id_Stage"], "convention", "", "attente", "");
        }
        header("Location: ".L_DOCUMENTS_FOLDER);
    }
    else if ($_SESSION["usertype"] == "secretaire")
    {
        $id_student = $_POST["id_student"];
        $id_stage = $_POST["id_stage"];
        $ret = send_convention_to_secretaire($_FILES["convention"], $id_student);
        if ($ret)
        {
            Database::add_stage_document($id_student, $id_stage, "convention", "", "recu", "");
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);//retour sur l'url précédente
    }

?>