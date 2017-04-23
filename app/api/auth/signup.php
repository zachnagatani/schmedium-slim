<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

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
                $data = array("jwt" => Authentication::generateJWT($username));
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