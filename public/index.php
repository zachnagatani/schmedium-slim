<?php
    // Load dependencies from vendor
    require '../vendor/autoload.php';

    $container = new \Slim\Container;
    // Create new slim app
    $app = new \Slim\App($container);

    // Create new DIC for views
    $container = $app->getContainer();
    $container['view'] = new \Slim\Views\PhpRenderer("../templates/");

    // Models
    require_once('../app/models/post.php');

    // Services
    require_once('../app/services/authorization.php');
    require_once('../app/services/authentication.php');
    require_once('../app/services/signup.php');

    // DB connection
    require_once('../app/db.php');

    // API hooks
    require_once('../app/api/posts/posts.php');
    require_once('../app/api/auth/auth.php');

    // Route hooks
    require_once('../app/routes/index.php');
    require_once('../app/routes/post.php');
    require_once('../app/routes/create.php');
    require_once('../app/routes/author.php');

    $app->run();
?>