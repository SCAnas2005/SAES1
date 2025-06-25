<?php
    // Inclusion du fichier de configuration principale
    require "config/config.php";

    // Inclusion du fichier de gestion de la base de données
    require DATABASE_FOLDER."/database.php";

    // Inclusion des fonctions utilitaires PHP
    require "php/util.php";

    // Initialisation de la session PHP (démarrage ou reprise de session)
    init_php_session(); 

    // Initialisation de la connexion à la base de données via la classe Database
    Database::init_database(); 

    // Vérification que l'utilisateur est connecté (session "logged" définie et vraie)
    if (!isset($_SESSION["logged"]) or $_SESSION["logged"] == false)
    {
        // Redirection vers la page de login si non connecté
        header("Location: ".L_LOGIN_FOLDER);
    }

    // Gestion des données selon le type d'utilisateur
    if ($_SESSION["usertype"] == "student")
    {
        // Chargement des informations utilisateur depuis la session (évite un nouvel appel à la DB)
        $user = $_SESSION["data"]["userinfo"];

        // Récupération de la liste des stages liés à l'étudiant
        $stages = Database::get_stage_from_user($user["id"]);

        // Initialisation du tableau de stages dans la session (vide avant remplissage)
        $_SESSION["data"]["stages"] = [];
    
        // Vérifie s'il y a au moins un stage
        if( count($stages) > 0)
        {
            // Indique qu'au moins un stage existe pour cet utilisateur
            $_SESSION["has_stage"] = true;
    
            // Parcours de tous les stages de l'étudiant
            for($i = 0; $i < count($stages); $i++)
            {
                $stage = $stages[$i];

                // Récupération du tuteur en entreprise pour ce stage
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id"]);

                // Récupération des étudiants liés à ce stage (probablement utile si plusieurs)
                $student = Database::get_students_from_stage($user["id"], $stage["id"]);

                // Récupération du tuteur pédagogique lié au stage
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id"]);

                // Récupération des informations de l'entreprise d'accueil du stage
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id"]);

                // Récupération du jury lié à la soutenance du stage
                $jury = Database::get_jury_from_stage($user["id"], $stage["id"]);
    
                // Construction d'un tableau associatif regroupant toutes les informations du stage
                $tab = [
                    "infostage" => $stage, 
                    "tuteur_entreprise" => $tuteur_stage, 
                    "student" => $student,
                    "tuteur_pedagogique" => $tuteur_pedagogique, 
                    "entreprise" => $entreprise, 
                    "jury" => $jury
                ];

                // Stockage de ce tableau dans la session, indexé par le numéro du stage
                $_SESSION["data"]["stages"][$i] = $tab;
            }
    
            // Définit le stage courant (le dernier du tableau) dans la session pour un accès rapide
            $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);
            // Debug (commenté) : affichage du stage courant
            // echo "<pre>"; print_r($_SESSION["data"]["current_stage"]); echo "</pre>";exit;
        }
        else{
            // Indique qu'aucun stage n'est associé à cet utilisateur
            $_SESSION["has_stage"] = false;
        }
    }
    else{
        // Pour les autres utilisateurs (tuteur entreprise, secrétaires, etc.)

        // Récupération des stages liés au tuteur en entreprise connecté
        $stages = Database::get_stage_from_tuteur_entreprise($user["id"]);

        // Initialisation du tableau des stages dans la session
        $_SESSION["data"]["stages"] = [];
    
        // Vérifie qu'il y a des stages
        if( count($stages) > 0)
        {
            $_SESSION["has_stage"] = true;
    
            // Parcours des stages associés
            for($i = 0; $i < count($stages); $i++)
            {
                $stage = $stages[$i];

                // Récupération des étudiants liés à ce stage
                $student = Database::get_students_from_stage($user["id"], $stage["id"]);

                // Récupération du tuteur en entreprise lié à ce stage
                $tuteur_stage = Database::get_tuteur_from_stage($user["id"], $stage["id"]);

                // Récupération du tuteur pédagogique
                $tuteur_pedagogique = Database::get_tuteur_pedagogique_from_stage($user["id"], $stage["id"]);

                // Récupération des infos de l'entreprise d'accueil
                $entreprise = Database::get_entreprise_from_stage($user["id"], $stage["id"]);

                // Récupération du jury lié au stage
                $jury = Database::get_jury_from_stage($user["id"], $stage["id"]);
    
                // Construction du tableau récapitulatif pour ce stage
                $tab = [
                    "infostage" => $stage, 
                    "tuteur_entreprise" => $tuteur_stage, 
                    "student" => $student,
                    "tuteur_pedagogique" => $tuteur_pedagogique, 
                    "entreprise" => $entreprise, 
                    "jury" => $jury
                ];

                // Enregistrement dans la session
                $_SESSION["data"]["stages"][$i] = $tab;
            }
    
            // La définition du stage courant est commentée ici (à activer si besoin)
            // $_SESSION["data"]["current_stage"] = end($_SESSION["data"]["stages"]);

            // Debug (commenté) : affichage des stages
            // echo "<pre>"; print_r($_SESSION["data"]["stages"]); echo "</pre>";exit;
        }
        else{
            // Aucun stage pour ce tuteur
            $_SESSION["has_stage"] = false;
        }
    }   
?>
