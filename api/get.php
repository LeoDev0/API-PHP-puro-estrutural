<?php

require('../database_config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get') {

    $id = FILTER_INPUT(INPUT_GET, 'id');

    if ($id) {
        $sql = "SELECT * FROM notes WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $result = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body'],
            ];

        } else {
            http_response_code(400);
            $result = [
                'error' => 'ID Not Found'
            ];
        }

    } else {
        http_response_code(400);
        $result = [
            'error' => 'No ID was sent'
        ];
    }

} else {
    http_response_code(405);
    $result = [
        'error' => 'Method Not Allowed (GET only)'
    ];
}

echo json_encode($result);

require('../headers.php');