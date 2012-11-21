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
class Staticcontent_IndexController extends Zend_Controller_Action
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
	
	private $_model="Staticcontent_Model_Staticcontent";
	private $_form="Staticcontent_Form_Staticcontent";
	
    public function init()
    {
        $this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri = $this->_request->getPathInfo();
        $activeNav = $this->view->navigation()->findByUri($uri);
        $activeNav->active=true;
        $confignav = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation_admin.xml', 'nav');
        $container = new Zend_Navigation($confignav);
    }
   
	public function indexAction()
    {        
    	$this->view->title = "CMS";
    	$model = new $this->_model();
		$this->view->entries = $model->fetchEntries();
    }
    
    public function addAction()
    {
    	$this->view->headTitle("Add New static content", 'APPEND');
        $request = $this->getRequest();
    	$form    = new $this->_form();
    	
        // check to see if this action has been POST'ed to
        if ($this->getRequest()->isPost()) {
			
            // check to see if the form submitted exists, and
            // if the values passed in are valid for this form
            if ($form->isValid($request->getPost())) {
            	
                // integrating data sumitted via the form into the model
                $model = new $this->_model();
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
    	$this->view->headTitle("Edit static content", 'APPEND');
        $request = $this->getRequest();
        $form    = new $this->_form();
    	$form->submit->setLabel('Save');
   		   	
    	        
    	if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new $this->_model();
                $id = $this->_getParam('id', 0);
                $model->update($form->getValues(),'id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$model = new $this->_model();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }
    
	public function deleteAction()
    {
    	$this->view->headTitle("Delete static content", 'APPEND');
        $request = $this->getRequest();
		
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == $this->view->translate("Yes")) {
				$id = $this->_getParam('id', 0);
				$model = new $this->_model();
				$model->delete('module_id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$model = new $this->_model();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }
   
    	
}