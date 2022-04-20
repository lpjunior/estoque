<?php
    class Connection extends PDO {

        const HOSTNAME = "ec2-54-80-123-146.compute-1.amazonaws.com";
        const USERNAME = "ohpqitrpoiczhr";
        const PASSWORD = "41700dfa315541232d18e80d36034281c14a4e2ac2f8f82217260e0694f40998";
        const SCHEMA = "d8uv27guq46mi";
        const PORT = 5432;
        
        private $conn;

        # magic method
        public function __construct() {
            $key = "strval";
            $dsn = "pgsql:host={$key(self::HOSTNAME)};dbname={$key(self::SCHEMA)};port={$key(self::PORT)}";
            $this->conn = new PDO($dsn, self::USERNAME, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }

        public function getConnection() {
            $this->conn->query("SET timezone TO 'America/Sao_Paulo'");
            return $this->conn;
        }
    }
