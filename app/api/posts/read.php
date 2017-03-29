<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/posts', function(Request $request, Response $response) {
        try {
            $db = Db::connect();
            $stmt = $db->query("SELECT * FROM posts");
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $response->withJson($posts);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });

    $app->get('/api/posts/{id}', function(Request $request, Response $response) {
        try {
            $id = $request->getAttribute("id");
            $db = Db::connect();
            $stmt = $db->query("SELECT *
                                FROM posts
                                WHERE id = $id");
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $response->withJson($posts);
        } catch (PDOException $e) {
            $err = array("error" => $e->getMessage());
            return $response->withJson($err);
        }
    });
?>