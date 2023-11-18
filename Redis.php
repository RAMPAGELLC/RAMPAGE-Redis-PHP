<?php

/*
  Copyright (©) 2023 RAMPAGE Interactive
  Redis socket for Redis 7 RAMPAGE.Host server. Compatible with any non-RAMPAGE.Host redis server.

  Repository: https://github.com/RAMPAGELLC/RAMPAGE-Redis-PHP
*/

class Redis
{
    private $socket;

    public function __construct($host, $port, $password = null)
    {
        try {
            $this->connect($host, $port);
            if ($password !== null) {
                $this->authenticate($password);
            }
        } catch (Exception $e) {
            throw new Exception("Unable to connect to Redis server: " . $e->getMessage());
        }
    }

    private function connect($host, $port)
    {
        $this->socket = @fsockopen($host, $port, $errno, $errstr, 5);

        if (!$this->socket) {
            throw new Exception("Unable to connect to Redis server: $errstr ($errno)");
        }
    }

    private function authenticate($password)
    {
        $response = $this->sendCommand('AUTH', [$password]);

        if ($response !== '+OK') {
            throw new Exception('Authentication failed');
        }
    }

    public function sendCommand($command, $params = [])
    {
        $commandString = $this->buildCommandString($command, $params);
        fwrite($this->socket, $commandString);

        $response = $this->readResponse();

        if ($response === false) {
            throw new Exception("Error reading from Redis server");
        }

        return trim($response);
    }

    private function buildCommandString($command, $params)
    {
        $commandString = "*" . (count($params) + 1) . "\r\n";
        $commandString .= "$command\r\n";

        foreach ($params as $param) {
            $commandString .= "$param\r\n";
        }

        return $commandString;
    }

    private function readResponse()
    {
        $response = fgets($this->socket);

        if ($response === false) {
            throw new Exception("Error reading from Redis server");
        }

        return trim($response);
    }

    public function close()
    {
        fclose($this->socket);
    }
}
