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

        public static function search_user($username)
        {
            if ($username == null)
            {
                return false;
            }
            $username = self::$PDO->quote(html_entity_decode($username));
            $sql = "SELECT * FROM utilisateur WHERE login = $username;";
            $request = self::$PDO->query($sql);

            if ($request)
            {
                return $request->fetch();
            }
            return false;
        }

    }
    

?>