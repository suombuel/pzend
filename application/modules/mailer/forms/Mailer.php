<?php

class Mailer_Form_Mailer extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');       
		
       	$mails = new Zend_Form_Element_Textarea('mails');
		$mails->setLabel('Mails')
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 15)
				->setAttrib('rows', 10)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
		$filemails = new Zend_Form_Element_File('filemails');
		$filemails->setLabel('TXT with mails')
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
				->removeDecorator('label');
		
		$this->addElements(array($mails,$filemails,$submit));
    }

}