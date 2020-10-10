<?php

require_once 'pdo_wrapper_class.php';

class Controller
{
    private $pdo = null;

    function __construct()
    {
        $this->pdo = PdoWrapper::get_instance();
    }

    public function query(string $sql_sentence, array $params): bool
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        return $stmt->execute($params);
    }

    public function query_fetch(string $sql_sentence, array $params): array
    {
        $stmt = $this->pdo->get()->prepare($sql_sentence);
        $stmt->execute($params);
        $result = $stmt->fetch();

        if (gettype($result) === 'array') {
            return $result;
        } else {
            return [];
        }
    }
}
