<?php

namespace Luft\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class HttpClient implements HttpClientInterface
{
    private const BASE_URI = 'https://airapi.airly.eu';

    public const METHOD_GET = 'GET';

    /**
     * @var Client
     */
    private $client;

    public function __construct($handler = null)
    {
        $config = [
            'base_uri' => self::BASE_URI
        ];

        if ($handler) {
            $config['handler'] = HandlerStack::create($handler);
        }

        $this->client = new Client($config);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $headers
     * @param array $queryStringParams
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $endpoint, array $headers = [], array $queryStringParams = [])
    {
        return $this->client->request($method, $endpoint, ['headers' => $headers, 'query' => $queryStringParams]);
    }
}