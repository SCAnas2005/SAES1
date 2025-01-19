<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
    $file = $_SESSION["download_file"];
    if (file_exists($file)) {
        // Définir les en-têtes pour forcer le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        
        // Nettoyer le tampon de sortie
        ob_clean();
        flush();
        
        // Lire le fichier et l'envoyer
        readfile($file);
        
        // Terminer le script après l'envoi du fichier
        exit;
    } else {
        echo "Le fichier n'existe pas.";
    }
?>