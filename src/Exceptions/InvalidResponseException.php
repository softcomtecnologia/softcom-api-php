<?php

namespace Softcomtecnologia\Api\Exceptions;

class InvalidResponseException extends \Exception
{
    protected $requestParams = [];


    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        if (is_array($message)) {
            $this->requestParams = $message;
        }

        if (isset($this->requestParams['message'])) {
            $message = $this->requestParams['message'];
        }

        if (!$code && isset($this->requestParams['code'])) {
            $code = $this->requestParams['code'];
        }

        parent::__construct($message, $code, $previous);
    }


    /**
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }


    public function getRequestParamsFromString()
    {
        return json_encode($this->requestParams);
    }
}