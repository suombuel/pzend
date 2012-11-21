<?php

/**
 * RosourcesController.php is the resources controller
 *
 * This module implement acl and auth.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 iPTours. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   iptours
 * @package    Users
 * @subpackage file
 * @version    SVN $Id:$
 *
 */

/**
 * Users_ResourcesController
 *
 * @category   users
 * @uses       Zend_Controller_Action
 * @package    Users
 * @subpackage Controller
 *
 */
class Users_ResourcesController extends Zend_Controller_Action
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
        $this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
	$activeNav->active=true;
    }

    /**
     * Resources modules front.
     *
     * Show the resources and insert, update, delete controls.
     *
     * @return void
     */
    public function indexAction()
    {
        $this->view->title = "Resources";			
        $model = new Users_Model_Resources();
        //$this->view->entries = $model->fetchSql();

        $page=$this->_getParam('page',1);
    	$paginator = Zend_Paginator::factory($model->fetchSql());
    	$paginator->setItemCountPerPage(50);
    	$paginator->setCurrentPageNumber($page);    	
        $paginator->setPageRange(5);
    	$this->view->paginator = $paginator;
    	
    }
    
    /**
     * Add resources.
     *
     * @return void
     */
    public function addAction()
    {
    	$this->view->headTitle("Add New Resource", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Resources();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
               $model = new Users_Model_Resources();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        }
    	else {
			$form->populate($form->getValues());
		}
        $this->view->form = $form;
    }

    /**
     * Edit resources.
     *
     * @return void
     */
	public function editAction()
    {
    	$this->view->headTitle("Edit Resource", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Resources(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Resources();
                $id = $this->_getParam('uid', 0);
                $model->update($form->getValues(),'uid = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
        			$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('uid', 0);
			if ($id > 0) {
				$model = new Users_Model_Resources();
				$form->populate($model->fetchSqlIdClean($id));
			}
		}
        $this->view->form = $form;
    }

    /**
     * Delete resources.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Resource", 'APPEND');
        $request = $this->getRequest();

        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == $this->view->translate("Yes")) {
				$id = $this->_getParam('uid', 0);
				$model = new Users_Model_Resources();
				$model->delete('uid = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('uid', 0);
			if ($id > 0) {
				$model = new Users_Model_Resources();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }

    /**
     * List resources by role.
     *
     * @return      void
     */
	public function listresourcesAction()
    { 
		$this->view->title = "List Resources";
		$acl = Users_Model_Acl::getInstance(); 					
		$request = $this->getRequest();
                $form = new Users_Form_ListRoles();
		$form->populate($form->getValues());
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($request->getPost())) {
			    $form->populate($form->getValues());
			    $role_id=$form->getValue('role_id');
                        }
                }
                else {
			$form->populate($form->getValues());
			$role_id=0;
		}
		$this->view->form = $form;
                $this->view->list=$acl->listResourceByUser($role_id);
	}
}