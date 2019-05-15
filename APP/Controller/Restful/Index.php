<?php
namespace App\Controller\Restful;

use Libs\Db;
use Model\Restful\User;

class Index {
    public function register() {
        try {
            $db = new Db();
            $objUser = new User($db->pdo);
            $result = $objUser->register($_GET['username'], $_GET['password']);
            echo json_encode(['isSuccess' => 1, 'errno' => 0, 'errmsg' => '', 'data' => $result], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            echo json_encode(['isSuccess' => 0, 'errno' => $e->getCode(), 'errmsg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
        }
    }
    
    public function login() {
        try {
            $db = new Db();
            $objUser = new User($db->pdo);
            $result = $objUser->login($_GET['username'], $_GET['password']);
            echo json_encode(['isSuccess' => 1, 'errno' => 0, 'errmsg' => '', 'data' => $result], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            echo json_encode(['isSuccess' => 0, 'errno' => $e->getCode(), 'errmsg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
        }
    }
}