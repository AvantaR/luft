<?php

namespace Luft\ApiClient;

use Luft\HttpClient\HttpClient;
use Luft\HttpClient\HttpClientInterface;
use Luft\Models\Installation\Installation;
use Luft\Models\Meta\Type;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiClient
{

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(HttpClientInterface $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /**
     * @param float $lat
     * @param float $lng
     * @param float|null $maxDistanceKM
     * @param int|null $maxResults
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getInstallationsNearest(
        float $lat,
        float $lng,
        ?float $maxDistanceKM = null,
        ?int $maxResults = null
    ): array {
        $queryParams = [
            'lat' => $lat,
            'lng' => $lng,
            'maxDistanceKM' => $maxDistanceKM,
            'maxResults' => $maxResults
        ];
        $response = $this->httpClient->request('GET', '/v2/installations/nearest', $this->headers, $queryParams);
        $types = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($types, Installation::class . '[]', 'json');
    }

    /**
     * @return array|object
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getMetaIndexes()
    {
        $response = $this->httpClient->request('GET', '/v2/meta/indexes', $this->headers);
        $types = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($types, Type::class . '[]', 'json');
    }

    /**
     * @param array $headers
     * @return ApiClient
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}