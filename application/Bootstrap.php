<?php

/**
 * Application bootstrap
 * 
 * @uses    Zend_Application_Bootstrap_Bootstrap
 * @package QuickStart
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap autoloader for application resources
     * 
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
    	$autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }

    /**
     * Bootstrap the view doctype
     * 
     * @return void
     */
//    protected function _initDoctype()
//    {
//    	$this->bootstrap('view');
//        $view = $this->getResource('view');
//        $view->doctype('XHTML1_STRICT');
//    }
    
	protected function _initFrontRegistry()
    {
         $front = $this->bootstrap('frontController')->getResource('frontController');
         $front->setParam('registry', $this->getContainer());
         
         //$router = $front->getRouter();
         //$router->addRoutes(self::_assembleRoutes());
        
        
    }
 	
	/**
     * Bootstrap the view 
     * 
     * @return void
     */
    protected function _initView()
    {
        // Initialize view
        //$view = new Zend_View();
        
        $this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		
        $view->doctype('XHTML1_TRANSITIONAL');
        $view->headTitle('bcnActiva');
        $view->headTitle()->setSeparator(' :: ');
               
        // Enable dojo on layout
        $view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_NavMenu');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_AclLink'); 
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_SwfObject');        
        
        $view->addBasePath(APPLICATION_PATH . '/views'); 
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    
 	protected function _initDatabase()
   	{
   		// Multi
//   		$this->bootstrapDb();
//		$this->bootstrap('multidb');
   		$resource = $this->getPluginResource('multidb');
	 	
//	 	$db1 = $resource->getDb('db');
//	 	$defaultDb = $resource->getDb();

//	 	$db = $resource->getDb('db');
//       	$db = $this->getResource('db');
//       	$db->setFetchMode(Zend_Db::FETCH_OBJ);
//       	$db->query("SET NAMES 'utf8'");
//       	$db->query("SET CHARACTER SET 'utf8'");
//		Zend_Registry::set("db", $db); 
   		
   		$this->bootstrapDb();
       	$db = $this->getResource('db');
       	$db->setFetchMode(Zend_Db::FETCH_OBJ);
       	$db->query("SET NAMES 'utf8'");
       	$db->query("SET CHARACTER SET 'utf8'");
		Zend_Registry::set("db", $db);        
       	return $db;
   	}

    protected function _initSession()
    {
		Zend_Session::start();
		$zfip = new Zend_Session_Namespace('ZfSession');
	}
	
 	protected function _initNavigation()
    {
		$this->bootstrap('layout');
                $config = $this->getOptions();
                $layout = $this->getResource('layout');
		$view = $layout->getView();
		$confignav = new Zend_Config_Xml($config['navigationmenu'], 'nav');
		$container = new Zend_Navigation($confignav);
		
		//Zend_Debug::dump($container->toArray());
		//Zend_Debug::dump($container);
		//die;
		$view->navigation($container);
	}

    protected function _initLocale()
     {             	
     	$locale = new Zend_Locale();
     	$config = $this->getOptions();     	
     	$defaultLocale = $config['lang_local'];
        
		// FIXME
		// sesion null make me crash.
        try {
            $locale = new Zend_Locale('auto');
        } catch (Zend_Locale_Exception $e) {
            $locale = new Zend_Locale($defaultLocale);
        }
        
        if(!isset($_SESSION['default']['locale']))
            $_SESSION['default']['locale']=$locale->getRegion();
        if(!isset($_SESSION['default']['language']))
            $_SESSION['default']['language']=$locale->getLanguage();
		//Zend_Registry::set('Zend_Locale', $locale);
        
     }

     protected function _initLang()
     {
        // TODO
        // Set cache for speedup
        //$cache = Zend_Cache::factory('Core','File');
        //Zend_Translate::setCache($cache);

        $translate = new Zend_Translate('tmx', dirname(__FILE__) .'/languages/info.xml', $_SESSION['default']['language']);
		Zend_Registry::set('Zend_Translate', $translate);       
     }
     
 	protected function assembleRoutes() 
    {
        $routes = array();
        $routes['entry']  = new Zend_Controller_Router_Route_Regex(
            '^(blog/)+[0-9a-z\.\_!;,\+\-\%]+-(\d+)',
        	array(
                'module' => 'frontend',
                'controller' => 'index',
                'action'     => 'viewblog'
            ),
            array(
                'mod' => 1,
            	'id' =>2,
            	'des' =>3
            ),
            'blog/index'
        );
// returns a rewrite router by default
      $ctrl  = Zend_Controller_Front::getInstance();
	  $router = $ctrl->getRouter();
    
//      $route = new Zend_Controller_Router_Route_Static(
//      	  'login',
//          array('module' => 'users',
//          		'controller' => 'author', 
//          		'action' => 'login')
//      	  );
//   		$route_home = new Zend_Controller_Router_Route_Static(
//      	  'home',
//          array('module' => 'frontend',
//          		'controller' => 'index', 
//          		'action' => 'index')
//      	  );
//      $router->addRoute('login', $route);
//      $router->addRoute('home', $route_home);
      
        //Zend_Debug::dump($routes);
//        return $router;
    }
	
}
