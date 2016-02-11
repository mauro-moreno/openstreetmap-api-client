<?php
/**
 * Class NominatimClient
 *
 * @author Mauro Moreno <moreno.mauro.emanuel@gmail.com>
 */
namespace MauroMoreno\OpenStreetMap\Client;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class NominatimClient
 * @package MauroMoreno\OpenStreetMap\Client
 */
class NominatimClient
{

    /**
     * Base URL
     */
    const BASE_URI = 'http://nominatim.openstreetmap.org';

    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * NominatimClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $defaults['base_uri'] = self::BASE_URI;

        // Format xml or json
        if (!isset($config['format'])) {
            $config['format'] = 'json';
        }

        // Address details
        if (!isset($config['addressdetails'])) {
            $config['addressdetails'] = 1;
        }

        $defaults = array_merge($defaults, $config);
        $this->guzzleClient = new GuzzleClient($defaults);
    }

    /**
     * Reverse action
     *
     * @param $latitude
     * @param $longitude
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function reverse($latitude, $longitude)
    {
        if (!$this->isLatitude($latitude)) {
            throw new \InvalidArgumentException(
                'Wrong value for latitude.'
            );
        }

        if (!$this->isLongitude($longitude)) {
            throw new \InvalidArgumentException(
                'Wrong value for longitude.'
            );
        }

        $response = $this->guzzleClient->get(
            'reverse',
            [
                'query' => [
                    'format' => $this->guzzleClient->getConfig('format'),
                    'lat'    => $latitude,
                    'lon'    => $longitude,
                    'addressdetails' => $this->guzzleClient->getConfig('addressdetails')
                ],
            ]
        );

        return $response;
    }

    /**
     * Validate is latitude
     *
     * @param $value
     *
     * @return int
     */
    private function isLatitude($value)
    {
        return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $value);
    }

    /**
     * Validate is longitude
     *
     * @param $value
     *
     * @return int
     */
    private function isLongitude($value)
    {
        return preg_match(
            '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
            $value
        );
    }

    /**
     * Get Guzzle Client
     *
     * @return GuzzleClient
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

}