<?php

require './tools/env_parser.php';

class PdoWrapper
{
    private static $instance = null;
    private static $pdo = null;

    private function __construct()
    {
    }

    private function init(): ?object
    {
        $pdo = null;
        $connection = env_parser(read_env_file());

        if ($connection === null) {
            return null;
        }

        $dsn = $connection->dsn;
        $username = $connection->username;
        $password = $connection->password;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }

        return $pdo;
    }

    public static function getInstance(): object
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(): object
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = $this->init();
                if (self::$pdo === null) {
                    throw new Exception();
                }
            } catch (Exception $e) {
                echo 'env設定が正しくありません。';
            }
        }

        return self::$pdo;
    }
}
