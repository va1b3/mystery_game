<?php

require_once __DIR__.'/src/config.php';
require_once __DIR__ . '/src/pages/' . (isset($_SESSION['id']) ? 'main' : 'login') . '.php';
