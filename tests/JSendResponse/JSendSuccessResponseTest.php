<?php

namespace Tests\JSendResponse;

use ArrayObject;
use Junker\JSendResponse\Exceptions\JSendSpecificationViolation;
use Junker\JSendResponse\JSendResponse;
use Junker\JSendResponse\JSendSuccessResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JSendSuccessResponseTest extends TestCase
{
    public function testInstantiation()
    {
        $response = new JSendSuccessResponse();

        self::assertEquals('{"status":"success","data":null}', $response->getContent());
    }

    public function testInstantiationWithData()
    {
        $response = new JSendSuccessResponse('data');

        self::assertEquals('{"status":"success","data":"data"}', $response->getContent());
    }

    public function testDefaultHttpStatusCode()
    {
        $response = new JSendSuccessResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testCustomHttpStatusCode()
    {
        $response = new JSendSuccessResponse(null, Response::HTTP_CREATED);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testCustomHttpHeader()
    {
        $response = new JSendSuccessResponse(null, Response::HTTP_OK, [
            'x-custom-header' => 'test'
        ]);

        self::assertEquals('test', $response->headers->get('x-custom-header'));
    }
}
