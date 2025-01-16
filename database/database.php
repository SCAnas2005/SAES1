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
            self::$DSN = "mysql:database=sae_gds;host=localhost"; 
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
    }
    

?>