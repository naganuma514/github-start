<?php

require_once './tools/env_parser.php';

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

        // envから解析して欲しいパターン
        $patterns = ['database', 'host', 'dbname', 'charset', 'username', 'password'];

        // envから解析したあとどのように処理して欲しいか
        $f = function (array $env): array {
            $dsn = $env['database'] . ':host=' . $env['host'] . ';dbname=' . $env['dbname'] . ';charset=' . $env['charset'] . ';';
            $username = $env['username'];
            $password = $env['password'];
            return [
                "dsn" => $dsn,
                "username" => $username,
                "password" => $password
            ];
        };

        $connection = env_parser($patterns, $f);

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
