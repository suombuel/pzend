<?php

class Zend_View_Helper_NavMenu
{

    public $view = null;

  

    public function navMenu()
    {
		// Ussing a xml file
        //$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
		//$navigation = new Zend_Navigation($config);

        $acl = Users_Model_Acl::getInstance();
		$resources=$acl->getArrayResourceNavByUser();
		$navigation = new Zend_Navigation($resources);
		
        return $navigation;
	}


}