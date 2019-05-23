<?php
namespace App\Controller\Restful;

use Libs\Db;
use Model\Restful\User;
use Model\Restful\Article;

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
    
    public function createArticle() {
        try {
            $db = new Db();
            $objArticle = new Article($db->pdo);
            $result = $objArticle->create('曼联纪念赛明天开赛', '为纪念欧冠逆转夺冠20周年，曼联传奇队和拜仁传奇队将于明天在老特拉福德举行纪念赛', 2);
            echo json_encode(['isSuccess' => 1, 'errno' => 0, 'errmsg' => '', 'data' => $result], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            echo json_encode(['isSuccess' => 0, 'errno' => $e->getCode(), 'errmsg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
        }
    }
    
    public function viewArticle() {
        try {
            $db = new Db();
            $objArticle = new Article($db->pdo);
            $result = $objArticle->view(2);
            echo json_encode(['isSuccess' => 1, 'errno' => 0, 'errmsg' => '', 'data' => $result], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            echo json_encode(['isSuccess' => 0, 'errno' => $e->getCode(), 'errmsg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
        }
    }
}