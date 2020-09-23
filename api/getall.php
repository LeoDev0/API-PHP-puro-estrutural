<?php
require('../database_config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get') {
    $sql = $pdo->query('SELECT * FROM notes');

    if ($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $item) {
            $result[] = [
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body'],
            ];
        }
    }

} else {
    http_response_code(405);
    $result = [
        'error' => 'Method Not Allowed (GET only)'
    ];
}

// echo json_encode($result, JSON_UNESCAPED_UNICODE);
echo json_encode($result);

require('../headers.php');
