<?php

/**
 * IndexController.php is the default controller for users module
 *
 * This module implement acl and auth.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 iPTours. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   iptours
 * @package    Users
 * @subpackage file
 * @version    SVN $Id: IndexController.php 553 2009-09-17 15:39:21Z agustincl $
 *
 */

/**
 * Users_IndexController
 *
 * @category   iptours
 * @uses       Zend_Controller_Action
 * @package    Users
 * @subpackage Controller
 *
 */
class Frontend_IndexController extends Zend_Controller_Action 
{
	
	/**
     * Initialize controller
     *
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     *
     * @return void
     */
	public function init()
    {   
  		// Change layout
    	$this->_helper->layout->setLayout('layout_frontend');			
  		$uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
        $activeNav->active=true;
    }

    /**
     * Roles modules front.
     *
     * Show the roles and insert, update, delete controls.
     *
     * @return void
     */
    public function indexAction()
    {
    	$this->view->title = "Index";
		$this->view->image="/styles/css/images/img02.jpg";
		$model = new Staticcontent_Model_Staticcontent();
		Zend_Debug::dump($_SESSION);
		$this->view->entries = $model->fetchSql($_SESSION['default']['language']);

        //$model = new Blog_Model_Entries();
        //$this->view->entries = $model->fetchSelect(3);	        
    }
    
	public function indexnewsAction()
    {
    	$this->view->title = "Index";
    	$this->view->image="/assets/images/tioplaya.jpg";
    	//$model = new Blog_Model_Entries();
        //$this->view->entries = $model->fetchSelect(3);	        
    }
    
 	/**
     * View user.
     *
     * @return      void
     */
	public function viewblogAction()
    {
       	$this->view->headTitle("Blog view", 'APPEND');
    	
    	$model = new Blog_Model_Entries();
    	$id = $this->_getParam('id', 0);
    	$mod= $this->_getParam('mod', 0);
    	$des= $this->_getParam('des', 0);
    	//Zend_Debug::dump($id, "id");
    	
    	$row = $model->fetchEntry((int)$id);
    	//Zend_Debug::dump($row);
        $this->view->entry = $row;
    }
    
}