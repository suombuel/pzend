<?php

/**
 * This is the Data Mapper class for the Banners table.
 */
class Users_Model_Permissions
{
    /** Model_Resosurces_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Iturismo_Table
     */
    public function getTable()
    {
        if (null === $this->_table) {
            $this->_table = new Users_Model_DbTable_Permissions;
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
     * Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql()
    {   
    	$sql="SELECT permission_id, permission, name, menu, acl_roles.role_name, acl_resources.resource
    	      FROM acl_permissions, acl_roles, acl_resources
    	      WHERE acl_permissions.role_id = acl_roles.role_id AND
    	      		acl_permissions.resource_uid = acl_resources.uid 
    	      "; 
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
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
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id)
    {
        $table = $this->getTable();
        $select = $table->select()->where('permission_id = ?', $id);
        return $table->fetchRow($select)->toArray();
    }
    
}