<?php
    require "config/config.php";
    require DATABASE_FOLDER."/database.php";
    require "php/util.php";
    init_php_session(); // Initialise la session
    Database::init_database();
  
    $_SESSION["PATHS"] = ["ROOTPATH" => ROOTPATH, "AUTH_FOLDER" => AUTH_FOLDER, "CONFIG_FOLDER" => CONFIG_FOLDER, "DATABASE_FOLDER" => DATABASE_FOLDER];

    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        header("Location: ".L_LOGIN_FOLDER);
    }

    $user = $_SESSION["data"]["userinfo"];
    // echo "<pre>"; print_r($user); echo "</pre>";exit;
    // echo $_SESSION["usertype"];exit; 
    if ($_SESSION["usertype"] == "student")
    {
        // $user = Database::load_all_info($user["id"]);
        $stages = Database::get_stage_from_user($user["id"]);
        $_SESSION["data"]["my_departement"] = Database::get_departement_from_etudiant($user["id"]);
        $_SESSION["data"]["stages"] = [];

        
        if( count($stages) > 0)
        {
            $_SESSION["has_stage"] = true;
    
            for($i = 0; $i < count($stages); $i++)
            {
                $stage = $stages[$i];
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id_Stage"]);
                $student = Database::get_students_from_stage($user["id"], $stage["id_Stage"]);
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id_Stage"]);
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id_Stage"]);
                $jury = Database::get_jury_from_stage($user["id"], $stage["id_Stage"]);
    
                $actions = Database::get_notifications_from_user($user["id"]);
    
                $tab = ["infostage"=>$stage, "tuteur_entreprise"=>$tuteur_stage, "student"=> $student,"tuteur_pedagogique"=>$tuteur_pedagogique, "entreprise"=>$entreprise, "jury"=>$jury, "actions"=>$actions];
                $_SESSION["data"]["stages"][$i] = $tab;
            }
    
            $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);
            // echo "<pre>"; print_r($_SESSION["data"]["current_stage"]); echo "</pre>";exit;
        }else{
            $_SESSION["has_stage"] = false;
        }
    }
    else if ($_SESSION["usertype"] == "tuteur"){
        $role = $_SESSION["real_usertype"];
        $stages = $role == "tuteur_entreprise" ? Database::get_stage_from_tuteur_entreprise($user["id"]) :  Database::get_stage_from_tuteur_ens($user["id"]);
        $_SESSION["data"]["stages"] = [];
    
        if( count($stages) > 0)
        {
            $_SESSION["has_stage"] = true;
            for($i = 0; $i < count($stages); $i++)
            {

                $stage = $stages[$i];
                $student = Database::get_students_from_stage($user["id"], $stage["id_Stage"]);
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id_Stage"]);
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id_Stage"]);
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id_Stage"]);
                $jury = Database::get_jury_from_stage($user["id"], $stage["id_Stage"]);
    
    
                echo "id:".$stage["id_Stage"]."<br>";
                $actions = $role == "tuteur_entreprise" ? 
                    Database::get_notifications_from_tuteur_entreprise_per_stage($user["id"], $stage["id_Stage"]) 
                    : Database::get_notifications_from_tuteur_ens_per_stage($user["id"], $stage["id_Stage"]);
                $tab = ["infostage"=>$stage, "tuteur_entreprise"=>$tuteur_stage, "student"=> $student,"tuteur_pedagogique"=>$tuteur_pedagogique, "entreprise"=>$entreprise, "jury"=>$jury, "actions"=>$actions];
                $_SESSION["data"]["stages"][$i] = $tab;
            }
            
            // echo "<pre>"; print_r($_SESSION["data"]["stages"]); echo "</pre>";exit;

            // exit;
            // $actions = Database::get_notifications_from_tuteur_entreprise($user["id"]);
            // $_SESSION["data"]["actions"] = $actions; 

    
            // $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);
            // echo "<pre>"; print_r($_SESSION["data"]["stages"]); echo "</pre>";exit;
        }else{
            $_SESSION["has_stage"] = false;
        }
    }else{
        $students = Database::get_all_students();
        $_SESSION["data"]["students"] = $students;
        $_SESSION["data"]["my_departement"] = Database::get_departement_from_enseignant($user["id"]);



        $_SESSION["data"]["my_departement_students"] = [];  
        $student_from_departement = Database::get_students_from_departement($user["id_Departement"]);
        foreach ($student_from_departement as $student) {
            $stages = Database::get_stage_from_user($student["id"]);
            $tab = ["has_stage"=>false, "student"=>$student, "stages"=>[]];
            if (count($stages) > 0)
            {
                $tab["has_stage"] = true;
                for($i = 0; $i < count($stages); $i++)
                {
                    $stage = $stages[$i];
                    $tuteur_stage = Database::get_tuteur_from_stage($student["id"], $stage["id_Stage"]);
                    $st = Database::get_students_from_stage($student["id"], $stage["id_Stage"]);
                    $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($student["id"], $stage["id_Stage"]);
                    $entreprise = Database::get_entreprise_from_stage($student["id"], $stage["id_Stage"]);
                    $jury = Database::get_jury_from_stage($student["id"], $stage["id_Stage"]);
        
    
                    $tab_stage = ["infostage"=>$stage, "tuteur_entreprise"=>$tuteur_stage, "student"=> $st,"tuteur_pedagogique"=>$tuteur_pedagogique, "entreprise"=>$entreprise, "jury"=>$jury];
                    array_push($tab["stages"], $tab_stage);
                }
            }
            array_push($_SESSION["data"]["my_departement_students"], $tab);
        }
        // echo "<pre>"; print_r($_SESSION["data"]["my_departement"]); echo "</pre>";exit;
        
        $deps = Database::get_all_departements();
        $_SESSION["data"]["departements"] = $deps;

    }
    
    header("Location: ".L_HOME_FOLDER);
?>

