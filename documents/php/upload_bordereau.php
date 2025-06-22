<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    include_once "doc_secretaire.php";
    
    if ($_SESSION["usertype"] == "student")
    {
        $ret = send_bordereau_to_secretaire($_FILES["bordereau"], $_SESSION["data"]["userinfo"]["id"]);
        if ($ret)
        {
            Database::add_stage_document($_SESSION["data"]["userinfo"]["id"], $_SESSION["data"]["stages"][0]["infostage"]["id_Stage"], "bordereau", "", "attente", "");
        }
    }

    header("Location: ".L_DOCUMENTS_FOLDER);
?>