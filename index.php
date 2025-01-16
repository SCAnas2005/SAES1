<?php
    require "config/config.php";
    require DATABASE_FOLDER."/database.php";
    require "php/util.php";

    init_php_session(); // Initialise la session
    $_SESSION["PATHS"] = ["ROOTPATH" => ROOTPATH, "AUTH_FOLDER" => AUTH_FOLDER, "CONFIG_FOLDER" => CONFIG_FOLDER, "DATABASE_FOLDER" => DATABASE_FOLDER];

    
?>

