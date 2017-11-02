# Softcom Api PHP

Pacote destinado a prover uma abstração para integração de recursos da API Softcom

# Instalação

Este pacote é facilmente instalado via Composer.
Basta adicionar o trecho de código abaixo ao arquivo composer.json que encontra-se em seu projeto:

```php
    {
        "require": {
            "softcomtecnologia/softcom-api-php": "*"
        }
    }
```

# Exemplo de Uso

## Obtendo Token

```php
    $options = [
        'domain'        => 'http://<url-softcom>/softauth',
        'clientId'      => '<your-client-id>',
        'clientSecret'  => '<your-client-secret>',
        'deviceId'      => '<your-device-id>',
        'deviceName'    => '<name-for-your-device>',
    ];
    
    $provider = new SoftcomProvider($options);
    $token = $provider->getAccessToken(new SoftcomCredentials());
    
    echo $token;//your token ex.: 301b7689eb926495a02fe4ba4932d7bfa80aa202
```

## Realizando uma Request

### GET

```php
    $options = [...];
    $provider = new SoftcomProvider($options);
    $token = 'your-token-string';//or SoftcomAccessToken object
    $url = '/api/example';//without domain
    $params = [
        'key' => 'value',
        //...
    ];
    
    $resource = $provider->get($token, $url, $params);
    
    echo json_decode($resource->getContents(), 1);
    /*
     * [
     *      "code" => 1,
     *      "message" => "OK",
     *      "human" => "Sucesso",
     *      "data" => [
     *          "username" => "my username",
     *          "name" => "softcom",
     *      ],
     *      "meta" => []
     * ]
     */
```


### POST

```php
    $options = [...];
    $provider = new SoftcomProvider($options);
    $token = 'your-token-string';//or SoftcomAccessToken object
    $url = '/api/example';//without domain
    $params = [
        'key' => 'value',
        //...
    ];
    
    $resource = $provider->post($token, $url, $params);
    
    echo json_decode($resource->getContents(), 1);
    /*
     * [
     *      "code" => 1,
     *      "message" => "OK",
     *      "human" => "Sucesso",
     *      "data" => [
     *          "username" => "my username",
     *          "name" => "softcom",
     *      ],
     *      "meta" => []
     * ]
     */
```
