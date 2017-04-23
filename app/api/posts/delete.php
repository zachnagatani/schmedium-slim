<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Firebase\JWT\JWT;

    $app->delete('/api/posts/delete/{id}', function(Request $request, Response $response) {
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

            // If user is authorized, create new post object and
            // delete the object from the db
            if ($author->author === $token->data->username) {
                $post = new Post();
                $post->delete($db, $id);

                // Execute the statement
                $stmt->execute();

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