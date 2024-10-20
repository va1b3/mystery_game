<?php

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__ . '/../')->load();

session_start();
date_default_timezone_set($_ENV['TIMEZONE']);

$pdo = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8', 
        $_ENV['DB_USER'], $_ENV['DB_PASS']);
