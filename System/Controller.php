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
     * @var
     */
    protected $_args;
    /**
     * @param $args
     */
    public function setArgs($args)
    {
        $this->_args = $args;
    }
    
    /**
     * 
     * @return array
     */
    public function getArgs()
    {
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
