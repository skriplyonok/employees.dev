<?php


/**
 * Class Model_Employee
 */
abstract class Model_Employee
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
     * @var float
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
                if($value->salary_type){
                    $all[$key]  = new Model_EmployeeMonthly();
                }else{
                    $all[$key]  = new Model_EmployeeHourly();
                    $all[$key]->hours = isset($value->hours) ? $value->hours : null;
                }
                $all[$key]->id             = $value->id;
                $all[$key]->firstname      = $value->firstname;
                $all[$key]->lastname       = $value->lastname;
                $all[$key]->middlename     = $value->middlename;
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
     * @param $department
     * @return mixed
     */
    public static function getCount($department){
        $dbEmployee = new Model_Db_Table_Employee();
        $data = $dbEmployee->getCount($department);
        $result = current(current($data));
        return $result;
    }
    /**
     * @return mixed
     */
    public abstract function getSalary();

    public static function getAllFromXML(){
        $data = file_get_contents(SITE_PATH . DS . 'upload/employees.xml');
        $all = [];
        if (!empty($data)){
            $dataXML = new SimpleXMLElement($data);

            $count = $dataXML->count();
            for ($key = 0; $key < $count; $key++){
                if((int)$dataXML->employee[$key]->salary_type){
                    $all[$key]  = new Model_EmployeeMonthly();
                }else{
                    $all[$key]  = new Model_EmployeeHourly();
                    $all[$key]->hours = isset($dataXML->employee[$key]->hours) ? (int)$dataXML->employee[$key]->hours : null;
                }
                $all[$key]->id             = (string)$dataXML->employee[$key]->id;
                $all[$key]->firstname      = (string)$dataXML->employee[$key]->firstname;
                $all[$key]->lastname       = (string)$dataXML->employee[$key]->lastname;
                $all[$key]->middlename     = (string)$dataXML->employee[$key]->middlename;
                $all[$key]->salary         = (int)$dataXML->employee[$key]->salary;
                $all[$key]->salary_type    = (int)$dataXML->employee[$key]->salary_type;
                $all[$key]->position       = (string)$dataXML->employee[$key]->position;
                $all[$key]->birthday       = (string)$dataXML->employee[$key]->birthday;
                $all[$key]->department_name = (string)$dataXML->employee[$key]->department_name;
            }
        }
        return $all;
    }
}