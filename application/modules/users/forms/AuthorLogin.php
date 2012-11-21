<?php

class Users_Form_AuthorLogin extends Zend_Form
{

    public function init()
    {
        //$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/author/login');
		
    	$email = new Zend_Form_Element_Text('name');
		$email->setLabel('Email')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				//->addDecorator('HtmlTag', array('tag' => 'div'))
				->setOptions(array('class' => 'textarea_limit'))
				->addValidator('StringLength', false, array(3,80))
				->addValidator('emailAddress')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80)   
				->setOptions(array('class'=>'text')) 	
     			->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_text_login.phtml'
				))));


		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength', false, array(3,20))
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80)
				->setOptions(array('class'=>'text'))
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_text_login.phtml'
				))));
				        
		$remember = new Zend_Form_Element_Checkbox('remember');
		$remember->setDescription('remember me on this computer')
				 ->addDecorator('HtmlTag', array('tag' => 'label', 'class'=>'inline'))
				 ->addDecorator('Description', array('tag' => ''))
				 ->removeDecorator('label');
                                    
			
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('enviar')
				;
					
        $this->addElements(array($email,$password,$submit)); 
        $this->addDisplayGroup(array('submit'), 'buttons',
						        array('disableLoadDefaultDecorators' => true,
						                'decorators' => array(
														    'FormElements',
														    array('HtmlTag', array('tag' => 'ul','class' => 'form_menu'))
														)
						            ))
        	 				;  
             
        
    }

}

