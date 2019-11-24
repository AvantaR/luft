<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Luft\ApiClient\ApiClient;
use Luft\HttpClient\HttpClient;
use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\AveragedValues;
use Luft\Models\Measurement\Measurement;
use Luft\Models\Meta\Level;
use Luft\Models\Meta\Type;
use Luft\Serializer;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    /**
     * @var MockHandler
     */
    private $mockHandler;

    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $this->client = new ApiClient(new HttpClient($this->mockHandler), Serializer::getInstance());
    }

    /**
     * @test
     */
    public function getMetaIndexes(): void
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/data/meta.indexes.json')));

        $result = $this->client->getMetaIndexes();
        $this->assertIsArray($result);
        $this->assertInstanceOf(Type::class, $result[0]);
        $this->assertIsArray($result[0]->getLevels());
        $this->assertInstanceOf(Level::class, $result[0]->getLevels()[0]);
    }

    /**
     * @test
     */
    public function getInstallationsNearest(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/installations.nearest.json')));

        $result = $this->client->getInstallationsNearest(50.062006, 19.940984);
        $this->assertIsArray($result);
        $this->assertInstanceOf(Installation::class, $result[0]);
    }


    /**
     * @test
     */
    public function getInstallationId(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/installations.id.json')));

        $result = $this->client->getInstallation(2562);
        $this->assertInstanceOf(Installation::class, $result);
        $this->assertEquals('Łaziska Górne', $result->getAddress()->getCity());
    }

    /**
     * @test
     */
    public function getMeasurementsForInstallation(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.installation.json')));

        $result = $this->client->getMeasurementsForInstallation(2562);
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertIsArray($result->getHistory());
        $this->assertIsArray($result->getForecast());
    }

    /**
     * @test
     */
    public function getMeasurementsNearest(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.nearest.json')));

        $result = $this->client->getMeasurementsNearest(50.062006, 19.940984, 3, 'AIRLY_CAQI');
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertIsArray($result->getHistory());
        $this->assertIsArray($result->getForecast());
    }
}