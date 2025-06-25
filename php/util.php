<?php
    /**
     * Initialise une session PHP si elle n'est pas déjà démarrée.
     * @return bool True si la session a été démarrée, false sinon.
     */
    function init_php_session() : bool
    {
        if (!session_id()) // Vérifie si aucune session n'est active
        {
            session_start(); // Démarre la session
            session_regenerate_id(); // Regénère l'ID de session pour éviter le fixation d'ID
            return true;
        }   
        return false;
    }

    /**
     * Ferme la session PHP en cours en supprimant toutes les variables de session.
     */
    function close_php_session() 
    {
        session_unset();   // Supprime toutes les variables de session
        session_destroy(); // Détruit la session
    }

    /**
     * Vérifie si un utilisateur est connecté (variable "logged" présente dans la session).
     * @return bool True si connecté, false sinon.
     */
    function is_logged()
    {
        return isset($_SESSION["logged"]);
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     * @return bool True si admin, false sinon.
     */
    function is_admin()
    {
        return (is_logged() && $_SESSION["admin"]);
    }

    /**
     * Compare deux mots de passe (non sécurisé pour un usage réel).
     * @param string $p1 Premier mot de passe.
     * @param string $p2 Deuxième mot de passe.
     * @return bool True si identiques, false sinon.
     */
    function check_passwords($p1, $p2)
    {
        return ($p1 == $p2);
    }

    /**
     * Retourne le chemin absolu vers le répertoire personnel d'un utilisateur.
     * @param int|string $userid Identifiant utilisateur.
     * @return string Chemin vers le dossier utilisateur.
     */
    function get_user_dirpath($userid)
    {
        $userdir = $_SERVER['DOCUMENT_ROOT'] . "/docs/$userid";
        return $userdir;
    }

    /**
     * Vérifie si le répertoire personnel d'un utilisateur existe.
     * @param int|string $userid Identifiant utilisateur.
     * @return bool True si le dossier existe, false sinon.
     */
    function is_user_dir($userid)
    {
        $userdir = get_user_dirpath($userid);
        return is_dir($userdir);
    }

    /**
     * Crée le répertoire personnel d'un utilisateur.
     * @param int|string $userid Identifiant utilisateur.
     */
    function make_user_dir($userid)
    {
        $userdir = get_user_dirpath($userid);
        mkdir($userdir);
    }

    /**
     * Récupère la liste des documents (avec extensions permises) d'un utilisateur.
     * Crée le dossier utilisateur s'il n'existe pas.
     * @param int|string $userid Identifiant utilisateur.
     * @return array Liste des chemins complets vers les fichiers documents.
     */
    function get_user_docs($userid) 
    {   
        $userdir = $_SERVER['DOCUMENT_ROOT'] . "/docs/$userid";

        // Crée le dossier utilisateur s'il n'existe pas
        if (!is_user_dir($userid))
        {
            make_user_dir($userid);
        }

        // Extensions autorisées pour les documents
        $extensionsPermises = ['pdf', 'doc', 'docx', 'odt', 'rtf', 'tex'];

        $docs = [];
        $files = scandir($userdir); // Liste des fichiers dans le dossier utilisateur

        // Parcours des fichiers
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                if( is_file($userdir."/".$file)) // Vérifie que c'est un fichier
                {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    if (in_array($ext,$extensionsPermises)) // Vérifie l'extension autorisée
                    {
                        array_push($docs, "$userdir/$file");
                    }
                }
            }
        }
        return $docs;
    }

    /**
     * Retourne le nombre de documents valides dans le dossier utilisateur.
     * @param int|string $userid Identifiant utilisateur.
     * @return int Nombre de fichiers documents.
     */
    function get_docs_number($userid)
    {   
        return count(get_user_docs($userid));
    }

    /**
     * Traduit un rôle utilisateur en libellé français lisible.
     * @param string $role Rôle interne (ex : "student", "tuteur_entreprise").
     * @return string Libellé du rôle en français.
     */
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
                // Rôle inconnu : retourne chaîne vide
                break;
        }
        return $statut;
    }
?>
