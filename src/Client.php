<?php

namespace Luft;

use Luft\Models\Installation\Installation;
use Luft\Models\Meta\Meta;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Luft\Models\Meta\Type;

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
     * @param int $installationId
     * @return Installation
     * @throws ExceptionInterface
     */
    public function getInstallation(int $installationId): Installation
    {
        $response = $this->client->get('/v2/installations/' . $installationId, ['headers' => $this->headers]);
        $types = json_decode($response->getBody(), true);

        return \Luft\Serializer::getInstance()->denormalize($types, Installation::class, 'json');
    }

    /**
     * @return array
     * @throws ExceptionInterface
     */
    public function getMeta(): array
    {
        $response = $this->client->get('/v2/meta/indexes', ['headers' => $this->headers]);
        $types = json_decode($response->getBody(), true);

        return \Luft\Serializer::getInstance()->denormalize($types, Type::class . '[]', 'json');
    }
}
