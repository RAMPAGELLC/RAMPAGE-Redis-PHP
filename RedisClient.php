<?php

/*
  Copyright (©) 2023 RAMPAGE Interactive
  Redis Client Wrapper for RAMPAGE Redis Socket.

  Repository: https://github.com/RAMPAGELLC/RAMPAGE-Redis-PHP
*/

require("Redis.php");

class RedisClient
{
    private $redis;

    public function __construct($host, $port, $password = null)
    {
        $this->redis = new Redis($host, $port, $password);
    }

    public function set($key, $value)
    {
        $this->redis->sendCommand('SET', [$key, $value]);
    }

    public function get($key)
    {
        return $this->redis->sendCommand('GET', [$key]);
    }

    public function delete($key)
    {
        $this->redis->sendCommand('DEL', [$key]);
    }

    public function close()
    {
        $this->redis->close();
    }
}
