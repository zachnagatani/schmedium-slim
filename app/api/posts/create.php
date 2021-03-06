<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/posts/create', function(Request $request, Response $response) {
        try {
            // Calls authenticate on Authentication service
            // Extracts jwt from header
            $token = Authentication::authenticate($request->getHeader('authorization'));

            // Connect to the database
            $db = Db::connect();

            // Create new post object and save it to database
            $post = new Post(
                array(
                    'title' => $request->getParam('title'),
                    'tagline' => $request->getParam('tagline'),
                    'image_url' => $request->getParam('image_url'),
                    'content' => $request->getParam('content'),
                    'author' => $token->data->username
                )
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