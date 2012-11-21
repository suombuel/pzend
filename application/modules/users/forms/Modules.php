<?php

class Users_Form_Modules extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('module_id');
		$uid->removeDecorator('label');
		
       	$module_name = new Zend_Form_Element_Text('module_name');
		$module_name->setLabel('Name')
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
		
		$this->addElements(array($uid,$module_name,$submit));
    }

}