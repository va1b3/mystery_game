<?php

isset($_SERVER['HTTP_X_REQUESTED_WITH']) ?: exit(http_response_code(404));

require_once __DIR__ . '/../config.php';


if (!isset($_GET['name']) || strlen($_GET['name']) == 0 || strlen($_GET['name']) > 15) {
    exit(http_response_code(400));
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
$stmt->execute([$_GET['name']]);
$id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
if ($stmt->rowCount() == 0) {
    $stmt = $pdo->prepare('INSERT INTO users (name, score, date) VALUES (?, ?, ?)');
    $stmt->execute([$_GET['name'], 0, date('Y-m-d H:i:s')]);
    $id = $pdo->lastInsertId();
}

$_SESSION['name'] = $_GET['name'];
$_SESSION['id'] = $id;
