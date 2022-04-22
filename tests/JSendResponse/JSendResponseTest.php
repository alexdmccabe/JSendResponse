<?php

namespace Tests\JSendResponse;

use Junker\JSendResponse\Exceptions\JSendSpecificationViolation;
use Junker\JSendResponse\JSendResponse;
use PHPUnit\Framework\TestCase;

class JSendResponseTest extends TestCase
{
    public function testInvalidStatus()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse('invalid status');
    }

    public function testInvalidStatusUsingSetter()
    {
        self::expectException(JSendSpecificationViolation::class);

        $response = new JSendResponse(JSendResponse::SUCCESS_STATUS);

        $response->setJSendStatus('invalid status');
    }

    public function testErrorStatusWithoutMessage()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse(JSendResponse::ERROR_STATUS);
    }

    public function testDisallowedMessageWithSuccessStatus()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse(JSendResponse::SUCCESS_STATUS, null, 'message');
    }

    public function testDisallowedMessageWithFailStatus()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse(JSendResponse::FAIL_STATUS, null, 'message');
    }

    public function testDisallowedMessageWithSuccessStatusUsingSetter()
    {
        self::expectException(JSendSpecificationViolation::class);

        $response = new JSendResponse(JSendResponse::SUCCESS_STATUS);

        $response->setJSendMessage('message');
    }

    public function testDisallowedMessageWithFailStatusUsingSetter()
    {
        self::expectException(JSendSpecificationViolation::class);

        $response = new JSendResponse(JSendResponse::FAIL_STATUS);

        $response->setJSendMessage('message');
    }

    public function testDisallowedCodeWithSuccessStatus()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse(JSendResponse::SUCCESS_STATUS, null, null, 123);
    }

    public function testDisallowedCodeWithFailStatus()
    {
        self::expectException(JSendSpecificationViolation::class);

        new JSendResponse(JSendResponse::FAIL_STATUS, null, null, 123);
    }

    public function testSetJSendData()
    {
        $response = new JSendResponse(JSendResponse::SUCCESS_STATUS);

        $response->setJSendData('data');

        self::assertEquals('{"status":"success","data":"data"}', $response->getContent());
    }

    public function testSetJSendMessage()
    {
        $response = new JSendResponse(JSendResponse::ERROR_STATUS, null, 'message', 123);

        $response->setJSendMessage('message using setter');

        self::assertEquals('{"status":"error","message":"message using setter","code":123}', $response->getContent());
    }

    public function testSetJSendCode()
    {
        $response = new JSendResponse(JSendResponse::ERROR_STATUS, null, 'message', 123);

        $response->setJSendCode(456);

        self::assertEquals('{"status":"error","message":"message","code":456}', $response->getContent());
    }
}
