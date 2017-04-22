<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Firebase\JWT\JWT;

    $app->patch('/api/posts/update/{id}', function(Request $request, Response $response) {
        try {
            // TODO: Abstract into class somewhere for reuse in other routes
            $authorization = $request->getHeader('authorization')[0];
            list($jwt) = sscanf($authorization, 'Bearer %s');
            $dummySecret = "imachangethis";
            $token = JWT::decode($jwt, $dummySecret, array('HS512'));

            // Connect to the db
            $db = Db::connect();

            // Prepare
            $prepared_sql = "SELECT author
                             FROM posts
                             WHERE id = :id";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(":id", $id);
            $id = $request->getAttribute("id");

            // Execute
            $stmt->execute();

            $author = $stmt->fetch(PDO::FETCH_OBJ);

            // If user is authorized, create a new post object and update the post
            // Otherwise respond with error message
            if ($author->author === $token->data->username) {
                $post = new Post(array("content" => $request->getParam('content')));
                $post->update($db, $id);

                // Close the db connection
                $db = null;

                // Return a confirmation message
                $data = array("text" => "Post updated.");
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