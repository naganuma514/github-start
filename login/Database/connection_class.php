<?php
class Connection
{
    private $setting_index = 0;
    private $connections = [];

    function __construct(array $connections, int $setting_index)
    {
        $this->connections = $connections;

        if (count($connections) > $setting_index && $setting_index > -1) {
            $this->$setting_index = $setting_index;
        }
    }

    public function getConnection(): object
    {
        return (object)$this->connections[$this->setting_index];
    }
}
