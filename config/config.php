<?php 
    define("ROOTPATH", $_SERVER['DOCUMENT_ROOT']);
    define("AUTH_FOLDER", ROOTPATH."/Authentification");
    define("CONFIG_FOLDER", ROOTPATH."/config");
    define("DATABASE_FOLDER", ROOTPATH."/database");
    define ("DOCS_FOLDER", ROOTPATH."/docs");
    // define("USERAREA_FOLDER", ROOTPATH."espace_utilisateur");
    define("L_USERAREA_FOLDER", "/"."espace_utilisateur");
    define("L_DASHBOARD_FOLDER", "/"."tableau_de_bord");
    define("L_DOCUMENTS_FOLDER", "/"."documents");
    define("L_HOME_FOLDER", "/"."acceuil");
    define("L_ASSETS_FOLDER", "/"."assets");
    define("L_GLOBAL_CSS_FOLDER", "/"."css");
    define("L_MES_STAGES_FOLDER", "/"."mes_stages");
    define ("L_STAGE_FOLDER", "/"."espace_utilisateur/stage");
    define ("L_STAGE2_FOLDER", "/"."stage");
    define ("L_DEPARTMENTS_FOLDER", "/"."departements");
    define ("L_STUDENTS_FOLDER", "/"."mes_etudiants");
    define ("L_TEACHERS_FOLDER", "/"."enseignants");
    define ("L_NOTIFICATIONS_FOLDER", "/"."notifications");
    define ("L_LOGIN_FOLDER", "/"."authentification");
    define ("L_SIGNUP_FOLDER", "/"."inscription");
    
    

    $DBUSERNAME = "root";
    $DBPASSWORD = "";
    $DSN = "mysql:dbname=sae_gds;host=localhost"; 
?>