<?php

namespace Tests\JSendResponse;

use ArrayObject;
use Junker\JSendResponse\Exceptions\JSendSpecificationViolation;
use Junker\JSendResponse\JSendFailResponse;
use Junker\JSendResponse\JSendResponse;
use Junker\JSendResponse\JSendSuccessResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JSendFailResponseTest extends TestCase
{
    public function testInstantiation()
    {
        $response = new JSendFailResponse();

        self::assertEquals('{"status":"fail","data":null}', $response->getContent());
    }

    public function testInstantiationWithData()
    {
        $response = new JSendFailResponse('data');

        self::assertEquals('{"status":"fail","data":"data"}', $response->getContent());
    }

    public function testDefaultHttpStatusCode()
    {
        $response = new JSendFailResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCustomHttpStatusCode()
    {
        $response = new JSendFailResponse(null, Response::HTTP_NOT_FOUND);

        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testCustomHttpHeader()
    {
        $response = new JSendFailResponse('message', Response::HTTP_BAD_REQUEST, [
            'x-custom-header' => 'test'
        ]);

        self::assertEquals('test', $response->headers->get('x-custom-header'));
    }
}
