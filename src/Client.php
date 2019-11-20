<?php

namespace Luft;

use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\Measurement;
use Luft\Models\Meta\Type;
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
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url]);
        $this->apiKey = $apiKey;
        $this->setHeaders();
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
        $this->headers['Accept-Language'] = $this->language;
    }

    private function setHeaders(): void
    {
        $this->headers['Accept'] = 'application/json';
        $this->headers['Accept-Language'] = $this->language;
        $this->headers['apikey'] = $this->apiKey;
    }

    /**
     * @param float $lat
     * @param float $lng
     * @param float|null $maxDistance
     * @param int|null $maxResults
     * @return array
     * @throws ExceptionInterface
     */
    public function getInstallations(float $lat, float $lng, ?float $maxDistance = null, ?int $maxResults = null): array
    {
        $response = $this->client->get('/v2/installations/nearest',
            [
                'headers' => $this->headers,
                'query' =>
                    [
                        'lat' => $lat,
                        'lng' => $lng,
                        'maxDistance' => $maxDistance,
                        'maxResults' => $maxResults
                    ]
            ]
        );
        $types = json_decode($response->getBody(), true);

        return Serializer::getInstance()->denormalize($types, Installation::class . '[]', 'json');
    }

    /**
     * @param int $installationId
     * @return Installation
     * @throws ExceptionInterface
     */
    public function getInstallation(int $installationId): Installation
    {
        $response = $this->client->get('/v2/installations/' . $installationId, ['headers' => $this->headers]);
        $types = json_decode($response->getBody(), true);

        return Serializer::getInstance()->denormalize($types, Installation::class, 'json');
    }

    /**
     * @param int $installationId
     * @param bool|null $includeWind
     * @param string|null $indexType
     * @return Measurement
     * @throws ExceptionInterface
     */
    public function getMeasurementsForInstallation(
        int $installationId,
        ?bool $includeWind = null,
        ?string $indexType = null
    ): Measurement {
        $response = $this->client->get('/v2/measurements/installation', [
            'headers' => $this->headers,
            'query' =>
                [
                    'installationId' => $installationId,
                    'includeWind' => $includeWind,
                    'indexType' => $indexType
                ]
        ]);
        $types = json_decode($response->getBody(), true);

        return Serializer::getInstance()->denormalize($types, Measurement::class, 'json');
    }

    /**
     * @return array
     * @throws ExceptionInterface
     */
    public function getMeta(): array
    {
        $response = $this->client->get('/v2/meta/indexes', ['headers' => $this->headers]);
        $types = json_decode($response->getBody(), true);

        return Serializer::getInstance()->denormalize($types, Type::class . '[]', 'json');
    }
}
