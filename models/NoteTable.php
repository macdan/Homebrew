<?php

class NoteTable extends App_Db_Table
{
	public function create( App_Db_Record $record )
	{
		$statement = $this->_db->prepare( 'INSERT INTO note ( user_id, body ) VALUES ( :body )' );
		$statement->bindValue( ':body', $record->body, PDO::PARAM_STR );
		$statement->execute();
	}

	public function update( App_Db_Record $record )
	{
		$statement = $this->_db->prepare( 'UPDATE note SET user_id = :user_id, body = :body WHERE id = :id' );
		$statement->bindValue( ':user_id', $record->user_id, PDO::PARAM_INT );
		$statement->bindValue( ':body', $record->body, PDO::PARAM_STR );
		$statement->bindValue( ':id', $record->id, PDO::PARAM_INT );
		$statement->execute();
	}

	public function delete( App_Db_Record $record )
	{
		$statement = $this->_db->prepare( 'DELETE FROM note WHERE id = :id' );
		$statement->bindValue( ':id', $record->id, PDO::PARAM_INT );
		$statement->execute();
	}
}
