<?php
    require "config/config.php";
    require DATABASE_FOLDER."/database.php";
    require "php/util.php";
    init_php_session(); // Initialise la session
    Database::init_database();
    $_SESSION["PATHS"] = ["ROOTPATH" => ROOTPATH, "AUTH_FOLDER" => AUTH_FOLDER, "CONFIG_FOLDER" => CONFIG_FOLDER, "DATABASE_FOLDER" => DATABASE_FOLDER];
    $_SESSION["usertype"] = "student";

    $user = Database::search_user("rudiger_marc");

    $user = Database::load_all_info($user["id"]);
    $_SESSION["user"] = $user; 


    header("Location: authentification/");
?>

