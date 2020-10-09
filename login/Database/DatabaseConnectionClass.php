<?php
class Connection {
    private $main = 0;
    private $connections = [];

    function __construct($connections, int $main)
    {
        $this->connections = $connections;
        if(count($connections) > $main && $main > -1) {
            $this->$main = $main;
        }
    }

    public function getConnection(): object {
        return (object)$this->connections[$this->main];
    }
}
