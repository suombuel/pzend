<?php

class Users_Form_Permissions extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $permission_id = new Zend_Form_Element_Hidden('permission_id');
        $permission_id->addDecorator('HtmlTag', array('tag' => 'div','class'=>'row'))
					  ->removeDecorator('label');

		$role_id = new Zend_Form_Element_Select('role_id');
		$role_id->setLabel('Role')
						 ->setmultiOptions($this->_selectOptionsRoles())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
						 ; 
		
		$resource_uid = new Zend_Form_Element_Select('resource_uid');
		$resource_uid->setLabel('Resource')
						 ->setmultiOptions($this->_selectOptionsResources())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
						 ; 
						 				 
	    $permission = new Zend_Form_Element_Text('permission');
		$permission->setLabel('Permission')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength', false, array(3,50))
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				;

		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				;

		$menu = new Zend_Form_Element_Select('menu');
		$menu->setLabel('Status')
						 ->setmultiOptions(array('1'=>'Activo', '0'=>'Inactivo'))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
						 ; 							
				
        $this->setDecorators(array(
			    'FormElements',
				array('HtmlTag', array('tag' => 'div', 'class' => 'search_form general_form')),
			    array('Description', array('tag' => 'span', 'class'=>'formular_top')),			    
			    'Form',
			));		
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
				->removeDecorator('label');
				
		$this->addElements(array($permission_id,$role_id,$resource_uid,$permission,$name,$menu,$submit));
    }

	protected function _selectOptionsRoles()
    {
        $sql="SELECT role_id, role_name
    	      FROM acl_roles
    	      ORDER BY role_id";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
	
	protected function _selectOptionsResources()
    {
        $sql="SELECT uid, resource
    	      FROM acl_resources
    	      ORDER BY resource";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
}