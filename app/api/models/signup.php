<?php 
    // Class with helper functions for sign up route
    class Signup {
        private $db;

        public function __constructor() {
            $this->db = Db::connect();
        }

        public static function checkConflict($username, $email) {
            // Check for username/email conflicts before creating new account
            // Prepare
            $prepared_sql = "SELECT *
                             FROM users
                             WHERE username = :username
                             OR email = :email";
            $stmt = $this->db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            // Execute
            $stmt->execute();

            // Close the db connection
            $this->db = null;

            return $stmt->rowCount();
        }

        public static function register($username, $email, $UNSAFEpassword) {
            // Prepare
            $prepared_sql = "INSERT INTO users (username, email, password)
                            VALUES (:username, :email, :password)";
            $stmt = $this->db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // HASH THE PASSWORD!!
            $password = password_hash($UNSAFEpassword, PASSWORD_DEFAULT);

            // Execute
            $stmt->execute();

            // Close the db connection
            $this->db = null;
        }
    }
?>