<?php

require './DB/DatabaseConnectionClass.php';

function getConnectionInfo()
{

    $main = 1;

    $settings = [
        0 => [
            'dsn' => 'mysql:host=mysql;dbname=login;charset=utf8mb4;',
            'username' => 'root',
            'password' => 'password',
        ],
        1 => [
            'dsn' => 'mysql:host=localhost;dbname=login;charset=utf8mb4;',
            'username' => 'root',
            'password' => ''
        ]
    ];

    $connection = new Connection($settings, $main);

    return $connection->getConnection();
}
