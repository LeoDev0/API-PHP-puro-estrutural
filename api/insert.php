<?php

require('../database_config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {

    // $title = filter_input(INPUT_POST, 'title');
    // $body = filter_input(INPUT_POST, 'body');

    // Pega o valor em formato de json do corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    $title = $data['title'];
    $body = $data['body'];

    if ($title && $body) {

        $sql = $pdo->prepare("INSERT INTO notes VALUES (DEFAULT, :title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $result = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];

    } else {
        http_response_code(400);
        $result = [
            'error' => 'Bad Request (title or body is missing)'
        ];
    }

} else {
    http_response_code(405);
    $result = [
        'error' => 'Method Not Allowed (POST only)'
    ];
}

echo json_encode($result);

require('../headers.php');
