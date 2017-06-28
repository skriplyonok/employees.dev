<?php

abstract class System_Db_Table
{
    protected $_table;
    
    /**
     * 
     * @var PDO $_connection
     *  
     */
    protected $_connection;
    
    public function __construct()
    {
        $this->_connection = System_Registry::get('connection');
        
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        $tableName = strtolower($arrExp[count($arrExp) - 1]);
        $this->_table = $tableName;
    }

    public function getConnection()
    {
        return $this->_connection;
    }
    
    public function getTable()
    {
        return $this->_table;
    }

    public function getAll($limit, $offset)
    {
        $limit = !empty($limit) ? ' limit ' . $limit : '';
        $offset = !empty($offset) ? ' offset ' . $offset : '';
        $sql    = 'select * from `' . $this->getTable() . '`' . $limit . $offset;
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function getCount(){
        $sql = 'select count(*) from `' . $this->getTable() . '`';
        $sth    = $this->getConnection()->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

