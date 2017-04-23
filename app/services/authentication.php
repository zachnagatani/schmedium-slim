<?php
    use \Firebase\JWT\JWT;

    class Authentication {
        // Checks validity of a JWT
        // Receives an authorization header
        public static function jwtHandler($authorizationHeader) {
            $authorization = $authorizationHeader[0];
            list($jwt) = sscanf($authorization, 'Bearer %s');
            $dummySecret = "imachangethis";
            $token = JWT::decode($jwt, $dummySecret, array('HS512'));
            return $token;
        }
    }
?>