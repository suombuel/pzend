<?php

/**
 * Admin module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage default
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php
 */
class Frontend_Bootstrap extends Zend_Application_Module_Bootstrap
{

	/**
     *
     * @param mixed $key
     * @return Zend_Config
     */
//    protected function initConfiguration() {
//      // Todo
//      //Set config in bootstrap as application config
//
//       $configFile = dirname(__FILE__) . '/config.ini';
//       $config = new Zend_Config_Ini($configFile,'frontend');
//        //self::$_config=$config;
//        //return $config;
//
//         Zend_Registry::set("frontend", $config);
//          
//    }
//    
//    /**
//     * Initialize languages
//     *
//     * Read language content file.
//     * Store translate object in registry.
//     *
//     * @return void
//     */
//    protected function _initLang()
//    {
//	$translate = Zend_Registry::get('Zend_Translate');
//        $translate->addTranslation(dirname(__FILE__) .'/languages/views.xml', $_SESSION['default']['language']);
//        Zend_Registry::set('Zend_Translate', $translate);       
//    }

}
