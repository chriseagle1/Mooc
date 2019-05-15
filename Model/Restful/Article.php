<?php
namespace Model\Restful;

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
        
    }
    
    public function edit($articleid, $title, $contents, $userId) {
        
    }
    
    
}