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
 * Users_IndexController
 *
 * @category   iptours
 * @uses       Zend_Controller_Action
 * @package    Admin
 * @subpackage Controller
 * 
 */
class Users_RolesController extends Zend_Controller_Action
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
     * Index users front. Welcome layout.
     *
     * @return      void
     */
    public function indexAction()
    {        
    	$this->view->title = "Users Index";
    	$model = new Users_Model_Roles();
		$this->view->entries = $model->fetchEntries();
    }
    
    public function addAction()
    {
    	$this->view->headTitle("Add New User", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Roles();

        // check to see if this action has been POST'ed to
        if ($this->getRequest()->isPost()) {
			
            // check to see if the form submitted exists, and
            // if the values passed in are valid for this form
            if ($form->isValid($request->getPost())) {
            	
                // integrating data sumitted via the form into the model
                $model = new Users_Model_Roles();
                $model->save($form->getValues());

                // "redirect after post" to a new location
                return $this->_helper->redirector('index');
            }
        }
    	else {
			$form->populate($form->getValues());
		}

        // assign the form to the view
        $this->view->form = $form;
    }
        
	public function editAction()
    {
    	$this->view->headTitle("Edit Users", 'APPEND');
        $request = $this->getRequest();
        $form    = new Users_Form_Roles();
    	$form->submit->setLabel('Save');
   		   	
    	
        
    	if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Roles();
                $id = $this->_getParam('role_id', 0);
                $model->update($form->getValues(),'role_id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('role_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Roles();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }
    
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Client", 'APPEND');
        $request = $this->getRequest();
		
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == $this->view->translate("Yes")) {
				$id = $this->_getParam('role_id', 0);
				$model = new Users_Model_Roles();
				$model->delete('role_id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('role_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Roles();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }
 	
    

   
    	
}