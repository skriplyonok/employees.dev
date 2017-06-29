<?php

/**
 * Class Model_Db_Table_Employee
 */
class Model_Db_Table_Employee extends System_Db_Table
{
    /**
     * @param $limit
     * @param $offset
     * @param $department
     * @return array
     */
    public function getAll($limit = '', $offset = '', $department = '')
    {
        $limit = !empty($limit) ? ' limit ' . $limit : '';
        $offset = !empty($offset) ? ' offset ' . $offset : '';
        $department = !empty($department) ? ' where department.slug="' . $department . '"' : '';
        $sql = 'select employee.id, employee.firstname, employee.lastname, employee.middlename, employee.salary, employee.salary_type, employee.hours, employee.position, employee.birthday, department.name
          from employee JOIN department
          on employee.department_id = department.id'
            . $department
            . ' order by employee.id'
            . $limit
            . $offset;
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * @return array
     */
    public function getCount($department = ''){
        $limit = !empty($limit) ? ' limit ' . $limit : '';
        $offset = !empty($offset) ? ' offset ' . $offset : '';
        $department = !empty($department) ? ' where department.slug="' . $department . '"' : '';
        $sql = 'select count(*) from employee JOIN department
          on employee.department_id = department.id'
            . $department;
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}