<?php
    require_once('../app/db.php');

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';

    $app = new \Slim\App;

    require_once('../app/api/posts/posts.php');
    // require_once('../app/api/auth/auth.php');

    $app->run();
?>