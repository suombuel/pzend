<?php

/**
 * This is the DbTable class for the Users table.
 */
class Staticcontent_Model_DbTable_Staticcontent extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'static_content';
    /** Primary key */
    protected $_primary = 'id';

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