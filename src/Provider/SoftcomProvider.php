<?php

namespace Softcomtecnologia\Api\Provider;

use Guzzle\Http\Client;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\AbstractProvider;
use Softcomtecnologia\Api\Token\SoftcomAccessToken;

class SoftcomProvider extends AbstractProvider
{

    /**
     * @var string
     */
    public $responseType = 'json';

    /**
     * @var string
     */
    public $authorizationHeader = 'Bearer';

    /**
     * @var string
     */
    public $domain = 'http://softcomtecnologia/softauth';


    /**
     * @return string
     */
    public function urlAuthorize()
    {
        return $this->domain . '/device/add';
    }


    /**
     * @return string
     */
    public function urlAccessToken()
    {
        return $this->domain . '/authentication/token';
    }


    /**
     * @param AccessToken $token
     *
     * @return string
     */
    public function urlUserDetails(AccessToken $token)
    {
        return $this->domain . '/autentication/details';
    }


    /**
     * @param object      $response
     * @param AccessToken $token
     *
     * @return mixed
     * @throws \Exception
     */
    public function userDetails($response, AccessToken $token)
    {
        throw new \Exception('Method not yet implemented');
    }


    /**
     * @param       $token
     * @param       $url
     * @param array $params
     *
     * @return \GuzzleHttp\Stream\StreamInterface|null
     */
    public function post($token, $url, array $params = [])
    {
        $client = $this->client($token);
        $request = $client->post(
            $this->urlResource($url),
            $params ? ['body' => $params] : []
        );

        return $request->getBody();
    }


    /**
     * @param       $token
     * @param       $url
     * @param array $params
     *
     * @return \GuzzleHttp\Stream\StreamInterface|null
     */
    public function get($token, $url, array $params = [])
    {
        $client = $this->client($token);
        $request = $client->get(
            $this->urlResource($url),
            ['query' => $params]
        );

        return $request->getBody();
    }


    /**
     * @param string|SoftcomAccessToken $token
     *
     * @return Client
     * @throws \Exception
     */
    protected function client($token)
    {
        $token = $this->token($token);
        $client = new Client();
        $client->setDefaultOption(
            'headers',
            ['Authorization' => ["{$token->type} {$token->accessToken}"]]
        );

        return $client;
    }


    /**
     * @param string|SoftcomAccessToken $token
     *
     * @return SoftcomAccessToken
     * @throws \Exception
     */
    protected function token($token)
    {
        if (is_string($token)) {
            $token = new SoftcomAccessToken(['access_token' => $token, 'type' => 'Bearer']);
        }

        if (!$token instanceof AccessToken) {
            throw new \Exception('The token is not valid');
        }

        return $token;
    }


    /**
     * @param $resourceName
     *
     * @return string
     */
    public function urlResource($resourceName)
    {
        return "{$this->domain}/{$resourceName}";
    }
}
