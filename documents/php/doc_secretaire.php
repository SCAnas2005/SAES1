<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    // require DATABASE_FOLDER."/database.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();
    // Database::init_database();


    function get_sec_status_from_student_status($statut)
    {
        $s = "";
        switch (strtolower($statut)) {
            case 'attente':
                $s = "Reçu";
            break;
            
            case 'valide':
                $s = "Validé";    
            break;

            case 'recu':
                $s = "Envoyé / En attente";
            break;

            case 'non-recu':
                $s = "Non envoyé";
            break;

            default:
                $s = "Non envoyé";
                break;
        }
        return $s;
    }

    function get_statut_classname_from_status($statut)
    {
        $s = "";
        switch (strtolower($statut)) {
            case 'attente':
                $s = "recu";
            break;
            case 'valide':
                $s = "valide";
            break;
            case 'recu':
                $s = "attente";
            break;
            case 'non-recu':
                $s = "non-envoye";
            break;
            default:
                $s = "non-envoye";
            break;
        }
        return $s;
    }


    function get_bordereau_filepath_from_student($id_student)
    {
        if (!is_user_dir($id_student))
        {
            make_user_dir($id_student);
        }
        
        $userdir = get_user_dirpath($id_student);
        $bordereau_dir = $userdir."/bordereau";
        if (!is_dir($bordereau_dir))
        {
            mkdir($bordereau_dir);
            return null;
        }

        $files = array_diff(scandir($bordereau_dir), ['.', '..']);

        if (count($files) === 1) {
            $file = array_values($files)[0]; // récupérer le nom du fichier
            $filepath = $bordereau_dir . '/' . $file;
            // echo "Chemin complet du fichier : " . $filepath;
        } else {
            // echo "Le dossier ne contient pas exactement un seul fichier.";
            return "";
        }

        return $filepath;
    }


    function get_convention_filepath_from_student($id_student)
    {
        $userdir = $_SERVER['DOCUMENT_ROOT'] . "/docs/$id_student";
        if (!is_dir($userdir))
        {
            mkdir($userdir);
        }

        $convention_dir = $userdir."/convention";
        if (!is_dir($convention_dir))
        {
            mkdir($convention_dir);
            return null;
        }

        $files = array_diff(scandir($convention_dir), ['.', '..']);

        if (count($files) === 1) {
            $file = array_values($files)[0]; // récupérer le nom du fichier
            $filepath = $convention_dir . '/' . $file;
            // echo "Chemin complet du fichier : " . $filepath;
        } else {
            // echo "Le dossier ne contient pas exactement un seul fichier.";
            return "";
        }

        return $filepath;
    }


    function send_bordereau_to_secretaire($file, $student_id)
    {
        $targetDir = DOCS_FOLDER."/". $student_id . "/bordereau";
        if (!is_dir($targetDir))
        {
            mkdir($targetDir);
        }
        // Récupérer le nom du fichier
        $targetFile = $targetDir . "/". basename($file["name"]);
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
        if ($file["size"] > 5000000) {
            echo "Désolé, votre fichier est trop volumineux.";
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est défini sur 0 en raison d'une erreur
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
            exit;
        // Si tout est ok, tenter de télécharger le fichier
        } else {
            foreach (scandir($targetDir) as $f) {
                if (is_file($targetDir."/".$f))
                {
                    unlink($targetDir."/".$f);
                }
            }
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                echo "Le fichier " . htmlspecialchars(basename($file["name"])) . " a été téléchargé.";
                return true;
            } else {
                echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
            }
        }
        return false;
    }

    function send_convention_to_secretaire($file, $student_id)
    {
        $targetDir = DOCS_FOLDER."/". $student_id . "/convention";
        if (!is_dir($targetDir))
        {
            mkdir($targetDir);
        }
        // Récupérer le nom du fichier
        $targetFile = $targetDir . "/". basename($file["name"]);
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
        if ($file["size"] > 5000000) {
            echo "Désolé, votre fichier est trop volumineux.";
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est défini sur 0 en raison d'une erreur
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
            exit;
        // Si tout est ok, tenter de télécharger le fichier
        } else {
            foreach (scandir($targetDir) as $f) {
                if (is_file($targetDir."/".$f))
                {
                    unlink($targetDir."/".$f);
                }
            }
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                echo "Le fichier " . htmlspecialchars(basename($file["name"])) . " a été téléchargé.";
                return true;
            } else {
                echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
            }
        }
        return false;
    }



    function download_file($filepath)
    {
        if (file_exists($filepath)) {
            // Forcer le téléchargement
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Vide le tampon de sortie
            readfile($filepath);
            exit;
        } else {
            echo "Fichier introuvable.";
        }
    }


    

?>