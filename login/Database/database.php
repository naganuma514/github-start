<?php

require 'PodWrapper.php';

class DatabBase
{
    private $pdo = null;

    function __construct()
    {
        $this->pdo = PdoWrapper::getInstance();
    }

    public function query(string $sql_sentence, array $params)
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        return $stmt->execute($params);
    }

    public function queryfetch(string $sql_sentence, array $params)
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        $stmt->execute($params);
        return $stmt->fetch();
    }
}
