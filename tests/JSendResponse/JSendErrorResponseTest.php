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
        $response = new JSendErrorResponse('test');

        self::assertEquals('{"status":"error","message":"test"}', $response->getContent());
    }

    public function testInstantiationWithCode()
    {
        $response = new JSendErrorResponse('test', 123);

        self::assertEquals('{"status":"error","message":"test","code":123}', $response->getContent());
    }

    public function testInstantiationWithData()
    {
        $response = new JSendErrorResponse('test', null, 'test');

        self::assertEquals('{"status":"error","data":"test","message":"test"}', $response->getContent());
    }

    public function testDefaultHttpStatusCode()
    {
        $response = new JSendErrorResponse('test');

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testCustomHttpStatusCode()
    {
        $response = new JSendErrorResponse('test', null, null, Response::HTTP_BAD_GATEWAY);

        self::assertEquals(Response::HTTP_BAD_GATEWAY, $response->getStatusCode());
    }
}
