<?php

namespace Junker\JSendResponse;

/**
 * Class JSendSuccessResponse
 *
 * JSendSuccessResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "success".
 *
 * @package Junker\JsendResponse
 */
class JSendSuccessResponse extends JSendResponse
{
    /**
     * JSendSuccessResponse constructor.
     *
     * @param mixed $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct($data = null, int $httpStatus = 200, array $headers = [])
    {
        parent::__construct(self::SUCCESS_STATUS, $data, null, null, $httpStatus, $headers);
    }
}
