<?php
class FewParametersException extends Exception {
    function __construct()
    {
        parent::__construct('Too few parameters set in the .env file');
    }
}
