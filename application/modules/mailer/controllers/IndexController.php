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
class Mailer_IndexController extends Zend_Controller_Action
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
                $this->view->title = "Mailer";
                $model = new Mailer_Model_Mailer();
//				$this->view->entries = $model->fetchEntries();
    }

	public function sendlistAction()
    {
                $this->view->title = "Index";
    }

	public function makelistAction()
    {
                $this->view->title = "Index";
    }
    
	public function filldbAction()
    {				
		$this->view->headTitle("Fill Db", 'APPEND');
        $request = $this->getRequest();
        $form    = new Mailer_Form_Mailer();
    	$form->submit->setLabel('Save');
   		   	
    	        
    	if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
            	
            	
            	/* Uploading Document File on Server */
				 $upload = new Zend_File_Transfer_Adapter_Http();
				 $upload->setDestination("/uploads/files/");
				 try {
				 // upload received file(s)
				 $upload->receive();
				 } catch (Zend_File_Transfer_Exception $e) {
				 $e->getMessage();
				 }
            	
 
            	
                $model = new Users_Model_Modules();
                $id = $this->_getParam('module_id', 0);
                $model->update($form->getValues(),'module_id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('module_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Modules();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }
    

}