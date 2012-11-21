<?php

/**
 * Admin module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage admin
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
	/**
     *
     * @param mixed $key
     * @return Zend_Config
     */
    protected function _initConfiguration() 
    {
		$configFile = dirname(__FILE__) . '/config.ini';
		$admin_config = new Zend_Config_Ini($configFile,'admin');
		Zend_Registry::set("admin_config", $admin_config);
    }

	/**
     * Initialize languages
     *
     * Read language content file.
     * Store translate object in registry.
     *
     * @return void
     */
    protected function _initLang()
    {
	$translate = Zend_Registry::get('Zend_Translate');
        $translate->addTranslation(dirname(__FILE__) .'/languages/views.xml', $_SESSION['default']['language']);
    }



}
