<?php

/**
 * This is the Data Mapper class for the Banners table.
 */
class Users_Model_Resources
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
            $this->_table = new Users_Model_DbTable_Resources;
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
        $module_name=$this->getModuleInfo($data['module_id']);
        $data['resource']=$module_name['module_name'].":".$data['resource'];
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
        $module=$this->getModuleInfo($data['module_id']);
        $data['resource']=$module['module_name'].":".$data['resource'];
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
    	$sql="SELECT uid, resource, name_r, acl_modules.module_name
    	      FROM acl_resources, acl_modules
    	      WHERE acl_resources.module_id = acl_modules.module_id
    	      ORDER by module_name 
    	      "; 
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	/**
     * Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSqlId($id)
    {   
    	$sql="SELECT uid, resource, name_r, acl_resources.module_id, acl_modules.module_name
    	      FROM acl_resources, acl_modules
    	      WHERE acl_resources.module_id = acl_modules.module_id AND
    	      		uid=".$id."
    	      ORDER by module_name 
    	      "; 
    	
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
    	$table=$table[$id];
    	return $table;
    }
    
	/**
     * Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getModuleInfo($id)
    {   
    	$sql="SELECT module_id, module_name
    	      FROM acl_modules
    	      WHERE module_id=".$id."
    	      "; 
    	$module = $this->getTable()->getAdapter()->fetchAssoc($sql);
    	return $module[$id];
    }
    
	/**
     * Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSqlIdClean($id)
    {   
    	$table=$this->fetchSqlId($id);
    	$table['resource']=substr($table['resource'],strpos($table['resource'],":")+1);
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
        $select = $table->select()->where('uid = ?', $id);
        return $table->fetchRow($select)->toArray();
    }
    
}