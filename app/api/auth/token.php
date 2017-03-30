<?php
    use \Firebase\JWT\JWT;

    class Token {
        public static function generate($username) {
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

        public static function preAuth($request) {
            $authorization = $request->getHeader('authorization')[0];
            list($jwt) = sscanf($authorization, 'Bearer %s');
            $dummySecret = "imachangethis";
            $token = JWT::decode($jwt, $dummySecret, array('HS512'));
        }
    }
?>