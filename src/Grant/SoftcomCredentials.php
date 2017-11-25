<?php

namespace Softcomtecnologia\Api\Grant;

use League\OAuth2\Client\Grant\GrantInterface;
use Softcomtecnologia\Api\Token\SoftcomAccessToken;
use Softcomtecnologia\Api\Exceptions\InvalidResponseException;

class SoftcomCredentials implements GrantInterface
{

    /**
     * @return string
     */
    public function __toString()
    {
        return 'client_credentials';
    }


    /**
     * @param array $response
     *
     * @return SoftcomAccessToken
     * @throws InvalidResponseException
     */
    public function handleResponse($response = [])
    {
        if (isset($response['code']) && $response['code'] != 1) {
            throw new InvalidResponseException($response);
        }

        return new SoftcomAccessToken($response);
    }


    /**
     * @param $defaultParams
     * @param $params
     *
     * @return array
     */
    public function prepRequestParams($defaultParams, $params)
    {
        $params['grant_type'] = (string)$this;

        return $params + $defaultParams;
    }
}
