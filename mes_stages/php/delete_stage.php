<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();


    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["stage_id"]) && isset($_POST["student_id"])) {
        $stage_id = intval($_POST["stage_id"]);
        $student_id = intval($_POST["student_id"]);

        // echo "stage id: $stage_id, student id: $student_id";exit;

        Database::delete_stage($student_id, $stage_id);

        // echo "delete_stage executed";exit;
        // Redirection après suppression
        header("Location: /");
        exit;
    } else {
        // Redirection si l'accès est non autorisé
        header("Location: " . L_MES_STAGES_FOLDER);
        exit;
}
