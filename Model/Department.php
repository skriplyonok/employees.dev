<?php

/**
 * Class Model_Department
 */
class Model_Department
{

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    /**
     * @return Model_Department[]
     */
    public static function getAll()
    {
        $dbDepartment = new Model_Db_Table_Department();
        $data = $dbDepartment->getAll();
        $all = [];
        if(!empty($data))
        {
            foreach ($data as $key => $value) {
                $all[$key]  = new self();
                $all[$key]->id             = isset($value->id) ? $value->id : null;
                $all[$key]->name      = $value->name;
            }
        }
        return $all;
    }
}