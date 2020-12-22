<?php

namespace Luft\ApiClient;

use GuzzleHttp\Exception\GuzzleException;
use Luft\HttpClient\HttpClient;
use Luft\HttpClient\HttpClientInterface;
use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\Measurement;
use Luft\Models\Meta\Type;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
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
     * @throws GuzzleException
     * @throws ExceptionInterface
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
        $response = $this->httpClient->request(
            HttpClient::METHOD_GET,
            '/v2/installations/nearest',
            $this->headers,
            $queryParams
        );
        $body = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($body, Installation::class . '[]', 'json');
    }

    /**
     * @param int $installationId
     * @return Installation
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getInstallation(int $installationId): Installation
    {
        $response = $this->httpClient->request(
            HttpClient::METHOD_GET,
            '/v2/installations/' . $installationId,
            $this->headers
        );
        $body = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($body, Installation::class, 'json');
    }

    /**
     * @param int $installationId
     * @param bool|null $includeWind
     * @param string|null $indexType
     * @return Measurement
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getMeasurementsForInstallation(
        int $installationId,
        ?bool $includeWind = null,
        ?string $indexType = null
    ): Measurement {
        $queryParams = [
            'installationId' => $installationId,
            'includeWind' => $includeWind,
            'indexType' => $indexType
        ];

        $response = $this->httpClient->request(
            HttpClient::METHOD_GET,
            '/v2/measurements/installation',
            $this->headers,
            $queryParams
        );
        $body = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($body, Measurement::class, 'json');
    }

    /**
     * @param float $lat
     * @param float $lng
     * @param float|null $maxDistanceKM
     * @param string|null $indexType
     * @return Measurement
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getMeasurementsNearest(
        float $lat,
        float $lng,
        ?float $maxDistanceKM = null,
        ?string $indexType = null
    ): Measurement {
        $queryParams = [
            'lat' => $lat,
            'lng' => $lng,
            'maxDistanceKM' => $maxDistanceKM,
            'indexType' => $indexType
        ];
        $response = $this->httpClient->request(
            HttpClient::METHOD_GET,
            '/v2/measurements/nearest',
            $this->headers,
            $queryParams
        );
        $body = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($body, Measurement::class, 'json');
    }

    public function getMeasurementsPoint(
        float $lat,
        float $lng,
        ?string $indexType = null
    ): Measurement {
        $queryParams = [
            'lat' => $lat,
            'lng' => $lng,
            'indexType' => $indexType
        ];
        $response = $this->httpClient->request(
            HttpClient::METHOD_GET,
            '/v2/measurements/point',
            $this->headers,
            $queryParams
        );
        $body = json_decode($response->getBody(), true);

        return $this->serializer->denormalize($body, Measurement::class, 'json');
    }

    /**
     * @return array|object
     * @throws GuzzleException
     * @throws ExceptionInterface
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
