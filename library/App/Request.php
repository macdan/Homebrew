<?php

class App_Request
{
	public function getMethod()
	{
		return strtoupper( $_SERVER['REQUEST_METHOD'] );
	}

	public function isPost()
	{
		if ( $this->getMethod() == 'POST' )
		{
			return true;
		}

		return false;
	}

	public function getQuery( $field=null, $defaultValue=null)
	{
		if ( $field == null )
		{
			return $_GET;
		}

		return ( isset( $_GET[ $field ] ) ? $_GET[ $field ] : $defaultValue );
	}

	public function getPost( $field=null, $defaultValue=null )
	{
		if ( $field == null )
		{
			return $_POST;
		}

		return ( isset( $_POST[ $field ] ) ? $_POST[ $field ] : $defaultValue );
	}

	public function getUri()
	{
		return $_SERVER['REQUEST_URI'];
	}
}
