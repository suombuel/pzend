<?php

/**
 * IndexController for users
 */
class Users_PermissionsController extends Zend_Controller_Action
{

	private $_acl = array();
	private $_destination;
	
	public function init()
    {   
        $this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
    }

   /**
   * IndexAction for users
   *
   * @return void
   */
    public function indexAction()
    {
        $this->view->title = "Resources";
			
        $model = new Users_Model_Permissions();
        //$this->view->entries = $model->fetchSql();

        $page=$this->_getParam('page',1);
    	$paginator = Zend_Paginator::factory($model->fetchSql());
    	$paginator->setItemCountPerPage(50);
    	$paginator->setCurrentPageNumber($page);    	
        $paginator->setPageRange(5);
    	$this->view->paginator = $paginator;
    }
    
   /**
   * addAction for users
   *
   * @return void
   */
    public function addAction()
    {
    	$this->view->headTitle(" :: Add New Resource", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Permissions();

        // check to see if this action has been POST'ed to
        if ($this->getRequest()->isPost()) {

            // check to see if the form submitted exists, and
            // if the values passed in are valid for this form
            if ($form->isValid($request->getPost())) {

                // integrating data sumitted via the form into the model
                $model = new Users_Model_Permissions();
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
    	$this->view->headTitle(" :: Edit Permissions", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Permissions(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Permissions();
                $id = $this->_getParam('permission_id', 0);
                                
                $model->update($form->getValues(),'permission_id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('permission_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Permissions();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }

	public function deleteAction()
    {
    	$this->view->headTitle(" :: Delete Permissions", 'APPEND');
        $request = $this->getRequest();

        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == $this->view->translate("Yes")) {
				$id = $this->_getParam('permission_id', 0);
				$model = new Users_Model_Permissions();
				$model->delete('permission_id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('permission_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Permissions();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }
    
	
    
}