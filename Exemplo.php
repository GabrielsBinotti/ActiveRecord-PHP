<?php


require __DIR__ . "/vendor/autoload.php";

use App\controller\User;

$userController = new User();

$userController->getUser();