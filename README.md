# OpenStreetMap API Client
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