<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Luft\ApiClient\ApiClient;
use Luft\HttpClient\HttpClient;
use Luft\Models\Installation\Installation;
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
//        $this->assertIsArray($result[0]->getLevels());
//        $this->assertInstanceOf(Level::class, $result[0]->getLevels()[0]);
    }
}