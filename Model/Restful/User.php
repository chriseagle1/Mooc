<?php
namespace Model\Restful;

class User {
    
    /**
     * 数据库连接句柄
     * @var \PDO
     */
    private $_db;
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    /**
     * 用户登录
     * @param string $username
     * @param string $password
     */
    public function login($username, $password) {
        
    }
    
    /**
     * 用户注册
     * @param string $username
     * @param string $password
     */
    public function register($username, $password) {
        return $this->_isUsernameExists($username);
    }
    
    /**
     * 判断数据是否存在
     * @param string $username
     * @return mixed
     */
    private function _isUsernameExists($username) {
        $sql = 'select * from `user` where user_name = :username';
        
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return !empty($result) ? true : false;
    }
}