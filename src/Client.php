<?php

namespace Luft;

use GuzzleHttp\Exception\GuzzleException;
use Luft\ApiClient\ApiClient;
use Luft\HttpClient\HttpClient;
use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\Measurement;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class Client
{
    /**
     * @var string
     */
    private $url = 'https://airapi.airly.eu';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $language = 'en';

    /**
     * @var array
     */
    private $headers;

    public function __construct(string $apiKey)
    {
        $httpClient = new HttpClient();
        $serializer = Serializer::getInstance();
        $this->apiKey = $apiKey;
        $this->client = new ApiClient($httpClient, $serializer);
        $this->setDefaultHeaders();
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
        $this->headers['Accept-Language'] = $this->language;
        $this->client->setHeaders($this->headers);
    }

    private function setDefaultHeaders(): void
    {
        $this->headers['Accept'] = 'application/json';
        $this->headers['Accept-Language'] = $this->language;
        $this->headers['apikey'] = $this->apiKey;
        $this->client->setHeaders($this->headers);
    }

    /**
     * @param float $lat
     * @param float $lng
     * @param float|null $maxDistanceKM
     * @param int|null $maxResults
     * @return array
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getInstallationsNearest(
        float $lat,
        float $lng,
        ?float $maxDistanceKM = null,
        ?int $maxResults = null
    ): array
    {
        return $this->client->getInstallationsNearest($lat, $lng, $maxDistanceKM, $maxResults);
    }

    /**
     * @param int $installationId
     * @return Installation
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getInstallation(int $installationId): Installation
    {
        $this->client->getInstallation($installationId);
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
    ): Measurement
    {
        $this->client->getMeasurementsForInstallation($installationId, $includeWind, $indexType);
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
    ): Measurement
    {
        $this->client->getMeasurementsNearest($lat, $lng, $maxDistanceKM, $indexType);
    }

    /**
     * @param float $lat
     * @param float $lng
     * @param string|null $indexType
     * @return Measurement
     * @throws ExceptionInterface
     */
    public function getMeasurementsPoint(
        float $lat,
        float $lng,
        ?string $indexType = null
    ): Measurement
    {
        $this->client->getMeasurementsPoint($lat, $lng, $indexType);
    }

    /**
     * @return array
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function getMetaIndexes(): array
    {
        return $this->client->getMetaIndexes();
    }
}
