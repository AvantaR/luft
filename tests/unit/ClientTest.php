<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Luft\ApiClient\ApiClient;
use Luft\Client;
use Luft\HttpClient\HttpClient;
use Luft\Models\Installation\Address;
use Luft\Models\Installation\Coordinates;
use Luft\Models\Installation\Installation;
use Luft\Models\Measurement\AveragedValues;
use Luft\Models\Measurement\Index;
use Luft\Models\Measurement\Measurement;
use Luft\Models\Measurement\Standard;
use Luft\Models\Meta\Level;
use Luft\Models\Meta\Type;
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
        $this->client = new Client('randomKey', new HttpClient($this->mockHandler));
    }

    /**
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function testGetMetaIndexes(): void
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
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function testGetInstallationsNearest(): void
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
     * @throws GuzzleException
     * @throws ExceptionInterface
     */
    public function testGetInstallationId(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/installations.id.json')));

        $result = $this->client->getInstallation(2562);
        $this->assertInstanceOf(Installation::class, $result);
        $this->assertEquals('Poland', $result->getAddress()->getCountry());
        $this->assertEquals('Łaziska Górne', $result->getAddress()->getCity());
        $this->assertEquals('Fryderyka Chopina', $result->getAddress()->getStreet());
        $this->assertEquals(10, $result->getAddress()->getNumber());
        $this->assertEquals('Łaziska Górne', $result->getAddress()->getDisplayAddress1());
        $this->assertEquals('Fryderyka Chopina', $result->getAddress()->getDisplayAddress2());
        $this->assertEquals(161, $result->getSponsor()->getId());
        $this->assertEquals('Powiat mikołowski', $result->getSponsor()->getName());
        $this->assertEquals('Airly Sensor\'s sponsor', $result->getSponsor()->getDescription());
        $this->assertEquals('https://cdn.airly.eu/logo/Powiat_mikolowski.jpg', $result->getSponsor()->getLogo());
        $this->assertNull($result->getSponsor()->getLink());
    }

    /**
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function testGetMeasurementsForInstallation(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.installation.json')));

        $result = $this->client->getMeasurementsForInstallation(2562);
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertEquals('2019-11-24T12:23:12.384Z', $result->getCurrent()->getFromDateTime());
        $this->assertEquals('2019-11-24T13:23:12.384Z', $result->getCurrent()->getTillDateTime());
        $this->assertEquals('PM1', $result->getCurrent()->getValues()[0]->getName());
        $this->assertEquals(13.66, $result->getCurrent()->getValues()[0]->getValue());
        $this->assertContainsOnly(Index::class, $result->getCurrent()->getIndexes());
        $this->assertContainsOnly(Standard::class, $result->getCurrent()->getStandards());
        $this->assertEquals('WHO', $result->getCurrent()->getStandards()[0]->getName());
        $this->assertEquals(25, $result->getCurrent()->getStandards()[0]->getLimit());
        $this->assertEquals(87.5, $result->getCurrent()->getStandards()[0]->getPercent());
        $this->assertEquals('PM25', $result->getCurrent()->getStandards()[0]->getPollutant());
        $this->assertContainsOnly(AveragedValues::class, $result->getHistory());
        $this->assertContainsOnly(AveragedValues::class, $result->getForecast());

    }

    /**
     * @throws ExceptionInterface
     * @throws GuzzleException
     */
    public function testGetMeasurementsNearest(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.nearest.json')));

        $result = $this->client->getMeasurementsNearest(50.062006, 19.940984, 3, 'AIRLY_CAQI');
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertIsArray($result->getHistory());
        $this->assertIsArray($result->getForecast());
        $this->assertIsArray($result->getCurrent()->getIndexes());
        $this->assertEquals('AIRLY_CAQI', $result->getCurrent()->getIndexes()[0]->getName());
        $this->assertEquals('56.27', $result->getCurrent()->getIndexes()[0]->getValue());
        $this->assertEquals('MEDIUM', $result->getCurrent()->getIndexes()[0]->getLevel());
        $this->assertEquals('Well... It\'s been better.', $result->getCurrent()->getIndexes()[0]->getDescription());
        $this->assertEquals('Try to stay with your family at home.', $result->getCurrent()->getIndexes()[0]->getAdvice());
        $this->assertEquals('#EFBB0F', $result->getCurrent()->getIndexes()[0]->getColor());
    }

    /**
     * @throws ExceptionInterface
     */
    public function testGetMeasurementsPoint(): void
    {
        $this->mockHandler->append(new Response(200, [],
            file_get_contents(__DIR__ . '/data/measurements.point.json')));

        $result = $this->client->getMeasurementsPoint(50.062006, 19.940984, 'AIRLY_CAQI');
        $this->assertInstanceOf(Measurement::class, $result);
        $this->assertInstanceOf(AveragedValues::class, $result->getCurrent());
        $this->assertIsArray($result->getHistory());
        $this->assertIsArray($result->getForecast());
    }
}