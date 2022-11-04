<?php

namespace App\models;

use App\interfaces\ActiveRecordExecuteInterface;
use App\interfaces\ActiveRecordInterface;

abstract class ActiveRecord implements ActiveRecordInterface
{
    protected $attributes = [];
    protected $table = null;

    public function getTable()
    {
            return $this->table;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function __set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    public function __get($attribute)
    {
        return $this->attributes[$attribute];
    }

    public function execute(ActiveRecordExecuteInterface $activeRecordExecuteInterface)
    {
        return $activeRecordExecuteInterface->execute($this);
    }

}