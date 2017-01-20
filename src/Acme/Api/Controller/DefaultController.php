<?php

namespace Acme\Api\Controller;

use Linio\Component\Microlog\Log;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function indexAction(Request $request, string $name): Response
    {
        Log::info('hello world ' . $request->headers->get('X-Request-ID'));

        return new Response('Hello ' . $name);
    }
}
