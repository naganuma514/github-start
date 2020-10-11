<?php

require_once './Exception/index.php';

function read_env_file(): string
{
    $env_data = '';
    $file = './.env';

    if (file_exists($file)) {
        $env_data = file_get_contents($file);
    } else {
        throw new NotFoundEnvFileException();
        exit();
    }

    return $env_data;
}

function env_parser(array $patterns, callable $f): object
{
    try {
        $env_data = read_env_file();
    } catch(NotFoundEnvFileException $e) {
        echo $e->getMessage();
        exit();
    }

    $env = [];

    foreach ($patterns as $v) {
        /* @var $env_tag array */
        if(preg_match('/' . $v . '=.*?\n/', $env_data, $env_values)){
            $env_value = preg_replace("/(" . $v . "=|\n)/", '', $env_values[0]);
            if ($env_value !== "") {
                $env[$v] = $env_value;
            }
        }
    }

    if (count($env) !== count($patterns)) {
        throw  new TooFewParametersException();
        exit();
    } else {
        return (object)$f($env);
    }
}
