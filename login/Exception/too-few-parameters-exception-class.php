<?php
class TooFewParametersException extends Exception {
    function __construct()
    {
        parent::__construct('Too few parameters set in the .env file');
    }
}
