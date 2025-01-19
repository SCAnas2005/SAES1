<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    // require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
    $user_docs = get_user_docs($_SESSION["data"]["userinfo"]["id"]);
    $_SESSION["user_docs"] = $user_docs;
?>