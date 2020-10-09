<?php

require './Database/DatabaseConnectionClass.php';

const USE_SETTING_INDEX = 1;

const SETTINGS = [
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

function getConnectionInfo()
{
    $connection = new Connection(SETTINGS, USE_SETTING_INDEX);
    return $connection->getConnection();
}
