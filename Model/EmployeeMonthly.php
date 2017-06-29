<?php

/**
 * Class Model_EmployeeMonthly
 */
class Model_EmployeeMonthly extends Model_Employee
{
    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }
}