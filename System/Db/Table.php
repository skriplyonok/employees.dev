<?php

/**
 * Class System_Db_Table
 */
abstract class System_Db_Table
{
    /**
     * @var string
     */
    protected $_table;
    
    /**
     * 
     * @var PDO $_connection
     *  
     */
    protected $_connection;

    /**
     * System_Db_Table constructor.
     */
    public function __construct()
    {
        $this->_connection = System_Registry::get('connection');
        
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        $tableName = strtolower(end($arrExp));
        $this->_table = $tableName;
    }

    /**
     * @return false|mixed|PDO
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }


    /**
     * @param string $limit
     * @param string $offset
     * @param string $department
     * @return array
     */
    public function getAll($limit = '', $offset = '', $department = '')
    {
        $sql    = 'select * from `' . $this->getTable() . '`';
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * @return array
     */
    public function getCount(){
        $sql = 'select count(*) from `' . $this->getTable() . '`';
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

