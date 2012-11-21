<?php

/**
 * Default_IndexController is the default controller for default module
 *
 * This module is required. Is the default module of the entire site.
 * Is used to operate a jump to the iptours old index file.
 *
 * @author     AgustÃ­n CalderÃ³n <agustincl@gmail.com>
 * @copyright  Copyright 2009 iPTours. All Rights Reserved.
 * @category   Module
 * @package    Default
 * @subpackage Controller
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @version    SVN $Id: IndexController.php 553 2009-09-17 15:39:21Z agustincl $
 * 
 */

class Default_IndexController extends Zend_Controller_Action
{
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {        
    	//$this->_redirect ( "/index.php" );        
        //$this->_forward('index', 'index', 'frontend');
//        Zend_Debug::dump($_SERVER, "server", true);

        Zend_Debug::dump($_SESSION, "session", true);
        
    }
    
	public function changelangAction() 
    {        
       	Zend_Debug::dump("por aqui esta pasando");
       	Zend_Debug::dump($_SESSION, "session", true);
       	
       	
       	//die;
		$lang = $this->_getParam('lang', 0);
		Zend_Debug::dump($lang, "lang", true);
		$_SESSION['default']['locale']=$_SESSION['default']['locale'];
		$_SESSION['default']['language']=$lang;
//$this->_forward('index', 'index', 'default');
       	$this->_redirect($_SERVER['HTTP_REFERER']); 
    }
    
	 public function __call($method, $args)
	{
	    // If an unmatched 'Action' method was requested, pass on to the
	    // default action method:
	        if ('Action' == substr($method, -6)) {
	            return $this->defaultAction();
	        }
	
	        throw new Zend_Controller_Exception('Invalid method called');
	    }


    public function changelanguageAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);

        $request = $this->getRequest();
        $form = new Default_Form_Languages();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {            	
            	$locale = new Zend_Locale($request->getPost('language'));            	
                $default = new Zend_Session_Namespace('default');
                $default->language = $locale->getLanguage();
                $default->locale = $locale->getRegion();                                
                $this->_redirect($request->getPost('refer'));
            }
        }
    	else {
			return;
		}
        return;       
    }
}
