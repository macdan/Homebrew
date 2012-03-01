<?php

abstract class App_Db_Table
{
	protected $_db = null;
	protected $_dbConnection = 'main';

	abstract public function create( App_Db_Record $record );
	abstract public function update( App_Db_Record $record );
	abstract public function delete( App_Db_Record $record );

	public function __construct( App_Db $db )
	{
		$this->_db = $db->getConnection( $this->_dbConnection );
	}
}
