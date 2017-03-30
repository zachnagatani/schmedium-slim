<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    // For access to the Token class to handle generating jwt
    require_once('token.php');

    // Class with helper functions for sign up route
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

    $app->post('/api/auth/signup', function(Request $request, Response $response) {
        $username = $request->getParam('username');
        $email = $request->getParam('email');
        $UNSAFEpassword = $request->getParam('password');
        try {
            // Check for conflicts
            if (Signup::checkConflict($username, $email) === 0) {
                // Register the user
                Signup::register($username, $email, $UNSAFEpassword);
                // Return a confirmation message
                $data = array("jwt" => Token::generate($username));
                return $response->withJson($data);
            } else {
                // Let the user know something exists already
                $err = array("error" => "User with that username or email already exists.");
                return $response->withJson($err);
            }
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>