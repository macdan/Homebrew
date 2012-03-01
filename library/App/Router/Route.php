<?php

class App_Router_Route
{
	protected $_regex = '';
	protected $_matchNames = array();
	protected $_params = array();

	public function __construct( array $options )
	{
		$this->_regex = $options['route']['regex'];
		$this->_matchNames = ( isset( $options['route']['params'] ) ? $options['route']['params'] : array() );
		$this->_params = $options['params'];
	}

	public function match() {}

	public function hasParam( $name )
	{
		if ( isset( $this->_params[ $name] ) )
		{
			return true;
		}

		return false;
	}

	public function getParam( $name )
	{
		if ( !$this->hasParam( $name ) )
		{
			throw new App_Router_Route_Exception(
				"Param not found: " . $name,
				App_Router_Route_Exception::PARAM_NOT_FOUND
			);
		}

		return $this->_params[ $name ];
	}

	public function getControllerName()
	{
		return $this->getParam( 'controller' );
	}

	public function getActionName()
	{
		return $this->getParam( 'action' );
	}

	public function getRegex()
	{
		return $this->_regex;
	}

	public function isMatch( $uri )
	{
		if ( !preg_match( $this->_regex, $uri, $matches ) )
		{
			return false;
		}

		unset( $matches[0] );

		$numParams = count( $matches );
		$numParamsExpected = count( $this->_matchNames );

		if ( $numParams != $numParamsExpected )
		{
			throw new App_Router_Route_Exception(
				"Expected $numParamsExpected params, only $numParams found",
				App_Router_Route_Exception::INVALID_PARAMETER_COUNT
			);
		}

		if ( $numParamsExpected > 0 )
		{
			$params = array_combine( $this->_matchNames, $matches );
			$this->_params = array_merge( $this->_params, $params );
		}

		return true;
	}
}
