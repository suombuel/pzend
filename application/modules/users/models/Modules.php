<?php

class Users_Model_Modules extends Zend_Db_Table
{

   
    /** Model_Users_Table */
    protected $_table;

    public function getNumberOf($number)
    {
        if ($number <= 0) {
            throw new Zend_Db_Table_Exception('The number of items to retrieve cannot be zero or less');
        }
        $select = $this->select()
            ->from($this, array('uid','user_name','email','password','date','status','person_id','validation_code',
                'has_extended','comment_count'))
            ->order('date DESC')
            ->limit($number);
        return $this->fetchAll($select);
    }



    /**
     * Retrieve table object
     *
     * @return Model_Users_Table
     */
    public function getTable()
    {
        if (null === $this->_table) {
            //require_once APPLICATION_PATH . '/modules/iturismo/models/DbTable/Banners.php';
            $this->_table = new Users_Model_DbTable_Modules;
        }
        return $this->_table;
    }

    /**
     * Save a new entry
     *
     * @param  array $data
     * @return int|string
     */
    public function save(array $data)
    {
        $table  = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $table->insert($data);
    }

	/**
     * Update entry
     *
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function update(array $data, $where)
    {
		$table  = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $table->update($data, $where);
    }

	/**
     * Delete entries
     *
     * @param  array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function delete($where)
    {
		$table  = $this->getTable();
        return $table->delete($where);
    }

    /**
     * Fetch all entries
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries()
    {
        return $this->getTable()->fetchAll('1')->toArray();
    }

	/**
     * Fetch all sql entries
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql()
    {
        $sql="SELECT uid, user_name, password, email,status, phone, acl_roles.role_name
    	      FROM acl_users, acl_roles
    	      WHERE acl_users.role_id = acl_roles.role_id AND
                    acl_roles.role_name!='Implementor' AND acl_roles.role_name!='Everyone'
    	      "; 
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }

    /**
     * Fetch an individual entry
     *
     * @param  int|string $id
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id)
    {
        $table = $this->getTable();
        $select = $table->select()->where('module_id = ?', $id);
        return $table->fetchRow($select)->toArray();
    }
}




