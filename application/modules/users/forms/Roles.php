<?php

class Users_Form_Roles extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('role_id');
		$uid->removeDecorator('label');
		
       	$role_name = new Zend_Form_Element_Text('role_name');
		$role_name->setLabel('Role name')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
		$role_parents = new Zend_Form_Element_Text('role_parents');
		$role_parents->setLabel('Role parents')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				;
				
		$prefered_uri = new Zend_Form_Element_Text('prefered_uri');
		$prefered_uri->setLabel('Prefered uri')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
		


		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
				->removeDecorator('label');
		
		$this->addElements(array($uid,$role_name,$role_parents,$prefered_uri,$submit));
    }

}