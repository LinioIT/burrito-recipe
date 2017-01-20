<?php

use Linio\Tortilla\Application;

define('ROOT', __DIR__ . '/..');
define('APP_DIR', ROOT . '/app');
define('APP_ID', getenv('APP_ID'));

require_once ROOT . '/vendor/autoload.php';

if (file_exists(ROOT . '/.env')) {
    (new Dotenv\Dotenv(ROOT))->load();
}

// Application setup
$app = new Application();
$app['debug'] = getenv('DEBUG') ?? $debug ?? false;

// Configuration
$config = require_once APP_DIR . '/config.php';
$app['config'] = APP_ID ? array_merge_recursive($config, require_once(APP_DIR . '/' . APP_ID . '/config.php')) : $config;

require APP_DIR . '/services.php';
require APP_DIR . '/routing.php';

if (APP_ID) {
    require APP_DIR . '/' . APP_ID . '/services.php';
}

return $app;
