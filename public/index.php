<?php
    require_once('../app/db.php');

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';

    $app = new \Slim\App;
    $app->get('/hello/{name}', function (Request $request, Response $response) {
        $db = new Db();
        $db->connect();
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    });

    require_once('../app/api/posts/posts.php');

    $app->run();
?>