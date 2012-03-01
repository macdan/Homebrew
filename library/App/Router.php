<?php

class App_Router
{
	protected $_routes = array();

	public function addRoutes( array $routes )
	{
		foreach ( $routes as $routeName => $route )
		{
			$this->addRoute( $routeName, $route );
		}
	}

	public function addRoute( $routeName, $options )
	{
		if ( isset( $this->_routes[ $routeName ] ) )
		{
			throw new App_Router_Exception(
				"Route already exists: $routeName",
				App_Router_Exception::ROUTE_ALREADY_EXISTS
			);
		}

		$this->_routes[ $routeName ] = new App_Router_Route( $options );
	}

	public function route( App_Request $request )
	{
		foreach ( $this->_routes as $routeName => $route )
		{
			if ( $route->isMatch( $request->getUri() ) )
			{
				return $route;
			}
		}
		
		throw new App_Router_Exception(
			'No matching route found',
			App_Router_Exception::NO_ROUTE_FOUND
		);
	}
}
