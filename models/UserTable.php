<?php

class UserTable extends App_Db_Table
{
	public function create( App_Db_Record $record )
	{
		$db = $this->getDb();

		$statement = $db->prepare( 'INSERT INTO user ( name, password ) VALUES ( :name, MD5( :password ) )' );
		$statement->bindValue( ':name', $record->name, PDO::PARAM_STR );
		$statement->bindValue( ':password', $record->password, PDO::PARAM_STR );
		$statement->execute();
	}

	public function update( App_Db_Record $record )
	{
		$db = $this->getDb();

		$statement = $db->prepare( 'UPDATE user SET name = :name, password = MD5( :password ) WHERE id = :id' );
		$statement->bindValue( ':name', $record->name, PDO::PARAM_STR );
		$statement->bindValue( ':password', $record->password, PDO::PARAM_STR );
		$statement->bindValue( ':id', $record->id, PDO::PARAM_INT );
		$statement->execute();
	}

	public function delete( App_Db_Record $record )
	{
		$db = $this->getDb();

		$statement = $db->prepare( 'DELETE FROM user WHERE id = :id' );
		$statement->bindValue( ':id', $record->id, PDO::PARAM_INT );
		$statement->execute();
	}
}