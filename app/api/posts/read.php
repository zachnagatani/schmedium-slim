<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/posts', function(Request $request, Response $response) {
        try {
            // Connect to the database
            $db = Db::connect();
            // SQL for prepared statement
            $prepared_sql = "SELECT *
                             FROM posts
                             ORDER BY updated_at DESC";
            $stmt = $db->prepare($prepared_sql);

            // Execute the statement
            $stmt->execute();

            // Grab the posts
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
            // Connect to the db and query for single post
            $db = Db::connect();

            // Prepare
            $prepared_sql = "SELECT *
                             FROM posts
                             WHERE id = :id";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam('id', $id);
            $id = $request->getAttribute('id');

            // Execute
            $stmt->execute();

            // Grab the post
            $post = $stmt->fetch(PDO::FETCH_OBJ);

            // Close the db connection
            $db = null;

            // Respond with the post
            return $response->withJson($post);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });

    // For all of a user's posts
    $app->get('/api/posts/read/{author}', function(Request $request, Response $response) {
        try {
            // Connect to the db and query for single post
            $db = Db::connect();

            // Prepare
            $prepared_sql = "SELECT *
                             FROM posts
                             WHERE author = :author";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam('author', $author);
            $author = $request->getAttribute('author');

            // Execute
            $stmt->execute();

            // Grab the post
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

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