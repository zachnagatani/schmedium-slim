<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/post/{id}', function(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        // TODO: Extract into class or function
        // Call internal api to grab posts and pass them into view
        $curl = curl_init('schmedium-slim/api/posts/' . $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            $err = array("info" => $info);
            return $response->withJson($err);
        } else {
            $post = json_decode($curl_response);
            $response = $this->view->render($response, "post.php", ["post" => $post]);
            return $response;
        }
    });
?>