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

            // Query for prepared statement
            $prepared_sql = "INSERT INTO posts (title, tagline, image_url, content, author)
                            VALUES (:title, :tagline, :image_url, :content, :author)";
            // Prepare the query
            $stmt = $db->prepare($prepared_sql);
            // Bind the query parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':tagline', $tagline);
            $stmt->bindParam(':image_url', $image_url);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author', $author);

            // Set the values of the paramaters from the request object
            $title = $request->getParam('title');
            $tagline = $request->getParam('tagline');
            $image_url = $request->getParam('image_url');
            $content = $request->getParam('content');
            $author = $token->data->username;

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