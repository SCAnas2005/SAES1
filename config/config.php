<?php 
    define("ROOTPATH", $_SERVER['DOCUMENT_ROOT']);
    define("AUTH_FOLDER", ROOTPATH."/Authentification");
    define("CONFIG_FOLDER", ROOTPATH."/config");
    define("DATABASE_FOLDER", ROOTPATH."/database");
    // define("USERAREA_FOLDER", ROOTPATH."espace_utilisateur");
    define("L_USERAREA_FOLDER", "/"."espace_utilisateur");
    define("L_DASHBOARD_FOLDER", "/"."tableau_de_bord");
    define("L_DOCUMENTS_FOLDER", "/"."documents");
    define("L_HOME_FOLDER", "/"."acceuil");
    define("L_ASSETS_FOLDER", "/"."assets");
    define("L_GLOBAL_CSS_FOLDER", "/"."css");


    $DBUSERNAME = "root";
    $DBPASSWORD = "";
    $DSN = "mysql:database=sae_gds;host=localhost"; 
?>