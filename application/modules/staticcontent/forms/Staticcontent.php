<?php

class Staticcontent_Form_Staticcontent extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('module_id');
        
		$uid->removeDecorator('label');
		$acl_users_uid = new Zend_Form_Element_Hidden('acl_users_uid');
		$acl_users_uid->setValue(Zend_Auth::getInstance()->getIdentity()->uid);
		
       	$order = new Zend_Form_Element_Text('order');
		$order->setLabel('Order')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				;
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
		$title = new Zend_Form_Element_Text('tittle');
		$title->setLabel('Titulo')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
		
		$content_es = new Zend_Form_Element_Textarea('content_es');
		$content_es->setLabel('Content Es')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('rows', 5)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
		$content_en = new Zend_Form_Element_Textarea('content_en');
		$content_en->setLabel('Content En')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('rows', 5)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
				
	 	$content_ca = new Zend_Form_Element_Textarea('content_ca');
		$content_ca->setLabel('Content Ca')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 25)				
				->setAttrib('rows', 5)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text'))
				; 
		
	 	$action = new Zend_Form_Element_Select('acl_permissions_permission_id');
		$action->setLabel('Status')
						 ->setmultiOptions($this->_selectOptionsActions())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
						 ; 		
						 
						 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
				->removeDecorator('label');
		
		$this->addElements(array($uid,$acl_users_uid,$order,$name,$title,
									  $content_es,$content_en,
									  $content_ca,$action,$submit));
    }
    
	protected function _selectOptionsActions()
    {
        $sql="SELECT  acl_permissions.permission_id as uid, concat(resource,':',permission) as action
    	      FROM acl_resources, acl_permissions
    	      WHERE acl_resources.uid= acl_permissions.resource_uid
    	      ORDER BY resource";
//        Zend_Debug::dump($sql);die;
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }

}