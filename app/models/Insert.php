<?php

namespace App\models;

use App\database\Connection;
use App\interfaces\ActiveRecordInterface;

class Insert
{

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        
        try{
            $query = $this->createQuery($activeRecordInterface);
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute($activeRecordInterface->getAttributes());
    
            return $stmt->rowCount();
    
        }catch(\PDOException $e){
            var_dump($e->getMessage());
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "INSERT INTO {$activeRecordInterface->getTable()}(";
        $sql .= implode(",", array_keys($activeRecordInterface->getAttributes())) . ") VALUES(";
        $sql .= ":" . implode(",:", array_keys($activeRecordInterface->getAttributes())) . ")";
        return $sql;
    }
}