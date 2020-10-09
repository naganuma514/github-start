<?php

require './env/setting.php';

class PdoWrapper
{
    private static $instance = null;
    private static $pdo = null;

    private function __construct()
    {
    }

    private function init(): object
    {
        $pdo = null;
        $connection = getConnectionInfo();

        if($connection === null) {
            throw new Error("connectionが設定されていません。");
            exit;
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
            self::$pdo = $this->init();
        }

        return self::$pdo;
    }
}
