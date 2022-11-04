<?php

namespace App\models;

use App\database\Connection;
use App\interfaces\ActiveRecordExecuteInterface;
use App\interfaces\ActiveRecordInterface;

class FindBy implements ActiveRecordExecuteInterface
{
    private $fields;
    private $field;
    private $value;

    public function __construct($fields = '*', $field, $value)
    {
        $this->fields   = $fields;
        $this->field    = $field;
        $this->value    = $value;
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        
        try{
            $query = $this->createQuery($activeRecordInterface);
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute([$this->field => $this->value]);
    
            return $stmt->fetch();
    
        }catch(\PDOException $e){
            var_dump($e->getMessage());
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()} WHERE {$this->field} = :{$this->field}";

        return $sql;
    }
}