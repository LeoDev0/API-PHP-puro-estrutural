<?php

require('../database_config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'put') {

    parse_str(file_get_contents('php://input'), $input);
    // json_decode($input, true);
    // json_decode(file_get_contents('php://input'), true);
    // json_decode(parse_str(file_get_contents('php://input'), $input));

    // $id = !empty($input['id']) ? $input['id']: null;
    $id = $input['id'] ?? null;
    $title = $input['title'] ?? null;
    $body = $input['body'] ?? null;

    $id = filter_var($id);
    $title = filter_var($title);
    $body = filter_var($body);

    if ($id && $title && $body) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("UPDATE notes SET
                title = :title, 
                body = :body 
                WHERE id = :id");
            
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            http_response_code(200);
            $result = [
                'id' => $id,
                'title' => $title,
                'body' => $body,
            ];

        } else {
            http_response_code(404);
            $result = [
                'error' => 'ID does not exists'
            ];
        }


    } else {
        http_response_code(400);
        $result = [
            'error' => 'Data is missing.'
        ];
    }
    
} else {
    http_response_code(405);
    $result = [
        'error' => 'Method Not Allowed (PUT only)'
    ];
}

echo json_encode($result);

require('../headers.php');