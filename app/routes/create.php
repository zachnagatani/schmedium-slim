<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/create', function(Request $request, Response $response) {
        $response = $this->view->render($response, "create.php", []);
        return $response;
    });
?>