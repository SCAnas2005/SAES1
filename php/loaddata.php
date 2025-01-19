<?php
    require "config/config.php";
    require DATABASE_FOLDER."/database.php";
    require "php/util.php";
    init_php_session(); // Initialise la session
    Database::init_database(); 
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: ".L_LOGIN_FOLDER);
    }

    if ($_SESSION["usertype"] == "student")
    {
        // $user = Database::load_all_info($user["id"]);
        $user = $_SESSION["data"]["userinfo"];
        $stages = Database::get_stage_from_user($user["id"]);
        $_SESSION["data"]["stages"] = [];
    
        if( count($stages) > 0)
        {
            $_SESSION["has_stage"] = true;
    
            for($i = 0; $i < count($stages); $i++)
            {
                $stage = $stages[$i];
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id"]);
                $student = Database::get_students_from_stage($user["id"], $stage["id"]);
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id"]);
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id"]);
                $jury = Database::get_jury_from_stage($user["id"], $stage["id"]);
    
    
                $tab = ["infostage"=>$stage, "tuteur_entreprise"=>$tuteur_stage, "student"=> $student,"tuteur_pedagogique"=>$tuteur_pedagogique, "entreprise"=>$entreprise, "jury"=>$jury];
                $_SESSION["data"]["stages"][$i] = $tab;
            }
    
            $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);
            // echo "<pre>"; print_r($_SESSION["data"]["current_stage"]); echo "</pre>";exit;
        }else{
            $_SESSION["has_stage"] = false;
        }
    }
    else{
        $stages = Database::get_stage_from_tuteur_entreprise($user["id"]);
        $_SESSION["data"]["stages"] = [];
    
        if( count($stages) > 0)
        {
            $_SESSION["has_stage"] = true;
    
            for($i = 0; $i < count($stages); $i++)
            {
                $stage = $stages[$i];
                $student = Database::get_students_from_stage($user["id"], $stage["id"]);
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id"]);
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id"]);
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id"]);
                $jury = Database::get_jury_from_stage($user["id"], $stage["id"]);
    
    
                $tab = ["infostage"=>$stage, "tuteur_entreprise"=>$tuteur_stage, "student"=> $student,"tuteur_pedagogique"=>$tuteur_pedagogique, "entreprise"=>$entreprise, "jury"=>$jury];
                $_SESSION["data"]["stages"][$i] = $tab;
            }
    
            // $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);
            // echo "<pre>"; print_r($_SESSION["data"]["stages"]); echo "</pre>";exit;
        }else{
            $_SESSION["has_stage"] = false;
        }
    }   


?>