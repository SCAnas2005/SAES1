<?php 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    $targetDir = DOCS_FOLDER."/". $_SESSION["data"]["userinfo"]["id"];

    // Récupérer le nom du fichier
    $targetFile = $targetDir . "/". basename($_FILES["document_upload"]["name"]);
    // Initialiser une variable pour vérifier si le téléchargement est autorisé
    $uploadOk = 1;
    // Récupérer l'extension du fichier
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifier si le fichier est un PDF
    // if ($fileType != "pdf") {
    //     echo "Désolé, seuls les fichiers PDF sont autorisés.";
    //     $uploadOk = 0;
    // }

    // Vérifier si le fichier existe déjà
    if (file_exists($targetFile)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Limiter la taille du fichier à 5 Mo
    if ($_FILES["document_upload"]["size"] > 5000000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Vérifier si $uploadOk est défini sur 0 en raison d'une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    // Si tout est ok, tenter de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["document_upload"]["tmp_name"], $targetFile)) {
            // echo "Le fichier " . htmlspecialchars(basename($_FILES["document_upload"]["name"])) . " a été téléchargé.";
        } else {
            echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
        }
    }

    header("Location: ".L_DOCUMENTS_FOLDER);
?>