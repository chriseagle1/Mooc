<?php
namespace Model\Restful;

use Libs\ErrorCode;

class Article {
    /**
     * 
     * @var \PDO
     */
    private $_db;
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function create($title, $contents, $userId) {
        if (empty($title)) {
            throw new \Exception('文章标题不能为空', ErrorCode::ARTICLE_TITLE_NOT_EMPTY);
        }
        
        if (empty($contents)) {
            throw new \Exception('文章标题不能为空', ErrorCode::ARTICLE_CONTNET_NOT_EMPTY);
        }
        
        $sql = 'insert into `articles` (`title`, `content`, `user_id`, `create_at`) values(:title, :content, :userid, :createAt)';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $contents);
        $stmt->bindParam(':userid', $userId);
        $createAt = date('Y-m-d H:i:s');
        $stmt->bindParam(':createAt', $createAt);
        if(!$stmt->execute()) {
            throw new \Exception('创建文章失败', ErrorCode::ARTICLE_CREATE_FAIL);
        }
        return [
            'articleId' => $this->_db->lastInsertId(),
            'title' => $title,
            'content' => $contents,
            'userId' => $userId,
            'createAt' => $createAt
        ];
    }
    
    public function edit($articleid, $title, $contents, $userId) {
        
    }
    
    public function delete($articleid, $userId) {
        
    }
}