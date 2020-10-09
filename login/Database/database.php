<?php

require 'pdo_wrapper.php';

class DatabBase
{
    private $pdo = null;

    function __construct()
    {
        $this->pdo = PdoWrapper::getInstance();
    }

    public function query(string $sql_sentence, array $params): bool
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        return $stmt->execute($params);
    }

    public function queryfetch(string $sql_sentence, array $params): array
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        $stmt->execute($params);
        $result = $stmt->fetch();

        if(gettype($result) === 'array') {
            return $result;
        } else {
            return [];
        }
    }
}
