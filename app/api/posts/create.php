<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/posts/create', function(Request $request, Response $response) {
        try {
            // Connect to the database
            $db = Db::connect();

            // Query for prepared statement
            $prepared_sql = "INSERT INTO posts (title, image_url, content, author)
                            VALUES (:title, :image_url, :content, :author)";
            // Prepare the query
            $stmt = $db->prepare($prepared_sql);
            // Bind the query parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image_url', $image_url);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author', $author);

            // Set the values of the paramaters from the request object
            $title = $request->getParam('title');
            $image_url = $request->getParam('image_url');
            $content = $request->getParam('content');
            $author = $request->getParam('author');

            // Execute the query
            $stmt->execute();

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