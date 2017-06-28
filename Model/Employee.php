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
     * @return Model_Employee[]
     */
    public static function getAll($limit, $offset)
    {
        $dbEmployee = new Model_Db_Table_Employee();
        $data = $dbEmployee->getAll($limit, $offset);
        if(!empty($data))
        {
            $all = [];
            foreach ($data as $key => $value) {
                $all[$key]  = new self();
                $all[$key]->id             = $value->id;
                $all[$key]->firstname      = $value->firstname;
                $all[$key]->lastName       = $value->lastname;
                $all[$key]->middlename     = $value->middlename;
                $all[$key]->department_id  = $value->department_id;
                $all[$key]->salary         = $value->salary;
                $all[$key]->salary_type    = (int)$value->salary_type;
                $all[$key]->position       = $value->position;
                $all[$key]->birthday       = $value->birthday;
            }
        }
        return $all;
    }
    public static function getCount(){
        $dbEmployee = new Model_Db_Table_Employee();
        $data = $dbEmployee->getCount();
        $result = current(current($data));
        return $result;
    }
}