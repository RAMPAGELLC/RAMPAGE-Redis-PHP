<?php

/*
  Copyright (©) 2023 RAMPAGE Interactive
  Example with RAMPAGE Redis Client

  Repository: https://github.com/RAMPAGELLC/RAMPAGE-Redis-PHP
*/

$redisHost = '{RAMPAGE.Host shared block ID}.shared.rampage.host';
$redisPort = {port};

$redisClient = new RedisClient($redisHost, $redisPort);

// Set a key-value pair
$redisClient->set('example_key', 'example_value');

// Get the value by key
$value = $redisClient->get('example_key');
echo "Value for 'example_key': $value\n";

// Delete a key
$redisClient->delete('example_key');

// Close the connection
$redisClient->close();
