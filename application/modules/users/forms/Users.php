<?php

class Users_Form_Users extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('uid');
		$uid->removeDecorator('label');
		
       	$user_name = new Zend_Form_Element_Text('user_name');
		$user_name->setLabel('Name')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_text.phtml'
				)))); 

				
	
//		$password1 = new Zend_Form_Element_Password('password1');
				
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
//				->addValidator('identical', false, array('token' => 'elementOne'))
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,20))
				->setAttrib('size', 25)
				->setAttrib('maxlength', 80)
				->setOptions(array('class'=>'text'))
				; 
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,200))
				->addValidator('emailAddress', true)
				->setAttrib('size', 25)
				->setAttrib('maxlength',80)
				->setOptions(array('class'=>'text'))
				; 

		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions(array('1'=>'Activo', '0'=>'Inactivo'))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ; 
						 
	
        $phone = new Zend_Form_Element_Text('phone');
		$phone->setLabel('Phone')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'textagustin'))
				; 

		$role_id = new Zend_Form_Element_Select('role_id');
		$role_id->setLabel('Role')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions($this->_selectOptions())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
				->removeDecorator('label');
		
		$this->addElements(array($uid,$user_name,$password,$email,$status,
								 $phone,$role_id,$submit));
    }

	protected function _selectOptions()
    {
        $sql="SELECT role_id, role_name
    	      FROM acl_roles
              ";

        $db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
	
	public function editUser()
	{
        $this->removeElement('password'); 
        return;
		
    }
    
	public function editPassword()
	{
        $this->removeElement('user_name');
        	$this->removeElement('email');
        	$this->removeElement('status');
        	$this->removeElement('phone');
       	 	$this->removeElement('role_id');
        return; 
    }
    
}