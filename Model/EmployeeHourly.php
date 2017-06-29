<?php

/**
 * Class Model_EmployeeHourly
 */
class Model_EmployeeHourly extends Model_Employee
{
    /**
     * @var int
     */
    public $hours;
    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary * $this->hours;
    }
}