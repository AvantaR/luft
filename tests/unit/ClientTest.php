<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Luft\ApiClient\ApiClient;
use Luft\HttpClient\HttpClient;
use Luft\Models\Installation\Address;
use Luft\Models\Installation\Coordinates;
use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\AveragedValues;
use Luft\Models\Measurement\Measurement;
use Luft\Models\Meta\Level;
use Luft\Models\Meta\Type;
use Luft\Serializer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ClientTest extends TestCase
{

    /**
     * @var MockHandler
     */
    private $mockHandler;

    /**
     * @var ApiClient
     */
    private $client;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $this->client = new ApiClient(new HttpClient($this->mockHandler), Serializer::getInstance());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function getMetaIndexes(): void
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/data/meta.indexes.json')));

        $result = $this->client->getMetaIndexes();

        $this->assertIsArray($result);
        $this->assertInstanceOf(Type::class, $result[0]);
        $this->assertIsArray($result[0]->getLevels());
        $this->assertEquals('AIRLY_CAQI', $result[0]->getName());
        $this->assertInstanceOf(Level::class, $result[0]->getLevels()[0]);
        $this->assertEquals(0, $result[0]->getLevels()[0]->getMinValue());
        $this->assertEquals(25, $result[0]->getLevels()[0]->getMaxValue());
        $this->assertEquals('0-25', $result[0]->getLevels()[0]->getValues());
        $this->assertEquals('VERY_LOW', $result[0]->getLevels()[0]->getLevel());
        $this->assertEquals('Very Low', $result[0]->getLevels()[0]->getDescription());
        $this->assertEquals('#6BC926', $result[0]->getLevels()[0]->getColor());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function getInstallationsNearest(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/installations.nearest.json')));

        $result = $this->client->getInstallationsNearest(50.062006, 19.940984);

        $this->assertIsArray($result);
        $this->assertInstanceOf(Installation::class, $result[0]);
        $this->assertEquals(8077, $result[0]->getId());
        $this->assertEquals(220.38, $result[0]->getElevation());
        $this->assertEquals(true, $result[0]->isAirly());
        $this->assertInstanceOf(Coordinates::class, $result[0]->getLocation());
        $this->assertEquals(50.062006, $result[0]->getLocation()->getLatitude());
        $this->assertEquals(19.940984, $result[0]->getLocation()->getLongitude());
        $this->assertInstanceOf(Address::class, $result[0]->getAddress());
        $this->assertEquals('Poland', $result[0]->getAddress()->getCountry());
        $this->assertEquals('Kraków', $result[0]->getAddress()->getCity());
        $this->assertEquals('Mikołajska', $result[0]->getAddress()->getStreet());
        $this->assertEquals('4', $result[0]->getAddress()->getNumber());
        $this->assertEquals('Kraków', $result[0]->getAddress()->getDisplayAddress1());
        $this->assertEquals('Mikołajska', $result[0]->getAddress()->getDisplayAddress2());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws ExceptionInterface
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
     * @throws ExceptionInterface
     * @throws GuzzleException
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
     * @throws ExceptionInterface
     * @throws GuzzleException
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

    /**
     * @test
     */
    public function getMeasurementsPoint(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.nearest.json')));

        $result = $this->client->getMeasurementsPoint(50.062006, 19.940984, 'AIRLY_CAQI');
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertIsArray($result->getHistory());
        $this->assertIsArray($result->getForecast());
    }
}