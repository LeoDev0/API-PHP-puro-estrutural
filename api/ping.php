<?php

require('../database_config.php');

$result = [
    'pong' => true,
    'email' => 'leo.80@protonmail.com',
];

echo json_encode($result);

require('../headers.php');