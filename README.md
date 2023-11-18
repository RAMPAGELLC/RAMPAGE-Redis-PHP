# RAMPAGE-Redis-PHP
Interact with Redis 7 on your RAMPAGE.Host server.

Rent a server today: https://rampagecloud.com/store/game-hosting

# Code Example
```php
<?php
require_once 'RedisClient.php';
$redisHost = 'region.shared.rampage.host';
$redisPort = 3000;
$redisPassword = getenv('redisPassword');

$redisClient = new RedisClient($redisHost, $redisPort, $redisPassword);

try {
    // Set a key-value pair
    $redisClient->set('example_key', 'example_value');

    // Get the value by key
    $value = $redisClient->get('example_key');
    echo "Value for 'example_key': $value\n";

    // Delete a key
    $redisClient->delete('example_key');

    // Close the connection
    $redisClient->close();
} catch (Exception $error) {
    echo "Error: " . $error->getMessage() . "\n";
}
```
