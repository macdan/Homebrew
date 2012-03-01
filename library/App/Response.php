<?php

class App_Response
{
	const STATUS_OK = 200;
	const STATUS_CREATED = 201;
	const STATUS_ACCEPTED = 202;
	const STATUS_NO_CONTENT = 204;
	const STATUS_BAD_REQUEST = 400;
	const STATUS_UNAUTHORIZED = 401;
	const STATUS_FORBIDDEN = 403;
	const STATUS_NOT_FOUND = 404;
	const STATUS_METHOD_NOT_ALLOWED = 405;
	const STATUS_NOT_ACCEPTABLE = 406;

	protected $_status = self::STATUS_OK;
	protected $_headers = array();
	protected $_body = '';
	protected $_messages = array(
		self::STATUS_OK => 'OK',
		self::STATUS_CREATED => 'Created',
		self::STATUS_ACCEPTED => 'Accepted',
		self::STATUS_NO_CONTENT => 'No Content',
		self::STATUS_BAD_REQUEST => 'Bad Request',
		self::STATUS_UNAUTHORIZED => 'Unauthorized',
		self::STATUS_FORBIDDEN => 'Forbidden',
		self::STATUS_NOT_FOUND => 'Not Found',
		self::STATUS_METHOD_NOT_ALLOWED => 'Method Not Allowed',
		self::STATUS_NOT_ACCEPTABLE => 'Not Acceptable',
	);

	public function setStatus( $code )
	{
		$this->_status = $code;
	}

	public function setHeader( $header, $value )
	{
		$this->_headers[ $header ] = $value;
	}

	public function appendBody( $output )
	{
		$this->_body .= $output;
	}

	public function send()
	{
		$this->sendStatus();
		$this->sendHeaders();
		$this->sendBody();
	}

	public function sendStatus()
	{
		header( 'HTTP/1.1 ' . $this->_status . ' ' . $this->_messages[ $this->_status ] );
	}
	
	public function sendHeaders()
	{
		foreach ( $this->_headers as $header => $value )
		{
			header( "$header: $value" );
		}
	}

	public function sendBody()
	{
		echo $this->_body;
	}
}
