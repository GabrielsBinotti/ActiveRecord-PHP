<?php

namespace App\controller;

use App\models\FindBy;
use App\models\User as ModelsUser;

class User
{
    public function getUser()
    {
        $userObj = new ModelsUser();

        $user = $userObj->execute(new FindBy("*",'id',1));

        var_dump($user);
    }

}