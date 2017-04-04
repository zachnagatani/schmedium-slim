<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/{author}', function(Request $request, Response $response) {
        $author = $request->getAttribute('author');
        // TODO: Extract into class or function
        // Call internal api to grab posts and pass them into view
        $curl = curl_init('schmedium-slim/api/posts/read/' . $author);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            $err = array("info" => $info);
            return $response->withJson($err);
        } else {
            $posts= json_decode($curl_response);
            $response = $this->view->render($response, "author.php", ["posts" => $posts, "author" => $author]);
            return $response;
        }
    });
?>