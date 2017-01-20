<?php

$debug = false;

try {
    $app = require_once __DIR__ . '/../app/bootstrap.php';
    $app->run();
} catch (\Throwable $exception) {
    syslog(600, (string) $exception);
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => ['message' => 'Internal error', 'code' => 500]]);
}
