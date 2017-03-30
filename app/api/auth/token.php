<?php
    use \Firebase\JWT\JWT;

    class Token {
        public static function jwt($username) {
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
    }
?>