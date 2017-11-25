<?php

namespace Softcomtecnologia\Api\Token;

use League\OAuth2\Client\Token\AccessToken;

class SoftcomAccessToken extends AccessToken
{
    /**
     * @var string
     */
    public $type = 'Bearer';

    /**
     * @var string|null
     */
    public $scope;


    /**
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        $options = $options ?: [];

        if (isset($options['data'])) {
            $options = $options['data'];
        }

        $this->defineType($options);
        $this->defineScope($options);
        $this->defineAccessToken($options);
        $this->defineExpires($options);
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->accessToken}";
    }


    /**
     * @param array $options
     *
     * @return $this
     */
    protected function defineAccessToken(array $options)
    {
        if (isset($options['access_token'])) {
            $this->accessToken = $options['access_token'];
        }

        if (isset($options['token'])) {
            $this->accessToken = $options['token'];
        }

        return $this;
    }


    /**
     * @param array $options
     *
     * @return $this
     */
    protected function defineExpires(array $options)
    {
        if (isset($options['expires_in'])) {
            $this->expires = time() + ((int)$options['expires_in']);
        }

        if (isset($options['expires'])) {
            $expires = $options['expires'];
            $expiresInFuture = $expires > time();
            $this->expires = $expiresInFuture ? $expires : time() + ((int)$expires);
        }

        return $this;
    }


    /**
     * @param array $options
     *
     * @return $this
     */
    protected function defineScope(array $options)
    {
        if (isset($options['scope'])) {
            $this->type = $options['scope'];
        }

        return $this;
    }


    /**
     * @param array $options
     *
     * @return $this
     */
    protected function defineType(array $options)
    {
        if (isset($options['type'])) {
            $this->type = $options['type'];
        }

        return $this;
    }
}
