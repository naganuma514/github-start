<?php
class NotFoundEnvFileException extends Exception {
    function __construct()
    {
        parent::__construct('.env file not found');
    }
}
