<?php
    // Handles database interactions for signing up users
    class Signup {
        public static function checkConflict($username, $email) {
            // Connect to db
            $db = Db::connect();

            // Check for username/email conflicts before creating new account
            // Prepare
            $prepared_sql = "SELECT *
                             FROM users
                             WHERE username = :username
                             OR email = :email";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            // Execute
            $stmt->execute();

            // Close the db connection
            $db = null;

            return $stmt->rowCount();
        }

        public static function register($username, $email, $UNSAFEpassword) {
            $db = Db::connect();

            // Prepare
            $prepared_sql = "INSERT INTO users (username, email, password)
                            VALUES (:username, :email, :password)";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // HASH THE PASSWORD!!
            $password = password_hash($UNSAFEpassword, PASSWORD_DEFAULT);

            // Execute
            $stmt->execute();

            // Close the db connection
            $db = null;
        }
    }
?>