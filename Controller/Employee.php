<?php

class Controller_Employee extends System_Controller
{
    public function indexAction()
    {
        try {
//            $modelName = $this->_modelName;
            $all = Model_Employee :: getAll();
            $this->view->setParam('all', $all);
//            $this->view->setParam('table', $this->_tableName);
        }
        catch(Exception $e) {
            $this->view->setParam('error', $e->getMessage());
        }
    }
}

