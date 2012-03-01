<?php

/**
 * Bootstrap.php
 *
 * @author Daniel Kendell <daniel.kendell@gmail.com>
 */

 /**
  * App_Bootstrap
  *
  * Application bootstrapper, responsible for setting up application resources.
  */
class App_Bootstrap
{
	/**
	 * @access protected
	 * @var array Application resources
	 */
	protected $_resources = array();

	/**
	 * Run
	 *
	 * @access public
	 * @return void
	 */
	public function run()
	{
		$methods = get_class_methods( $this );
		foreach ( $methods as $method )
		{
			if ( substr( $method, 0, 4 ) != 'init' )
			{
				continue;
			}
			
			$result = call_user_func( array( $this, $method ) );

			if ( $result )
			{
				$resourceName = strtolower( substr( $method, 4 ) );
				$this->_resources[ $resourceName ] = $result;
			}
		}
	}

	/**
	 * Get Resources
	 *
	 * @access public
	 * @return array Application resources
	 */
	public function getResources()
	{
		return $this->_resources;
	}

	/**
	 * Has Resource
	 *
	 * Checks whether a resource exists.
	 *
	 * @access public
	 * @param string $name The resource name to look for
	 * @return bool Whether or not the resource exists
	 */
	public function hasResource( $name )
	{
		if ( !isset( $this->_resources[ $name ] ) )
		{
			return false;
		}

		return true;
	}

	/**
	 * Get Resource
	 * 
	 * Fetch an application resource from the bootstrapper
	 * 
	 * @access public
	 * @param string $name The name of the resource
	 * @return mixed The resource
	 */
	public function getResource( $name )
	{
		if ( !$this->hasResource( $name ) )
		{
			throw new App_Bootstrap_Exception(
				"Resource not found: $name",
				App_Bootstrap_Exception::RESOURCE_NOT_FOUND
			);
		}

		return $this->_resources[ $name ];
	}

	/**
	 * Initialse Exception Handler
	 *
	 * @access public
	 * @return return App_Exception_Handler The exception handler
	 */
	public function initExceptionHandler()
	{
		$handler = new App_Exception_Handler;
		App_Exception_Handler::register( array( $handler, 'handle' ) );
		return $handler;
	}

	/**
	 * Initialise Router
	 *
	 * @access public
	 * @return App_Router The mvc router
	 */
	public function initRouter()
	{
		$routes = require_once APPLICATION_PATH . '/config/routes.php';
		
		$router = new App_Router;
		$router->addRoutes( $routes );

		return $router;
	}

	/**
	 * Initialise DB
	 *
	 * @access public
	 * @return App_Db The database instance
	 */
	public function initDb()
	{
		$config = require_once APPLICATION_PATH . '/config/db.php';

		$db = App_Db::getInstance();

		foreach ( $config['connections'] as $connectionName => $options )
		{
			$db->newConnection(
				$connectionName,
				$options['dsn'],
				$options['username'],
				$options['password']
			);
		}
		
		return $db;
	}
}
