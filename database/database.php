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
            return self::$PDO->quote(html_entity_decode($text));
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

        public static function search_user($login)
        {
            if ($login == null or $login == "")
            {
                return false;
            }
            $login = self::get_sql_syntax($login);
            $sql = "SELECT * FROM utilisateur WHERE login = $login;";
            $request = self::execute_sql($sql);

            return $request;
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
                t1.nom AS nom_tuteur_enseignant_1,
                t1.prenom AS prenom_tuteur_enseignant_1,
                t2.nom AS nom_tuteur_enseignant_2,
                t2.prenom AS prenom_tuteur_enseignant_2,
                te.nom AS nom_tuteur_stage,
                te.prenom AS prenom_tuteur_stage,
                te.telephone as telephone_tuteur_stage,
                te.email as email_tuteur_stage,
                ent.nom as nom_entreprise,
                ent.adresse AS adresse_entreprise,
                ent.ville AS ville_entreprise,
                ent.tel AS telephone_entreprise,
                s.id_Stage, s.date_debut, s.date_fin, s.mission, s.date_soutenance, s.salle_soutenance
                FROM
                    Etudiant e
                JOIN Utilisateur u ON e.id = u.id
                JOIN Stage s ON e.id = s.id
                JOIN Enseignant en1 ON s.id_1 = en1.id
                JOIN Enseignant en2 ON s.id_2 = en2.id
                JOIN Utilisateur t1 ON en1.id = t1.id
                JOIN Utilisateur t2 ON en2.id = t2.id
                JOIN Tuteur_entreprise tec ON s.id_3 = tec.id
                JOIN Utilisateur te ON tec.id = te.id
                JOIN Entreprise ent ON tec.id_Entreprise = ent.id_Entreprise
                WHERE e.id = $id;
            ";
            $request = self::execute_sql($sql);

            return $request;
        }

    }
?>