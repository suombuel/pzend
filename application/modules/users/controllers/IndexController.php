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
class Users_IndexController extends Zend_Controller_Action
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
    	
    	$this->view->headScript()->appendFile('http://maps.google.com/maps?file=api&v=2&sensor=true&key=ABQIAAAA7uxAB0pck1E-x3C4uFR8KBQp6S42PI62R5fPwnDC_Fv1yRauwhR7aPui_AAx9txDoNsh7RYYwKOjcQ');
		$this->view->headScript()->appendScript('  var map = null;
		        var geocoder = null;
		
		        function initialize() {
		          if (GBrowserIsCompatible()) {
		            map = new GMap2(document.getElementById("map_canvas"));
		            map.setCenter(new GLatLng(37.4419, -122.1419), 13);
		            geocoder = new GClientGeocoder();
		          }
		        }
		
		        function showAddress(address) {
		          if (geocoder) {
		            geocoder.getLatLng(
		              address,
		              function(point) {
		                if (!point) {
		                  alert(address + " not found");
		                } else {
		                  map.setCenter(point, 13);
		                  var marker = new GMarker(point);
		                  map.addOverlay(marker);
		                  marker.openInfoWindowHtml(address);
		                }
		              }
		            );
		          }
		        }
		    ');
		
    	
    	
    }
    
    
 	
    

   
    	
}