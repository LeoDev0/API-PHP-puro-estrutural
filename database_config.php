<?php

$host = '127.0.0.1';
$db_name = 'devsnotes';
$db_user = 'leo';
$db_pass = 'leo123';
$dsn = "mysql:dbname=$db_name;host=$host;charset=utf8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $error) {
    die('Erro: ' . $error->getMessage());
}
