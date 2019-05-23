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
    
    /**
     * 创建文章
     * @param string $title
     * @param string $contents
     * @param int $userId
     * @throws \Exception
     * @return array|string
     */
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
    
    /**
     * 查看文章
     * @param int $articleId
     */
    public function view($articleId) {
        if (empty($articleId)) {
            throw new \Exception('文章id不能为空', ErrorCode::ARTICLE_ID_NOT_EMPTY);
        }
        
        $sql = 'SELECT * FROM `articles` where article_id = :articleid';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':articleid', $articleId);
        $stmt->execute();
        $article = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(empty($article)) {
            throw new \Exception('文章不存在', ErrorCode::ARTICLE_NOT_EXISTS);
        }
        return $article;
    }
    
    /**
     * 
     * @param int $articleid
     * @param string $title
     * @param string $contents
     * @param int $userId
     * @throws \Exception
     * @return object|array
     */
    public function edit($articleid, $title, $contents, $userId) {
        $article = $this->view($articleid);
        if ($article['user_id'] != $userId) {
            throw new \Exception('无编辑文章权限', ErrorCode::PERMISSION_DENY);
        }
        
        $title = empty($title) ? $article['title'] : $title;
        $contents = empty($contents) ? $article['content'] : $contents;
        
        $sql = 'update `articles` set `title` = :title, `content` = :content where article_id = :articleid';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $contents);
        $stmt->bindParam(':articleid', $articleid);
        if (!$stmt->execute()) {
            throw new \Exception('编辑文章失败', ErrorCode::ARTICLE_EDIT_FAIL);
        }
        return [
            'articleId' => $articleid,
            'title' => $title,
            'content' => $contents,
            'userId' => $userId,
            'createAt' => $article['create_at']
        ];
    }
    
    /**
     * 文章删除
     * @param int $articleid
     * @param int $userId
     */
    public function delete($articleid, $userId) {
        $article = $this->view($articleid);
        
        if ($article['user_id'] != $userId) {
            throw new \Exception('无删除文章权限', ErrorCode::PERMISSION_DENY);
        }
        
        $sql = 'delete from `articles` where article_id = :articleid';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':articleid', $articleid);
        if (!$stmt->execute()) {
            throw new \Exception('文章删除失败', ErrorCode::ARTICLE_DEL_FAIL);
        }
        return true;
    }
    
    /**
     * 获取文章列表
     * @param int $userId
     * @param number $page
     * @param number $pageSize
     * @throws \Exception
     * @return array
     */
    public function getList($userId, $page = 1, $pageSize = 20) {
        if (empty($userId)) {
            throw new \Exception('用户id不能为空', ErrorCode::USER_OR_PWD_WRONG);
        }
        
        $sql = 'select * from `articles` where user_id = :userId limit :limit, :offset';
        
        $limit = ($page - 1) * $pageSize;
        
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':limit', $limit);
        $stmt->bindParam(':offset', $pageSize);
        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}