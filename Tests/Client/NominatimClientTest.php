<?php
/**
 * Class NominatimClientTest
 *
 * @author Mauro Moreno <moreno.mauro.emanuel@gmail.com>
 */
namespace MauroMoreno\OpenStreetMap\Client\Tests\Client;

use MauroMoreno\OpenStreetMap\Client\NominatimClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

/**
 * Class NominatimClientTest
 * @package MauroMoreno\Client\Tests\Client
 */
class NominatimClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test valid client
     */
    public function testValidClient()
    {
        $client = new NominatimClient();
        $this->assertInstanceOf(Client::class, $client->getGuzzleClient());
        $this->assertEquals(
            'http://nominatim.openstreetmap.org',
            $client->getGuzzleClient()->getConfig('base_uri')
        );
    }

    /**
     * Test reverse, wrong params
     *
     * @dataProvider      setWrongLatitudeAndLongitude
     * @expectedException \InvalidArgumentException
     */
    public function testReverseWrongParams($latitude, $longitude)
    {
        $client = new NominatimClient();
        $client->reverse($latitude, $longitude);
    }

    /**
     * Test reverse, ok
     */
    public function testReverseOk()
    {
        $client = new NominatimClient();
        $mock = new MockHandler(
            [
                new Response(200, [], Psr7\stream_for('ABC')),
            ]
        );
        $client->getGuzzleClient()->getConfig('handler')->setHandler($mock);
        $response = $client->reverse(0.01, 0.01);
        $this->assertEquals('ABC', $response->getBody()->getContents());
    }

    /**
     * Set wrong Latitude and Longitude data provider
     *
     * @return array
     */
    public function setWrongLatitudeAndLongitude()
    {
        return [
            ['', 0.00],
            [0.00, '']
        ];
    }

}
