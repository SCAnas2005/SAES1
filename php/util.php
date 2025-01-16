<?php
    function init_php_session() : bool
    {
        if (!session_id())
        {
            session_start();
            // session_regenerate_id();
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

    

?>