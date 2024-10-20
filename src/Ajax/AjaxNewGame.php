<?php

isset($_SERVER['HTTP_X_REQUESTED_WITH']) ?: exit(http_response_code(404));

require_once __DIR__ . '/../config.php';


$stmt = $pdo->prepare('DELETE FROM games WHERE user_id = ?');
$stmt->execute([$_SESSION['id']]);
