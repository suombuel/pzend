<?php

/**
 * This is the Data Mapper class for the Checks table.
 */
class Admin_Model_Checks
{
    
	protected $_admin_config;
	
	
    public function __construct()
    {
    	$this->_admin_config = Zend_Registry::get('admin_config');	
    }
    
     	
   	/**
     * Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */
   	public function checkBlogPaths()
   	{
   		
   		$blog=Zend_Registry::get('blog');
   		foreach($blog as $key => $value){   		
			// Check Paths
   			if($value->path){
	   			$perm=substr(sprintf('%o', fileperms(realpath($value->path))), -4);
	   			try {
					if ($perm<$this->_admin_config->directory->permissions->blog) {
				        throw new Exception('( '.$perm.' '.realpath($value->path).') DIRECTORY NOT WRITABLE. o+w Needed.', false);
				    }
				    else
				    	throw new Exception('( '.$perm.' '.realpath($value->path).') DIRECTORY Good.', true);
			    } catch (Exception $e) {
			        $out[$key] = array('code'=>$e->getCode(), 'message'=>$e->getMessage());
			    }
			}
			
		}
		return $out;
   	}    
   	
   	
    
}