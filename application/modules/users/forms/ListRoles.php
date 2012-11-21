<?php

class Users_Form_ListRoles extends Zend_Form
{
	
    public function init()
    {    
        // set the method for the display form to POST
        $this->setMethod('Post');
           //  $this->_selectOptions();  	
		// add the id hidden element		
		
		$role_id = new Zend_Form_Element_Select('role_id');
		$role_id->setLabel('Roles')
						 ->setmultiOptions($this->_selectOptions())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setAttrib('onChange', "javascript:submit()")
						 ->setRequired(true)
						 ->setDecorators(array(array('ViewScript', array(
						    'viewScript' => 'forms/_element_select.phtml'
						 ))));				 
        
		$this->addElements(array($role_id));
    }
    
	protected function _selectOptions()
    {
        $sql="SELECT role_id, role_name
    	      FROM acl_roles";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
   
}