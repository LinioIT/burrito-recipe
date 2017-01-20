<?php

namespace Acme\Api\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testIsShowingIndex()
    {
        $controller = new DefaultController();
        $response = $controller->indexAction(new Request(), 'world');

        $this->assertEquals('Hello world', $response->getContent());
    }
}
