<?php

class Users_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    protected $_auth = null;
    protected $_acl = null;

    public function __construct()
    {
        $users=Zend_Registry::get('users');        
        $this->_auth = Zend_Auth::getInstance();
        $this->_auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
        $this->_acl = Users_Model_Acl::getInstance();             
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {

        $module = $request->module;
        $resource = $request->controller;
        $permission = $request->action;
        		
        // TODO
        // Clean the module:resource from the acl... but how???

    	if (!$this->_acl->has($module.":".$resource)) {
            $resource = null;
        }
        else{
        	$resource=$module.":".$resource;
        }
      
       	if($this->_auth->getIdentity()){
			$role=$this->_acl->getRoleName($this->_auth->getIdentity()->role_id);
			$this->_acl->_UserRoleName=$role->role_name;
			$this->_acl->_UserRoleId=$this->_auth->getIdentity()->role_id;
       	}
		
        if (@!$this->_acl->isAllowed($this->_acl->_UserRoleName,$resource, $permission)) {
            if ($this->_auth->hasIdentity()) {
                // authenticated, denied access, forward to denied page
                $request->setModuleName('users');
                $request->setControllerName('error');
                $request->setActionName('denied');
                //echo "si";
            } else {
                // not authenticated, forward to login page
				$request->setModuleName('users');
                $request->setControllerName('author');
                $request->setActionName('login');
                //echo "no";
            }
        }
        else {
        	//echo "ni uno ni otro";        	
        }
    }  

	
	
    
}