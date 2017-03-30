<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/', function(Request $request, Response $response) {
        // TODO: Extract into class or function
        // Call internal api to grab posts and pass them into view
        $curl = curl_init('schmedium-slim/api/posts');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            $err = array("info" => $info);
            return $response->withJson($err);
        } else {
            $decoded = json_decode($curl_response);
            $posts = array_chunk($decoded, 5);
        }

        $response = $this->view->render($response, "index.php", ["posts" => $posts]);
        return $response;
    });
?>