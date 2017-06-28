<?php

/**
 * Class System_Controller
 */
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

    /**
     * @var
     */
    protected $_tableName;

    /**
     * @var
     */
    protected $_modelName;

    /**
     * @var
     */
    protected $_args;


    /**
     * @param $args
     */
    public function setArgs($args)
    {
//        if(in_array('table', $args) )
//        {
//            $this->_tableName = array_pop($args);
//            $this->_modelName = 'Model_' . ucfirst($this->_tableName);
//            array_pop($args);
//        }
        $this->_args = $args;
    }
    
    /**
     * 
     * @return array
     */
    public function getArgs()
    {
//        $tempArgs = array();
//        $count = count($this->_args);
//        for($i = 0; $i < $count - 1; $i += 2)
//        {
//            $tempArgs[$this->_args[$i]] = $this->_args[$i+1];
//        }
        return $this->_args;
    }

    /**
     * System_Controller constructor.
     */
    public function __construct() {
        $this->view = new System_View();
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $_REQUEST;
    }
    /**
     * 
     * @param $key
     * @return mixed
     */
    public function getParamByKey($key)
    {
        return !empty($_REQUEST[$key]) ? $_REQUEST[$key] : NULL;
    }

}
