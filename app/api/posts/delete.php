<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Firebase\JWT\JWT;

    $app->delete('/api/posts/delete/{id}', function(Request $request, Response $response) {
        try {
            // Calls jwtHandler on Authentication service
            // Extracts jwt from header
            $token = Authentication::jwtHandler($request->getHeader('authorization'));

            // Connect to the db
            $db = Db::connect();

            // id of post
            $id = $request->getAttribute("id");

            // Check for matching author
            $userIsAuthorized = Authorization::checkAuthor($db, $token->data->username, $id);

            // If user is authorized, create new post object and
            // delete the object from the db
            // if ($author->author === $token->data->username) {
            if ($userIsAuthorized) {
                $post = new Post();
                $post->delete($db, $id);

                // Close the db connection
                $db = null;

                // Return confirmation message
                $data = array("text" => "Post deleted.");
                return $response->withJson($data);
            } else {
                $err = array("error" => "Unauthorized");
                return $response->withJson($err);
            }
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>