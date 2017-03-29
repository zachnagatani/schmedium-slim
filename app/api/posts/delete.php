<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->delete('/api/posts/delete/{id}', function(Request $request, Response $response) {
        try {
            // Connect to the db
            $db = Db::connect();

            // SQL for prepared statement to delete post
            $prepared_sql = "DELETE FROM posts
                             WHERE id = :id";
            $stmt = $db->prepare($prepared_sql);

            // Bind params
            $stmt->bindParam(':id', $id);

            // Provide values for bound params
            $id = $request->getAttribute('id');

            // Execute the statement
            $stmt->execute();

            // Close the db connection
            $db = null;

            // Return confirmation message
            $data = array("text" => "Post deleted.");
            $response->withJson($data);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>