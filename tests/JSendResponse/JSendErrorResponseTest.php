<?php

namespace Tests\JSendResponse;

use ArrayObject;
use Junker\JSendResponse\Exceptions\JSendSpecificationViolation;
use Junker\JSendResponse\JSendErrorResponse;
use Junker\JSendResponse\JSendFailResponse;
use Junker\JSendResponse\JSendResponse;
use Junker\JSendResponse\JSendSuccessResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JSendErrorResponseTest extends TestCase
{
    public function testInstantiation()
    {
        $response = new JSendErrorResponse('message');

        self::assertEquals('{"status":"error","message":"message"}', $response->getContent());
    }

    public function testInstantiationWithCode()
    {
        $response = new JSendErrorResponse('message', 123);

        self::assertEquals('{"status":"error","message":"message","code":123}', $response->getContent());
    }

    public function testInstantiationWithData()
    {
        $response = new JSendErrorResponse('message', null, 'data');

        self::assertEquals('{"status":"error","data":"data","message":"message"}', $response->getContent());
    }

    public function testDefaultHttpStatusCode()
    {
        $response = new JSendErrorResponse('message');

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testCustomHttpStatusCode()
    {
        $response = new JSendErrorResponse('message', null, null, Response::HTTP_BAD_GATEWAY);

        self::assertEquals(Response::HTTP_BAD_GATEWAY, $response->getStatusCode());
    }

    public function testCustomHttpHeader()
    {
        $response = new JSendErrorResponse('message', null, null, Response::HTTP_BAD_GATEWAY, [
            'x-custom-header' => 'test'
        ]);

        self::assertEquals('test', $response->headers->get('x-custom-header'));
    }
}
