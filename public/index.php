<?php
    // Load dependencies from vendor
    require '../vendor/autoload.php';
    // Create new slim app
    $app = new \Slim\App;

    // Create new DIC for views
    $container = $app->getContainer();
    $container['view'] = new \Slim\Views\PhpRenderer("../templates/");

    // DB connection
    require_once('../app/db.php');
    // API hooks
    require_once('../app/api/posts/posts.php');
    require_once('../app/api/auth/auth.php');
    // Route hooks
    require_once('../app/routes/index.php');
    require_once('../app/routes/post.php');

    $app->run();
?>