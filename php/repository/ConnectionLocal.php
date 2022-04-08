<?php

    class ConnectionLocal extends PDO {

        const HOSTNAME = "";
        const USERNAME = "";
        const PASSWORD = "";
        const SCHEMA = "";
        const PORT = 5432;
        
        private $conn;

        public function __construct() {
            $key = "strval";
            $dsn = "pgsql:host={$key(self::HOSTNAME)};dbname={$key(self::SCHEMA)};port={$key(self::PORT)}";
            $this->conn = new PDO($dsn, self::USERNAME, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }

        public function getConnection() {
            return $this->conn;
        }
    } 