<?php

/**
 * Controller.php
 *
 * @author Daniel Kendell <daniel.kendell@gmail.com>
 */

 /**
  * App_Controller
  *
  * Controller base class
  */
class App_Controller
{
	/**
	 * @access protected
	 * @var App_View The view
	 */
	protected $_view = null;

	/**
	 * @access protected
	 * @var App_Response The response
	 */
	protected $_response = null;

	/**
	 * Run
	 *
	 * Dispatches a specified action
	 *
	 * @access public
	 * @param string $action The name of the action
	 * @return App_Response Response object
	 */
	public function run( $action )
	{
		$method = $action . "Action";

		if ( !method_exists( $this, $method ) )
		{
			throw new App_Controller_Exception(
				"Action not found: $action",
				App_Controller_Exception::ACTION_NOT_FOUND
			);
		}

		$this->$method();
		$output = $this->_view->run();
		$this->_response->appendBody( $output );

		return $this->_response;
	}

	/**
	 * Set View
	 *
	 * @access public
	 * @param App_View $view The view object to use
	 * @return void
	 */
	public function setView( App_View $view )
	{
		$this->_view = $view;
	}

	/**
	 * Set Response
	 *
	 * @access public
	 * @param App_Response $response The response object to use
	 * @return void
	 */
	public function setResponse( App_Response $response )
	{
		$this->_response = $response;
	}

	/**
	 * Get Resource
	 *
	 * Shortcut method to retrieve an application resource
	 *
	 * @param string $name The name of the resource
	 * @return mixed The application resource
	 */
	public function getResource( $name )
	{
		return App_Controller_Front::getInstance()
			->getBootstrap()
			->getResource( $name );
	}
}
