
<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
    $filetoremove = $_SESSION["remove_file"];
    if (file_exists($filetoremove))
    {
        unlink($filetoremove);
        header("Location: ". L_DOCUMENTS_FOLDER );
    }
?>
