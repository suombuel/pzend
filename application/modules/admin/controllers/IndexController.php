<?php

/**
 * IndexController.php is the default controller for admin module
 *
 * This module is required. Is the admin default module of
 * backend. Is used for very simple administration tasks.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 iPTours. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   iptours
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: IndexController.php 553 2009-09-17 15:39:21Z agustincl $
 *
 */

/**
 * Admin_IndexController
 *
 * @category   iptours
 * @uses       Zend_Controller_Action
 * @package    Admin
 * @subpackage Controller
 * 
 */
class Admin_IndexController extends Zend_Controller_Action
{

    /**
     * Initialize controller
     * 
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     * Read menu from config file and send to navigation object.
     *
     * @return void
     */
    public function init()
    {
                $this->_helper->layout->setLayout('layout_backend');			// Change layout
                $uri = $this->_request->getPathInfo();
                $activeNav = $this->view->navigation()->findByUri($uri);
                $activeNav->active=true;
                $confignav = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation_admin.xml', 'nav');
                $container = new Zend_Navigation($confignav);
    }

    /**
     * Index admin front. Welcome layout.
     *
     * @return      void
     */
    public function indexAction()
    {
                $this->view->title = "Index";
    }

    /**
     * List all resources.
     *
     * @return      void
     */
    public function listresourcesAction()
    { 
		$this->view->title = "List Resources";
		$acl = Users_Model_Acl::getInstance(); 					
		$this->view->list=$acl->listResourceByUser();
    }

    /**
     * Check configuration values.
     *
     * @return      void
     * @todo        Automatize reading config file from currents modules
     */
    public function checkconfigAction()
    {
        $this->view->title = "Check Config";
		$out=array();
        $checks = new Admin_Model_Checks; 		
//		$out['blog']=$checks->checkBlogPaths();
		
		$this->view->out=$out;
    }
    	
}