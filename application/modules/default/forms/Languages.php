<?php

class Default_Form_Languages extends Zend_Form
{
	// TODO
	// add more languages
	/*
		'fr'=>'Français',
		'de'=>'Deutsch',
		'it'=>'Italiano',
		'nl'=>'Nederlands',
		'pl'=>'Polski',
		'ru'=>'Русский'
	*/
    public function init()
    {

        $this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        $this->setAction($front->getBaseUrl().'/default/index/changelanguage');

        $refer = new Zend_Form_Element_Hidden('refer');
        $refer->setValue(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri());
		$refer->addDecorator('HtmlTag', array('tag' => 'div','class'=>'row'))
			->removeDecorator('label');

        $default = new Zend_Session_Namespace('default');
                
        $language = new Zend_Form_Element_Select('language');
		$language->setRequired(true)
                 ->setValue(@$default->language)
                 ->addValidator('NotEmpty', true)
                 //->setmultiOptions($this->_selectOptions())
                 ->setmultiOptions(array('es'=>'Español',
										'en'=>'English'
										))
				 ->setAttrib('onChange', "javascript:submit()")
                 ->setAttrib('maxlength', 200)
                 ->setAttrib('size', 1)
                 ->removeDecorator('label')
                 ->addDecorator('HtmlTag', array('tag' => 'div','class'=>'row'))
                 ;

       
		$this->setDecorators(array(
			    'FormElements',
				//array('HtmlTag', array('tag' => 'div', 'class' => 'search_form general_form')),
			    //array('Description', array('tag' => 'span', 'class'=>'formular_top')),			    
			    'Form',
			));
        
			$this->addElements(array($language, $refer));
        
    }


    // TODO
    // Make a autoselect reading xml file headers
    protected function _selectOptions()
    {
        $filter="";
    	// IF user in role.user
    	if ($this->_list['role']==$this->_iturismo->role->users)
    		$filter = " WHERE ITUR_OFICINAS.fk_cliente in (". implode(",", $this->_clients->getClientsPerUser()).")";

        $sql="SELECT pk_oficina, oficina_nombre
    	      FROM ITUR_OFICINAS".$filter;
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }

}