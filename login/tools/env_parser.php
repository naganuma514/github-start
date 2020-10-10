<?php

function read_env_file(): string
{
    $env_data = '';
    $file = './.env';
    if (file_exists($file)) {
        $env_data = file_get_contents($file);
    }
    return $env_data;
}

function env_parser(string $env_data): ?object
{
    $patterns = ['database', 'host', 'dbname', 'charset', 'username', 'password'];
    $env = [];

    foreach ($patterns as $v) {
        preg_match('/' . $v . '=.*?\n/', $env_data, $env_tag);
        $env_tag = preg_replace("/(" . $v . "=|\n)/", '', $env_tag[0]);
        if($env_tag !== "") {
            $env[$v] = $env_tag;
        }
    }

    if (count($env) < 5) {
        return null;
    } else {

        $dsn = $env['database'] . ':host=' . $env['host'] . ';dbname=' . $env['dbname'] . ';charset=' . $env['charset'] . ';';
        $username = $env['username'];
        $password = $env['password'];
        return (object)[
            "dsn" => $dsn,
            "username" => $username,
            "password" => $password
        ];
    }
}
