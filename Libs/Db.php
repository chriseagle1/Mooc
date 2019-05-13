<?php
namespace Libs;

class Db {
    private $pdo;
    
    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=imooc;', 'chris', '11');
    }
    
    public function __get($name) {
        return $this->$name;
    }
}