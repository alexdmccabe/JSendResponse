<?php

namespace Junker\JSendResponse;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class JSendErrorResponse
 *
 * JSendErrorResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "error".
 *
 * @package Junker\JsendResponse
 */
class JSendErrorResponse extends JSendResponse
{
    /**
     * JSendErrorResponse constructor.
     *
     * @param string $message
     * @param int|null $code
     * @param mixed $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct(string $message, ?int $code = null, $data = null, int $httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = [])
    {
        parent::__construct(self::ERROR_STATUS, $data, $message, $code, $httpStatus, $headers);
    }
}
