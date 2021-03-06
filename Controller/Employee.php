<?php

/**
 * Class Controller_Employee
 */
class Controller_Employee extends System_Controller
{
    /**
     * @throws Exception
     */
    public function indexAction()
    {
        $args = $this->getArgs();
        $department = !empty($args) && !is_numeric(current($args)) ? array_shift($args) : '';
        $activePage = empty($args) ? 1 : current($args);
        $params = $this->getParams();
        $limit = empty($params['select-limit']) ? 20 : $params['select-limit'];
        try {
            $all = Model_Employee :: getAll($limit, ($activePage-1)*$limit, $department);
            $count = Model_Employee::getCount($department);
            $departments = Model_Department::getAll();

            $this->view->setParam('all', $all);
            $this->view->setParam('limit', $limit);
            $this->view->setParam('activePage', $activePage);
            $this->view->setParam('count', $count);
            $this->view->setParam('departments', $departments);
        }
        catch(Exception $e) {
            throw new Exception('404 error! Page not found');
        }
    }

    /**
     * @throws Exception
     */
    public function xmlAction(){
        try{
            $all = Model_Employee::getAllFromXML();
            $this->view->setParam('all', $all);
        }
        catch(Exception $e) {
            throw new Exception('404 error! Page not found');
        }
    }
}

