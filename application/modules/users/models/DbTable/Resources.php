<?php

/**
 * This is the DbTable class for the Banners table.
 */
class Users_Model_DbTable_Resources extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'acl_resources';
    /** Primary key */
    protected $_primary = 'uid';

    /**
     * Insert new row
     *
     * Ensure that a timestamp is set for the created field.
     * 
     * @param  array $data 
     * @return int
     */
    public function insert(array $data)
    {
        //$data['banner_fecha_registro'] = date('Y-m-d H:i:s');
        return parent::insert($data);
    }

    /**
     * Update row(s)
     *
     * Do not allow updating of entries
     * 
     * @param  array $data 
     * @param  mixed $where 
     * @return void
     * @throws Exception
     */
    public function update(array $data, $where)
    {     
        return parent::update($data,$where);    	
    }
    
    /**
     * delete row(s)         
     * 
     * @param  array $data 
     * @return int
     */
    public function delete($where)
    {
        return parent::delete($where);
    }
    
}