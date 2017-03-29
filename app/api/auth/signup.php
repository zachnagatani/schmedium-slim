<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/auth/signup', function(Request $request, Response $response) {
        try {
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

            $username = $request->getParam('username');
            $email = $request->getParam('email');

            // Execute
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                // Prepare
                $prepared_sql = "INSERT INTO users (username, email, password)
                                VALUES (:username, :email, :password)";
                $stmt = $db->prepare($prepared_sql);

                // Bind
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $UNSAFEpassword = $request->getParam('password');
                // HASH THE PASSWORD!!
                $password = password_hash($UNSAFEpassword, PASSWORD_DEFAULT);

                // Execute
                $stmt->execute();

                // Return a confirmation message
                $data = array("text" => "Account created!");
                return $response->withJson($data);
            } else {
                $err = array("error" => "User with that username or email already exists.");
                return $response->withJson($err);
            }
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>