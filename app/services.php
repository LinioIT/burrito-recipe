<?php

// Base application service definition

use Linio\Component\Microlog\Log;
use Linio\Tortilla\Event\RequestEvent;
use Linio\Tortilla\Event\ResponseEvent;

// Logging
$app->register(new Linio\Tortilla\Provider\MonologServiceProvider(), [
    'monolog.logfile' => $app['config']['log']['logfile'],
    'monolog.name' => $app['config']['log']['name'],
    'monolog.formatter' => new Linio\Tortilla\Log\Formatter\JsonFormatter(),
]);

Log::setLoggerForChannel($app['logger'], Log::DEFAULT_CHANNEL);

// Event Listeners
$app['application.listener.request_identifier'] = function () {
    return new Linio\Tortilla\Listener\RequestIdentifier();
};

$app['application.listener.request_response_logger'] = function () {
    return new Linio\Tortilla\Listener\RequestResponseLogger();
};

$app['event.dispatcher']->addListener(RequestEvent::NAME, [$app['application.listener.request_identifier'], 'onRequest'], 100);
$app['event.dispatcher']->addListener(ResponseEvent::NAME, [$app['application.listener.request_identifier'], 'onResponse'], 100);
$app['event.dispatcher']->addListener(RequestEvent::NAME, [$app['application.listener.request_response_logger'], 'onRequest']);
$app['event.dispatcher']->addListener(ResponseEvent::NAME, [$app['application.listener.request_response_logger'], 'onResponse']);

// Controller definitions
$app['controller.default'] = function () {
    return new Acme\Api\Controller\DefaultController();
};
