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
     * @var string
     */
    public $slug;
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
                $all[$key]->id        = $value->id;
                $all[$key]->name      = $value->name;
                $all[$key]->slug      = $value->slug;
            }
        }
        return $all;
    }
}