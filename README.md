# OpenStreetMap API Client

[![Build Status](https://travis-ci.org/mauro-moreno/openstreetmap-api-client.svg?branch=master)](https://travis-ci.org/mauro-moreno/openstreetmap-api-client)
[![Build Status](https://scrutinizer-ci.com/g/mauro-moreno/openstreetmap-api-client/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mauro-moreno/openstreetmap-api-client/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mauro-moreno/openstreetmap-api-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mauro-moreno/openstreetmap-api-client/?branch=master)

A PHP OpenStreetMap API Client

## Installation

```bash
composer require mauro-moreno/openstreetmap-api-client
```

## Usage

### Nominatim

```php
<?php
$config = [
    'format' => 'json'
];
$client = new MauroMoreno\OpenStreetMap\NominatimClient($config);
$client->reverse(40.748817, -73.985428);

// Returns Empire State address.
```