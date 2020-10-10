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
    //  The .env file may not exist.
    if(!$env_data = read_env_file() ){
        return null;
    };
    $env = [];

    foreach ($patterns as $v) {
        /* @var $env_tag array */
        if(!preg_match('/' . $v . '=.*?\n/', $env_data, $env_tag) ){
            continue;
        }
        $env_tag = preg_replace("/(" . $v . "=|\n)/", '', $env_tag[0]);
        if ($env_tag !== "") {
            $env[$v] = $env_tag;
        }
    }

    if (count($env) === count($patterns)) {
        return (object)$f($env);
    } else {
        return null;
    }
}
