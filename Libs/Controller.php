<?php
namespace Libs;

class Controller {
    protected $request;
    
    protected $className;
    protected $action;
    
    protected $prefix = '\\APP\\Controller';
    
    public function __construct() {
        $this->request = $_SERVER['REQUEST_URI'];
        $this->handleRequest();
    }
    
    public function run() {
        $object = new $this->className;
        call_user_func([$object, $this->action]);
    }
    
    public function handleRequest() {
        $pathInfo = pathinfo($this->request);
        $this->action = substr($pathInfo['basename'], 0, strpos($pathInfo['basename'], '?'));

        $realRequest = substr($pathInfo['dirname'], strpos($pathInfo['dirname'], 'mooc') + 4);
        $this->className = $this->prefix  . str_replace('/', '\\', $realRequest);
    }
    
}