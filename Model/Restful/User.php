<?php
namespace Model\Restful;

use Libs\ErrorCode;

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
        $this->_checkUser($username, $password);
        
        $sql = 'SELECT * From `user` where user_name = :username and password = :password';
        $stmt = $this->_db->prepare($sql);
        $password = $this->_md5($password);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        
        $stmt->execute();
        
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($user)) {
            throw new \Exception('用户名或密码错误！', ErrorCode::USERORPWDWRONG);
        }
        
        unset($user['password']);
        return $user;
    }
    
    /**
     * 用户注册
     * @param string $username
     * @param string $password
     */
    public function register($username, $password) {
        $this->_checkUser($username, $password);
        
        if ($this->_isUsernameExists($username)) {
            throw new \Exception('用户已存在', ErrorCode::USERNAME_EXISTS);
        }
        
        $sql = 'INSERT INTO `user` (`user_name`, `password`, `created_at`) values (:username, :password, :createat)';
        $password = $this->_md5($password);
        $createAt = date('Y-m-d H:i:s');
        
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':createat', $createAt);
        
        if (!$stmt->execute()) {
            throw new \Exception('注册失败', ErrorCode::REGISTER_FAIL);
        }
        
        return [
            'userid' => $this->_db->lastInsertId(),
            'username' => $username,
            'createAt' => $createAt
        ];
    }
    
    /**
     * 检查用户名密码
     * @param string $username
     * @param string $password
     */
    private function _checkUser($username, $password) {
        if(empty($username)) {
            throw new \Exception('用户名不能为空', ErrorCode::USERNAME_NOT_EMPTY);
        }
        
        if(empty($password)) {
            throw new \Exception('密码不能为空', ErrorCode::PASSWORD_NOT_EMPTY);
        }
    }
    
    /**
     * 自定义md5加密函数
     * @param string $string
     * @param string $key
     * @return string
     */
    private function _md5($string, $key = 'imooc') {
        return md5($string . $key);
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