<?php
    class Db {
        public static $dbhost = "localhost";
        public static $dbuser = "root";
        public static $dbpass = "";
        public static $dbname = "schmedium-slim";

        public function connect() {
            try {
                $conn = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbuser, self::$dbpass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connectioned failed. Error = " . $e->getMessage();
            }
        }
    }
?>