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

function env_parser(array $patterns, callable $f): ?object
{
    $env_data = read_env_file();
    $env = [];

    foreach ($patterns as $v) {
        /* @var $env_tag array */
        preg_match('/' . $v . '=.*?\n/', $env_data, $env_tag);
        $env_tag = preg_replace("/(" . $v . "=|\n)/", '', $env_tag[0]);
        if ($env_tag !== "") {
            $env[$v] = $env_tag;
        }
    }

    if (count($env) < 5) {
        return null;
    } else {
        return (object)$f($env);
    }
}
