<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->patch('/api/posts/update/{id}', function(Request $request, Response $response) {
        try {
            // Connect to the db
            $db = Db::connect();

            // SQL for prepared statement
            $prepared_sql = "UPDATE posts
                             SET content = :content
                             WHERE id = :id";

            // Prepare the statement
            $stmt = $db->prepare($prepared_sql);
            // Bind the paramaters
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id', $id);

            // Provide values for bound params
            $content = $request->getParam('content');
            $id = $request->getAttribute('id');

            // Excecute the statement
            $stmt->execute();

            // Close the db connection
            $db = null;

            // Return a confirmation message
            $data = array("text" => "Post updated.");
            return $response->withJson($data);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>