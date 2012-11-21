<?php

/**
 * ErrorController.php is the error controller for admin module
 *
 * This module generate error output with backtrace.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 iPTours. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   iptours
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: ErrorController.php 553 2009-09-17 15:39:21Z agustincl $
 *
 */

 /**
 * Admin_ErrorController
 *
 * @category   iptours
 * @uses       Zend_Controller_Action
 * @package    Admin
 * @subpackage Controller
 *
 */
class Admin_ErrorController extends Zend_Controller_Action 
{ 
    /**
     * Will be called by the "ErrorHandler" plugin.
     * Errorhandler will set the next dispatchable action to come here.
     *
     * @return void
     */
    public function errorAction() 
    { 
        $errors = $this->_getParam('error_handler'); 

        switch ($errors->type) { 
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER: 
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION: 
                $this->getResponse()->setHttpResponseCode(404); 
                $this->view->title = 'HTTP/1.1 404 Not Found';
                $this->view->message = 'Page not found'; 
                break; 
            default: 
                $this->getResponse()->setHttpResponseCode(500); 
                $this->view->message = 'Application error'; 
                break; 
        } 

        // pass the environment to display more/less information
        $this->view->env       = getenv('APPLICATION_ENV');                
        $this->view->exception = $errors->exception;        
        $this->view->request   = $errors->request; 
    }
}