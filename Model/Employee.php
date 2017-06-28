<?php

/**
 * Class Model_Employee
 */
class Model_Employee
{

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $firstname;
    /**
     * @var string
     */
    public $lastname;
    /**
     * @var string
     */
    public $middlename;
    /**
     * @var int
     */
    public $department_id;
    /**
     * @var int
     */
    public $salary;
    /**
     * @var bool
     */
    public $salary_type;
    /**
     * @var string
     */
    public $position;
    /**
     * @var int
     */
    public $birthday;
    /**
     * @var
     */
    public $department_name;


    /**
     * @param string $limit
     * @param string $offset
     * @param string $department
     * @return array
     */
    public static function getAll($limit, $offset, $department)
    {
        $dbEmployee = new Model_Db_Table_Employee();
        $data = $dbEmployee->getAll($limit, $offset, $department);
        $all = [];
        if(!empty($data))
        {
            foreach ($data as $key => $value) {
                $all[$key]  = new self();
                $all[$key]->id             = $value->id;
                $all[$key]->firstname      = $value->firstname;
                $all[$key]->lastName       = $value->lastname;
                $all[$key]->middlename     = $value->middlename;
                $all[$key]->department_id  = isset($value->department_id) ? $value->department_id : null;
                $all[$key]->salary         = $value->salary;
                $all[$key]->salary_type    = (int)$value->salary_type;
                $all[$key]->position       = $value->position;
                $all[$key]->birthday       = $value->birthday;
                $all[$key]->department_name = $value->name;
            }
        }
        return $all;
    }

    /**
     * @param $limit
     * @param $offset
     * @param $department
     * @return mixed
     */
    public static function getCount($department){
        $dbEmployee = new Model_Db_Table_Employee();
        $data = $dbEmployee->getCount($department);
        $result = current(current($data));
        return $result;
    }
}