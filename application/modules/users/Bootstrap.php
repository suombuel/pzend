<?php

/**
 * Users module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  (c)2010 bcnActiva
 * @category   Acl.
 * @package    modules
 * @subpackage admin
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Users_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
	/**
     *
     * @param mixed $key
     * @return Zend_Config
     */
    protected function _initConfiguration() 
    {
		$configFile = dirname(__FILE__) . '/config.ini';
		$users_config = new Zend_Config_Ini($configFile,'users');
		Zend_Registry::set("users", $users_config);
    }

	protected function _initAcl()
    {
		$users=Zend_Registry::get('users');
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
    	$acl = Users_Model_Acl::getInstance();
        $front = Zend_Controller_Front::getInstance();
        require_once dirname(__FILE__) . '/controllers/plugin/Acl.php';
        $front->registerPlugin(new Users_Controller_Plugin_Acl($auth, $acl));      
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
