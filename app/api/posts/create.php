<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Firebase\JWT\JWT;

    $app->post('/api/posts/create', function(Request $request, Response $response) {
        try {
            // TODO: Abstract into class somewhere for reuse in other routes
            $authorization = $request->getHeader('authorization')[0];
            list($jwt) = sscanf($authorization, 'Bearer %s');
            $dummySecret = "imachangethis";
            $token = JWT::decode($jwt, $dummySecret, array('HS512'));

            // Connect to the database
            $db = Db::connect();

            // Create new post object and save it to database
            $post = new Post(
                $request->getParam('title'),
                $request->getParam('tagline'),
                $request->getParam('image_url'),
                $request->getParam('content'),
                $token->data->username
            );
            $post->save($db);

            // Close the db
            $db = null;

            $data = array("text" => "Post Added");
            return $response->withJson($data);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>