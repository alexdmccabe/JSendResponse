<?php

namespace Junker\JSendResponse;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class JSendFailResponse
 *
 * JSendFailResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "fail".
 *
 * @package Junker\Symfony
 */
class JSendFailResponse extends JSendResponse
{
    /**
     * JSendFailResponse constructor.
     *
     * @param mixed $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct($data = null, int $httpStatus = Response::HTTP_BAD_REQUEST, array $headers = [])
    {
        parent::__construct(self::FAIL_STATUS, $data, null, null, $httpStatus, $headers);
    }
}
