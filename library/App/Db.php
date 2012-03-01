<?php

class App_Db
{
	protected $_tables = array();
	protected $_connections = array();
	protected static $_instance = null;

	protected final function __construct()
	{
		//
	}

	public function newConnection( $name, $dsn, $username, $password, $options=array() )
	{
		$connection = new PDO( $dsn, $username, $password, $options );
		$this->_connections[ $name ] = $connection;
	}

	public function getConnection( $name )
	{
		if ( !isset( $this->_connections[ $name ] ) )
		{
			throw new App_Db_Exception(
				"No connection found: $name",
				App_Db_Exception::NO_CONNECTION
			);
		}

		return $this->_connections[ $name ];
	}

	public static function getInstance()
	{
		if ( !self::$_instance )
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function getTable( $tableName )
	{
		if ( isset( $this->_table[ $tableName ] ) )
		{
			return $this->_tables[ $tableName ];
		}

		$table = new App_Db_Table( $this, $tableName );
		$this->_tables[ $tableName ] = $table;
		return $table;
	}
}
