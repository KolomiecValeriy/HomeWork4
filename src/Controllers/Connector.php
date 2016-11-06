<?php

namespace Controllers;

error_reporting(E_ALL);
use PDO;

class Connector
{
    private $config;

    private $db;

    /**
     * Connector constructor.
     * Initialize the database connection with MySQL server.
     *
     * @param array $config
     * @param $db
     */
    public function __construct(array $config, $db = true)
    {
        $this->config = $config;
        (!$db) ? $this->db = false : $this->db = true;
    }
    /**
     * return Object.
     */
    public function getConnection()
    {
        if (!$this->db) {
            return new PDO('mysql:host=127.0.0.1;charset=utf8', $this->config['user'], $this->config['password']);
        } else {
            return new PDO('mysql:host=127.0.0.1;dbname='.$this->config['db'], $this->config['user'], $this->config['password']);
        }
    }
}
