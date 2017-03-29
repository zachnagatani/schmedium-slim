<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/posts', function(Request $request, Response $response) {
        try {
            // Connect to the database
            $db = Db::connect();
            // Make a query to the db for all posts
            $stmt = $db->query("SELECT * FROM posts");
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Close the db connection
            $db = null;

            // Respond with the posts in json format
            return $response->withJson($posts);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });

    $app->get('/api/posts/{id}', function(Request $request, Response $response) {
        try {
            // Grab the id parameter
            $id = $request->getAttribute("id");
            // Connect to the db and query for single post
            $db = Db::connect();
            $stmt = $db->query("SELECT *
                                FROM posts
                                WHERE id = $id");
            $posts = $stmt->fetch(PDO::FETCH_OBJ);
            // Close the db connection
            $db = null;

            // Respond with the post
            return $response->withJson($posts);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>