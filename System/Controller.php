<?php

abstract class System_Controller
{

    /**
     *
     * @var System_View
     */
    public $view;
    
    /**
     *
     * @var int
     */
    protected $_userId;
    
    protected $_tableName;
    
    protected $_modelName;


    public function setArgs($args)
    {
        if(in_array('table', $args) )
        {           
            $this->_tableName = array_pop($args);
            $this->_modelName = 'Model_' . ucfirst($this->_tableName);
            array_pop($args);
        }
        $this->args = $args;
    }
    
    /**
     * 
     * @return array
     */
    public function getArgs()
    {
        $tempArgs = array();
        $count = count($this->args);
        for($i = 0; $i < $count - 1; $i += 2)
        {
            $tempArgs[$this->args[$i]] = $this->args[$i+1];
        }
        return $tempArgs;
    }

    public function __construct() {
        $this->view = new System_View();
        $this->_userId = $this->_getSessParam('currentUser');
    }
    public function getParams()
    {
        return $_REQUEST;
    }
    /**
     * 
     * Save session's data
     * 
     * @param string $key
     * @param mixed $value
     */
    protected function _setSessParam($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Retrieve data from session
     * 
     * @param string $key
     * @return mixed
     */
    protected function _getSessParam($key)
    {   
        if(!empty($_SESSION)) {
            return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : NULL;
        }
        return NULL;
    }
    /**
     * 
     * @param type $key
     * @return mixed
     */
    public function getParamByKey($key)
    {
        return !empty($_REQUEST[$key]) ? $_REQUEST[$key] : NULL;
    }
    public function isAdmin()
    {
         $userRole = $this->_getSessParam('userRole');
        if($userRole == Model_User::ROLE_ADMIN) {
            
        }
        else {
            header('Location: /');
        }          
    }

}