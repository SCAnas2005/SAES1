<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require DATABASE_FOLDER."/database.php";
    require ROOTPATH."/php/util.php";

    init_php_session();

    close_php_session();
    header("Location: /");
?>