<?php
    class Database
    {
        private static $PDO;
        private static $DSN;
        private static $USERNAME;
        private static $PASSWORD;

        public static function init_database()
        {
            self::$USERNAME = "root";
            self::$PASSWORD = "";
            self::$DSN = "mysql:host=localhost;dbname=sae_gds"; 
            $options = 
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            try {
                //code...
                self::$PDO = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, $options);
            } catch (\Throwable $th) {
                echo "PDO connexion failed: " . $th->getMessage(); 
            }
        }

        public static function get_sql_syntax($text)
        {
            $res = self::$PDO->quote(htmlspecialchars($text));
            return $res;
        }

        public static function decode_html($text)
        {
            return html_entity_decode($text);
        }

        public static function execute_sql($sql)
        {
            $request = self::$PDO->query($sql);
            if ($request)
            {
                return $request->fetch();
            }
            return false;
        }

        public static function execute_sql_all($sql)
        {
            $request = self::$PDO->query($sql);
            if ($request)
            {
                return $request->fetchall();
            }
            return false;
        }

        public static function search_student($login)
        {
            $login = self::get_sql_syntax($login);
            $sql = "SELECT * FROM utilisateur JOIN Etudiant USING (id) WHERE login = $login;";
            $request = self::execute_sql($sql);
            return $request;
        }
        public static function search_tuteur_entreprise($login)
        {
            $login = self::get_sql_syntax($login);
            $sql = "SELECT * FROM utilisateur JOIN Tuteur_entreprise USING (id) WHERE login = $login;";
            // echo $sql;exit;
            $request = self::execute_sql($sql);
            return $request;
        }
        public static function search_tuteur_pedagogique($login)
        {
            $login = self::get_sql_syntax($login);
                $sql = "SELECT u.*
                        FROM Stage s
                        JOIN Enseignant e ON s.id_1 = e.id
                        JOIN Utilisateur u ON e.id = u.id
                        WHERE u.login = $login;";
                $request = self::execute_sql($sql);
                return $request;
        }

        public static function search_enseignant($login)
        {
            $login = self::get_sql_syntax($login);
            // echo $login; exit;
            $sql = " select * from utilisateur join enseignant using (id) where login = $login;";
            $request = self::execute_sql($sql);
            return $request;
        }

        public static function search_user($login, $role=null)
        {

            if ($role == null)
            {
                if ($login == null or $login == "")
                {
                    return false;
                }
                $login = self::get_sql_syntax($login);
                $sql = "SELECT * FROM utilisateur WHERE login = $login;";
                $request = self::execute_sql($sql);

                return $request;
            }else if ($role == "student"){
                return self::search_student($login);
            } else if ($role == "tuteur_entreprise"){
                return self::search_tuteur_entreprise($login);
            } else if ($role == "tuteur_pedagogique"){
                return self::search_enseignant($login);
            } else if ($role == "prof") {
                return self::search_enseignant($login);
            } else{
                return false;
            }
            
        }

        public static function load_all_info($id)
        {
            $sql = "SELECT
                e.id AS id,
                u.nom AS nom,
                u.prenom AS prenom,
                u.telephone as telephone,
                u.email as email,
                u.login as login,
                t1.id as id_tuteur_enseignant_1,
                t1.nom AS nom_tuteur_enseignant_1,
                t1.prenom AS prenom_tuteur_enseignant_1,
                t1.email as email_tuteur_enseignant_1,
                t1.telephone as telephone_tuteur_enseignant_1,
                t2.id as id_tuteur_enseignant_2,
                t2.nom AS nom_tuteur_enseignant_2,
                t2.prenom AS prenom_tuteur_enseignant_2,
                t2.email as email_tuteur_enseignant_2,
                t2.telephone as telephone_tuteur_enseignant_2,
                te.id as id_tuteur_stage,
                te.nom AS nom_tuteur_stage,
                te.prenom AS prenom_tuteur_stage,
                te.telephone as telephone_tuteur_stage,
                te.email as email_tuteur_stage,
                ent.nom as nom_entreprise,
                ent.adresse AS adresse_entreprise,
                ent.ville AS ville_entreprise,
                ent.tel AS telephone_entreprise,
                s.id_Stage, s.date_debut, s.date_fin, s.titre, s.taches, s.description, s.date_soutenance, s.salle_soutenance
                FROM
                    Etudiant e
                JOIN Utilisateur u ON e.id = u.id
                LEFT JOIN Stage s ON e.id = s.id
                LEFT JOIN Enseignant en1 ON s.id_1 = en1.id
                LEFT JOIN Enseignant en2 ON s.id_2 = en2.id
                LEFT JOIN Utilisateur t1 ON en1.id = t1.id
                LEFT JOIN Utilisateur t2 ON en2.id = t2.id
                LEFT JOIN Tuteur_entreprise tec ON s.id_3 = tec.id
                LEFT JOIN Utilisateur te ON tec.id = te.id
                LEFT JOIN Entreprise ent ON tec.id_Entreprise = ent.id_Entreprise
                WHERE e.id = $id;
            ";
            $request = self::execute_sql($sql);
            return $request;
        }

        public static function get_stage_from_user($userid)
        {
            $sql = "SELECT 
                s.*
            FROM 
                Stage s
            JOIN 
                Inscription i ON s.id_Departement = i.id_Departement AND s.numSemestre = i.numSemestre AND s.id = i.id AND s.annee = i.annee
            WHERE 
                i.id = $userid; ";

            $req = self::execute_sql_all($sql);

            // print_r($req);exit;
            return $req;
        }

        public static function get_tuteur_from_stage($userid, $stageid)
        {
            $sql = "SELECT 
                        tuteur_entreprise.id AS tuteur_id,
                        u.nom AS tuteur_nom,
                        u.prenom AS tuteur_prenom,
                        u.email AS tuteur_email,
                        u.telephone AS tuteur_tel
                    FROM 
                        Stage s
                    JOIN 
                        Inscription i ON s.id_Departement = i.id_Departement 
                                    AND s.numSemestre = i.numSemestre 
                                    AND s.id = i.id 
                                    AND s.annee = i.annee
                    JOIN 
                        Tuteur_entreprise tuteur_entreprise ON s.id_3 = tuteur_entreprise.id
                    JOIN 
                        Entreprise e ON tuteur_entreprise.id_Entreprise = e.id_Entreprise
                    JOIN 
                        Utilisateur u ON u.id = e.id_Entreprise
                    WHERE 
                        s.id_Stage = $stageid;
            ";  

            $req = self::execute_sql($sql);

            // print_r($req);
            return $req;
        }

        public static function get_tuteur_pedagogique_from_stage($userid, $stageid)
        {
            $sql = "SELECT 
                u.id AS tuteur_pedagogique_id,
                u.nom AS tuteur_pedagogique_nom,
                u.prenom AS tuteur_pedagogique_prenom,
                u.email AS tuteur_pedagogique_email,
                u.telephone AS tuteur_pedagogique_tel
                FROM 
                    Stage s
                JOIN 
                    Utilisateur u ON u.id = s.id_1
                WHERE 
                    s.id_Stage = $stageid;
                ";

            $req = self::execute_sql($sql);

            // print_r($req);
            return $req;
        }

        public static function get_entreprise_from_stage($userid, $stageid)
        {
            $sql = "SELECT 
                e.id_Entreprise AS entreprise_id,
                e.nom AS entreprise_nom,
                e.adresse AS entreprise_adresse,
                e.code_postal AS entreprise_code_postal,
                e.ville AS entreprise_ville,
                e.indicationVisite AS entreprise_indicationVisite,
                e.tel AS entreprise_tel
                FROM 
                    Stage s
                JOIN 
                    Inscription i ON s.id_Departement = i.id_Departement 
                                AND s.numSemestre = i.numSemestre 
                                AND s.id = i.id 
                                AND s.annee = i.annee
                JOIN 
                    Tuteur_entreprise tuteur_entreprise ON s.id_3 = tuteur_entreprise.id
                JOIN 
                    Entreprise e ON tuteur_entreprise.id_Entreprise = e.id_Entreprise
                WHERE 
                    s.id_Stage = $stageid;
                ";

            $req = self::execute_sql($sql);

            // print_r($req);exit;
            return $req;
        }


        public static function get_jury_from_stage($userid, $stageid)
        {
            $sql = "SELECT 
                e1.id AS enseignant_1_id,
                u1.nom AS enseignant_1_nom,
                u1.prenom AS enseignant_1_prenom,
                u1.email AS enseignant_1_email,
                u1.telephone AS enseignant_1_tel,
                e2.id AS enseignant_2_id,
                u2.nom AS enseignant_2_nom,
                u2.prenom AS enseignant_2_prenom,
                u2.email AS enseignant_2_email,
                u2.telephone AS enseignant_2_tel
                FROM 
                    Stage s
                JOIN 
                    Enseignant e1 ON e1.id = s.id_1
                JOIN 
                    Utilisateur u1 ON u1.id = e1.id
                JOIN 
                    Enseignant e2 ON e2.id = s.id_2
                JOIN 
                    Utilisateur u2 ON u2.id = e2.id
                WHERE 
                    s.id_Stage = $stageid;
            ";

            $req = self::execute_sql_all($sql);

            // print_r($req);exit;
            return $req;
        }








        public static function get_stage_from_tuteur_entreprise($id)
        {
            $sql = "SELECT 
                s.*
            FROM 
                Stage s
            JOIN 
                Tuteur_entreprise te ON s.id_3 = te.id_Entreprise
            WHERE 
                te.id = $id;  ";

            $req = self::execute_sql_all($sql);

            // print_r($req);
            return $req;
        }

        public static function get_stage_from_tuteur_ens($id)
        {
            $sql = "SELECT 
                s.*
            FROM 
                Stage s
            JOIN 
                Enseignant e ON s.id_1 = e.id
            WHERE 
                e.id = $id;  ";

            $req = self::execute_sql_all($sql);

            // print_r($req);
            return $req;
        }


        public static function get_students_from_stage($id, $stageid)
        {
            $sql = "SELECT 
                    u.*
                FROM 
                    Stage s
                JOIN 
                    Tuteur_entreprise te ON s.id_3 = te.id_Entreprise
                JOIN 
                    Inscription i ON s.id = i.id
                JOIN 
                    Etudiant e ON i.id = e.id
                JOIN 
                    Utilisateur u ON e.id = u.id
                WHERE 
                    s.id_Stage = $stageid;  
                ";

            $req = self::execute_sql($sql);

            // print_r($req);
            return $req;
        }

        public static function get_all_students()
        {   
            $sql = "select * from utilisateur join etudiant using (id);";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function get_all_departements()
        {   
            $sql = "select * from departement;";
            $req = self::execute_sql_all($sql);
            return $req;
        }


        public static function get_departement_from_id($id)
        {
            $sql = "select * from departement where id_Departement = $id;";
            $req = self::execute_sql($sql);
            return $req;
        }

        public static function get_students_from_departement($departement_id)
        {
            $sql = "select * from utilisateur join etudiant using (id) join departement using (id_Departement) where etudiant.id_Departement = $departement_id;";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function get_departement_from_enseignant($teacher_id)
        {
            $sql = "select * from departement join enseignant using (id_Departement) where enseignant.id = $teacher_id;";
            $req = self::execute_sql($sql);
            return $req;
        }

        public static function get_departement_from_etudiant($student_id)
        {
            $sql = "select * from departement join etudiant using (id_Departement) where etudiant.id = $student_id;";
            $req = self::execute_sql($sql);
            return $req;
        }




        public static function get_notifications_from_user($userid)
        {
            $sql = "SELECT
                    *
                FROM
                    Action
                JOIN
                    TypeAction USING (id_TypeAction) 
                WHERE
                    id_1 = $userid;
            ";

            $req = self::execute_sql_all($sql);
            return $req;
        }


        public static function get_notifications_from_tuteur_entreprise($tuteur_entreprise)
        {
            $sql = "select typeaction.*, action.* from action join typeaction using (id_TypeAction) join stage using (id_Stage) 
                    join Utilisateur on action.id_1 = Utilisateur.id join tuteur_entreprise on tuteur_entreprise.id = stage.id_3 
                    where tuteur_entreprise.id = $tuteur_entreprise and typeaction.Destinataire = 'tuteur entreprise';";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function get_notifications_from_tuteur_entreprise_per_stage($tuteur_entreprise, $id_stage)
        {
            $sql = "select typeaction.*, action.* from action join typeaction using (id_TypeAction) join stage using (id_Stage) 
                    join Utilisateur on action.id_1 = Utilisateur.id join tuteur_entreprise on tuteur_entreprise.id = stage.id_3 
                    where tuteur_entreprise.id = $tuteur_entreprise and typeaction.Destinataire = 'tuteur entreprise' and id_Stage=$id_stage;";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function get_notifications_from_tuteur_ens_per_stage($tuteur_peda, $id_stage)
        {
            $sql = "select typeaction.*, action.* from action join typeaction using (id_TypeAction) join stage using (id_Stage) 
                    join Utilisateur on action.id_1 = Utilisateur.id join Enseignant on Enseignant.id = stage.id_1 
                    where Enseignant.id = $tuteur_peda and typeaction.Destinataire = 'tuteur pedagogique' and id_Stage=$id_stage;";
            $req = self::execute_sql_all($sql);
            return $req;
        }


        public static function get_all_tuteur_entreprise()
        {
            $sql = "SELECT
                    Utilisateur.id,
                    Utilisateur.nom,
                    Utilisateur.prenom
                FROM
                    Tuteur_entreprise
                INNER JOIN
                    Utilisateur ON Tuteur_entreprise.id = Utilisateur.id;
            ";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function get_all_profs()
        {
            $sql = "SELECT
                    Utilisateur.id,
                    Utilisateur.nom,
                    Utilisateur.prenom
                FROM
                    enseignant
                INNER JOIN
                    Utilisateur ON enseignant.id = Utilisateur.id;
            ";
            $req = self::execute_sql_all($sql);
            return $req;
        }

        public static function add_stage($userinfo, $infos)
        {
            $id = $userinfo["id"];
            $titre = self::get_sql_syntax($infos["titre"]);
            $entreprise_nom = self::get_sql_syntax($infos["entreprise"]);
            $entreprise_adresse = self::get_sql_syntax($infos["entreprise_adresse"]);
            $entreprise_ville = self::get_sql_syntax($infos["entreprise_ville"]);
            $entreprise_codepostal = self::get_sql_syntax($infos["entreprise_codepostal"]);
            $entreprise_email = self::get_sql_syntax($infos["entreprise_email"]);
            $entreprise_tel = self::get_sql_syntax($infos["entreprise_tel"]);


            $date_debut = self::get_sql_syntax($infos["date_debut"]);
            $date_fin = self::get_sql_syntax($infos["date_fin"]);

            $salle_soutenance = self::get_sql_syntax($infos["salle_soutenance"]);
            $date_soutenance = self::get_sql_syntax($infos["date_soutenance"]);

            $tuteur_stage = self::get_sql_syntax($infos["tuteur_stage"]);
            $tuteur_pedagogique = self::get_sql_syntax($infos["tuteur_pedagogique"]);
            $jury2 = self::get_sql_syntax($infos["jury2"]);

            $description = self::get_sql_syntax($infos["description"]);
            $taches = self::get_sql_syntax($infos["taches"]);
            $departement = self::get_sql_syntax($infos["departement"]);

            $jury2 = $infos["jury2"]; 

            // echo $id;  echo "<pre>";print_r($infos);echo "</pre>";exit;

            $sql = "INSERT INTO Inscription
            VALUES ($departement, 1, $id, 2025);

            INSERT INTO Stage (id_Departement, numSemestre, id, annee, date_debut, date_fin, titre, description, taches, date_soutenance, salle_soutenance, id_1, id_2, id_3)
            VALUES ($departement, 1, $id, 2025, $date_debut, $date_fin, $titre, $description, $taches, $date_soutenance, $salle_soutenance, $tuteur_pedagogique, $jury2, $tuteur_stage);";
            
            // echo $sql;exit;
            self::execute_sql($sql);

            $id_stage = self::$PDO->lastInsertId();

            for ($i = 1; $i < 5; $i++)
            {
                $tab = self::execute_sql("SELECT delaiEnJours FROM TypeAction WHERE id_TypeAction = $i");
                $delaiEnJours = $tab["delaiEnJours"];
                $date_realisation = (new DateTime($infos["date_debut"]))->add(new DateInterval("P{$delaiEnJours}D"))->format('Y-m-d');
                $date_realisation = self::get_sql_syntax($date_realisation);

                $sql = "INSERT INTO Action (id_Departement, numSemestre, id, annee, id_Stage, date_realisation, id_TypeAction, id_1)
                VALUES($departement, 1, $id, 2025, $id_stage, $date_realisation, $i, $id);";

                self::execute_sql($sql);
                
            }
            // echo "<pre>".$sql."</pre>";exit;
        }



        public static function delete_stage($id_etudiant, $id_stage)
        {
            $sql = "DELETE FROM Stage
                WHERE id_Stage = $id_stage;

                DELETE FROM Inscription
                WHERE id = $id_etudiant;
            ";
            self::execute_sql($sql);
        }

        public static function get_all_entreprises()
        {
            $sql = "select * from entreprise;";
            $req = self::execute_sql_all($sql);
            return $req;
        }       


        public static function add_user($infos, $role=null)
        {
            $nom = self::get_sql_syntax($infos["nom"]);
            $prenom = self::get_sql_syntax($infos["prenom"]);
            $email = self::get_sql_syntax( $infos["email"]);
            $telephone = self::get_sql_syntax($infos["tel"]);
            $login = self::get_sql_syntax($infos["login"]);
            $pw = self::$PDO->quote(password_hash($infos["password"], PASSWORD_BCRYPT));
            if ($role == "tuteur_entreprise")
            {
                $entreprise_id = $infos["choix_entreprise"];
            }
            // echo "<pre>";
            // print_r($infos);
            // echo "</pre>";exit;
            $sql = "INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
            VALUES ($nom, $prenom, $email, $telephone, $login, $pw);";
            self::execute_sql($sql);
            $last_user_id = self::$PDO->lastInsertId();
            if ($role == "student")
            {
                $departement =  self::get_sql_syntax($infos["choix_departement"]);
                $sql = "INSERT INTO Etudiant (id, id_Departement)
                VALUES ($last_user_id, $departement);";
            }else if ($role == "tuteur_entreprise")
            {
                $sql = "INSERT INTO Tuteur_entreprise (id, id_Entreprise)
                VALUES ($last_user_id, $entreprise_id);";"";
            }else{
                $bureau =  self::get_sql_syntax($infos["bureau"]);
                $departement =  self::get_sql_syntax($infos["choix_departement"]);
                $sql = "INSERT INTO Enseignant (id, Bureau, id_Departement)
                VALUES ($last_user_id, $bureau, $departement);";
            }

            // echo "<pre>";
            // echo $sql;
            // echo "</pre>";exit;

            self::execute_sql($sql);
        }


    }


    
?>