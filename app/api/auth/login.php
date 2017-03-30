<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    // Access to Token class for jwt generation
    require_once('token.php');


    // Class with helper functions for login route
    class Login {
        public static function checkPassword($username, $password) {
            // Connect to db
            $db = Db::connect();

            // Prepare
            $prepared_sql = "SELECT password
                             FROM users
                             WHERE username = :username";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(':username', $username);

            // Execute
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);
                return password_verify($password, $hashedPassword["password"]);
            } else {
                return;
            }
        }
    }

    $app->post('/api/auth/login', function(Request $request, Response $response) {
        $username = $request->getParam('username');
        $password = $request->getParam('password');

        try {
            if (Login::checkPassword($username, $password)) {
                $data = array("jwt" => Token::jwt($username));
                return $response->withJson($data);
            } else {
                $err = array("error" => "Invalid login credentials.");
                return $response->withJson($err);
            }
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>