<?php
namespace App\Controller\Restful;

use Libs\Db;
use Model\Restful\User;

class Index {
    public function register() {
        $db = new Db();
        $obj = new User($db->pdo);
        var_dump($obj->register($_GET['username'], $_GET['password']));
    }
}