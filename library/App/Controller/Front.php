<?php

class App_Controller_Front
{
	protected static $_instance = null;
	protected $_bootstrap = null;
	protected $_request = null;
	protected $_response = null;
	
	protected function __construct()
	{
		//
	}
	
	public static function getInstance()
	{
		if ( !self::$_instance )
		{
			self::$_instance = new self;
		}
		
		return self::$_instance;
	}

	public function init()
	{
		$this->_bootstrap = new App_Bootstrap;
		$this->_request = new App_Request;
		$this->_response = new App_Response;
	}

	public function run()
	{
		$this->bootstrap();
		$this->dispatch();
	}

	public function bootstrap()
	{
		$this->_bootstrap->run();
	}

	public function dispatch()
	{
		if ( !$this->_bootstrap->hasResource( 'router' ) )
		{
			throw new App_Controller_Front_Exception(
				"A router is required for dispatch",
				App_Controller_Front_Exception::ROUTER_REQUIRED
			);
		}

		$router = $this->_bootstrap->getResource( 'router' );
		$route = $router->route( $this->_request );

		$controllerName = $route->getControllerName();
		$actionName = $route->getActionName();

		$controllerClass = $this->_controllerClass( $controllerName );

		$view = new App_View;
		$view->setScript( $controllerName . '/' . $actionName . '.phtml' );

		$controller = new $controllerClass;
		$controller->setView( $view );
		$controller->setResponse( $this->_response );
		
		$response = $controller->run( $actionName );
		$response->send();
	}

	public function getBootstrap()
	{
		return $this->_bootstrap;
	}
	
	protected function _controllerClass( $name )
	{
		return ucfirst( $name ) . "Controller";
	}

	protected function _loadController( $name )
	{
		$class = $this->_controllerClass( $name );
		require_once $class;
	}
}