<?php
    function init_php_session() : bool
    {
        if (!session_id())
        {
            session_start();
            session_regenerate_id();
            return true;
        }   
        return false;
    }

    function close_php_session() 
    {
        session_unset();
        session_destroy();
    }


    function is_logged()
    {
        return isset($_SESSION["logged"]);
    }

    function is_admin()
    {
        return (is_logged() && $_SESSION["admin"]);
    }


    function check_passwords($p1, $p2)
    {
        return ($p1 == $p2);
    }

    function get_user_docs($userid) 
    {   
        $userdir = $_SERVER['DOCUMENT_ROOT'] . "/docs/$userid";
        if (!is_dir($userdir))
        {
            mkdir($userdir);
        }

        $extensionsPermises = ['pdf', 'doc', 'docx', 'odt', 'rtf', 'tex'];

        $docs = [];
        $files = scandir($userdir);
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                if( is_file($userdir."/".$file))
                {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    if (in_array($ext,$extensionsPermises))
                    {
                        array_push($docs, "$userdir/$file");
                    }
                }
            }
        }
        return $docs;
    }

    function get_docs_number($userid)
    {   
        return count(get_user_docs($userid));
    }


    function get_userstatut($role)
    {
        $statut = "";
        switch ($role) {
            case 'student':
                $statut = "Etudiant";
            break;
            case "tuteur_entreprise":
                $statut = "Tuteur";
            break;
            case "tuteur_pedagogique":
                $statut = "Maitre de stage";
            break;
            case "prof":
                $statut = "Enseignant";
            break;
            case "secretaire":
                $statut = "Secrétaire";
            break;
            default:
                # code...
                break;
        }
        return $statut;
    }



    function get_statut_classname_from_status($statut)
    {
        $s = "";
        switch (strtolower($statut)) {
            case 'non envoyé':
                $s = "non-envoye";
                break;
            case 'attente':
                $s = "attente";
                break;

            case 'validé':
                $s = "validé";
                break;
            default:
                # code...
                break;
        }
        return $s;
    }

?>