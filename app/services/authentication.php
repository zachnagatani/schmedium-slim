<?php
    use \Firebase\JWT\JWT;

    class Authentication {
        // Generates JWTS on login and signup
        // Takes in a username to store in jwt
        public static function generateJWT($username) {
            $dummySecret = "imachangethis";
            $tokenID = base64_encode(mcrypt_create_iv(32));
            $issuedAt = time();
            $notBefore = $issuedAt + 10;
            $expires = $notBefore + (60 * 60);
            $data = array(
                "jti" => $tokenID,
                "iat" => $issuedAt,
                "nbf" => $notBefore,
                "exp" => $expires,
                "data" => array(
                    "username" => $username
                )
            );

            $jwt = JWT::encode(
                $data,
                $dummySecret,
                'HS512'
            );

            return $jwt;
        }

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