<?php

namespace App\models;

use App\database\Connection;
use App\interfaces\ActiveRecordExecuteInterface;
use App\interfaces\ActiveRecordInterface;

class Update implements ActiveRecordExecuteInterface
{
    private $field;
    private $value;

    public function __construct($field, $value)
    {
       
        $this->field    = $field;
        $this->value    = $value;
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        
        try{
            $query = $this->createQuery($activeRecordInterface);
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute($activeRecordInterface->getAttributes(), [$this->field => $this->value]);
    
            return $stmt->rowCount();
    
        }catch(\PDOException $e){
            var_dump($e->getMessage());
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "UPDATE {$activeRecordInterface->getTable()} SET ";
        foreach($activeRecordInterface->getAttributes() as $key => $value)
        {
            $sql .= "{$key} = :{$key}, ";
        }
        
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE {$this->field} = :{$this->field}";

        return $sql;
    }
}