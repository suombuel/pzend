<?php

/**
 * This is the Data Mapper class for the Checks table.
 */
class Mailer_Model_Mailer
{
    
	protected $_mailer_config;
	
	
    public function __construct()
    {
    	$this->_mailer_config = Zend_Registry::get('mailer_config');	
    }
    
      
   	
   	
    
}