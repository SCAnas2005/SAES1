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
        return isset($_SESSION["username"]);
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

?>