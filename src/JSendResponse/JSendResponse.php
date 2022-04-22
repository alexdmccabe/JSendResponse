<?php

namespace Junker\JSendResponse;

use ArrayObject;
use Junker\JSendResponse\Exceptions\JSendSpecificationViolation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class JSendResponse
 *
 * JSendResponse represents an HTTP response in JSON format that follows the JSend specification.
 *
 * @package Junker\JsendResponse
 */
class JSendResponse extends JsonResponse
{
    /**
     * Should be used to set the status as "success".
     */
    const SUCCESS_STATUS = 'success';

    /**
     * Should be used to set the status as "fail".
     */
    const FAIL_STATUS = 'fail';

    /**
     * Should be used to set the status as "error".
     */
    const ERROR_STATUS = 'error';

    /**
     * @throws JSendSpecificationViolation
     */
    public function __construct(string $status, $data = null, ?string $message = null, ?int $code = null, int $httpStatus = 200, array $headers = [])
    {
        // ensures that the passed JSend status is valid
        if (!$this->isStatusValid($status)) {
            throw new JSendSpecificationViolation('The passed "status" is not valid: ' . $status);
        }

        $content = [
            'status' => $status
        ];

        // the "data" key is required for these statuses
        if ($status === self::SUCCESS_STATUS || $status === self::FAIL_STATUS) {
            $content['data'] = $data;
        }

        if ($status === self::ERROR_STATUS) {
            // ensures that "message" is set for this status
            if (!$message) {
                throw new JSendSpecificationViolation('The "message" key is required');
            }

            // the "data" key is optional for this status, so we only add it if set
            if (isset($data)) {
                $content['data'] = $data;
            }

            $content['message'] = $message;

            // adds the "code" key only if it's set (because it's optional)
            if ($code) {
                $content['code'] = $code;
            }
        } else {
            if ($message) {
                throw new JSendSpecificationViolation('The "message" is only allowed if the status is "error".');
            }

            if ($code) {
                throw new JSendSpecificationViolation('The "code" is only allowed if the status is "error".');
            }
        }

        parent::__construct($content, $httpStatus, $headers);
    }

    /**
     * Ensures that the passed status is valid.
     */
    private function isStatusValid(string $status): bool
    {
        $validStatuses = [self::SUCCESS_STATUS, self::FAIL_STATUS, self::ERROR_STATUS];

        return in_array($status, $validStatuses);
    }

    /**
     * Sets the JSend status (success, fail or error).
     *
     * @throws JSendSpecificationViolation
     */
    public function setStatus(string $status): self
    {
        // ensures that the passed JSend status is valid
        if (!$this->isStatusValid($status)) {
            throw new JSendSpecificationViolation('The passed "status" is not valid: ' . $status);
        }

        $jsend = json_decode($this->data, true);

        $jsend['status'] = $status;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the JSend data.
     */
    public function setJSendData($data = null): self
    {
        $jsend = json_decode($this->data, true);

        $jsend['data'] = $data;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the message.
     *
     * @throws JSendSpecificationViolation
     */
    public function setMessage(string $message): self
    {
        $jsend = json_decode($this->data, true);

        // ensures that the status is "error"
        if (isset($jsend['status']) && $jsend['status'] !== self::ERROR_STATUS) {
            throw new JSendSpecificationViolation('The "message" key is not allowed for responses with a status other than "error"');
        }

        $jsend['message'] = $message;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the JSend code.
     *
     * @throws JSendSpecificationViolation
     */
    public function setCode(int $code): self
    {
        $jsend = json_decode($this->data, true);

        // ensures that the status is "error"
        if (isset($jsend['status']) && $jsend['status'] !== self::ERROR_STATUS) {
            throw new JSendSpecificationViolation('The "code" key is not allowed for responses with a status other than "error"');
        }

        $jsend['code'] = $code;

        $this->setData($jsend);

        return $this;
    }
}
