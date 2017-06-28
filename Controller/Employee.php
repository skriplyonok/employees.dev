<?php

class Controller_Employee extends System_Controller
{
    public function indexAction()
    {
        $args = $this->getArgs();
        $activePage = empty($args) ? 1 : current($args);
        $limit = empty($_POST['select-menu']) ? 2 : $_POST['select-menu'];
        try {
//            $modelName = $this->_modelName;
            $all = Model_Employee :: getAll($limit, ($activePage-1)*$limit);
            $this->view->setParam('all', $all);
            $this->view->setParam('limit', $limit);
            $this->view->setParam('activePage', $activePage);
            $count = Model_Employee::getCount();
            $this->view->setParam('count', $count);
//            $this->view->setParam('table', $this->_tableName);
        }
        catch(Exception $e) {
            $this->view->setParam('error', $e->getMessage());
        }
    }
}

