<?php

require('../database_config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'delete') {
    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null; 
    $id = filter_var($id);

    if ($id) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            http_response_code(204);

        } else {
            http_response_code(404);
              $result = [
                  'error' => 'ID does not exists'
              ];
        }

    } else {

        http_response_code(400);
        $result = [
          'error' => 'ID is missing.'
        ];
    }

} else {
    http_response_code(405);
    $result = [
      'error' => 'Method Not Allowed (DELETE only)'
    ];
}

echo json_encode($result);

require('../headers.php');
