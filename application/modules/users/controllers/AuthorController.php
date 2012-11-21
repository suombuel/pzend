<?php

class Users_AuthorController extends Zend_Controller_Action
{

    public function loginAction()
    {		
	$this->_helper->layout->setLayout('login');			// Change layout    	
	//Zend_Debug::dump($_SERVER);
    	$this->view->headTitle("Admin Panel", 'APPEND');
        $request = $this->getRequest();
    	
        $form    = new Users_Form_AuthorLogin();
        $form->setName('registration');
    	
    	
        if (!$this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        } elseif (!$form->isValid($_POST)) {
            $this->view->failedValidation = true;
            $this->view->form = $form;
            return;
        }
             
        $values = $form->getValues();
		

        // Setup DbTable adapter
        $adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
        $adapter->setTableName('acl_users');
        $adapter->setIdentityColumn('email');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($values['name']);
        $adapter->setCredential(
            hash('SHA256', $values['password'])
        );
	
        //$rowset   = $table->fetchRow("email ='".$values['email']."'");
        
        
        // authentication attempt
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
		
        
        $table = new Users_Model_DbTable_Users;
        // authentication succeeded
        if ($result->isValid()) {            
        	
        	$status=$adapter->getResultRowObject()->status;
        	//Zend_debug::dump($status);
        	
        	if($status==1){
        		
                    $auth->getStorage()
	                	 ->write($adapter->getResultRowObject(null, 'password'));
	            	$this->view->passedAuthentication = true;  

                    $rowset   = $table->fetchRow("email ='".$values['name']."'");
                    $role = new Users_Model_DbTable_Roles;
                    $rowset_role   = $role->fetchRow("role_id ='".$rowset['role_id']."'");
					
                    $this->_redirect($rowset_role['prefered_uri']);
                    return;
        	}
        	else{
        		$this->view->statusState = true;
        		$this->view->email=$values['name'];
        	}
            
            
        } else { // or not! Back to the login page!
            $this->view->failedAuthentication = true;
            

        	$rowset   = $table->fetchRow("email ='".$values['name']."' and status=1");
			$rowCount = count($rowset);
		if ($rowCount > 0) {
			    //echo "found $rowCount rows";
			    $this->view->email=$values['name'];

                    
                    $this->view->emailExist = true;
			} else {				
                            $this->_helper->redirector('index', 'index', 'admin');    
			}                        
            $this->view->loginForm = $form;
        }
        
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
    	Zend_Session::destroy();
        $this->_helper->redirector('index', 'index', 'frontend');
    }
    

}