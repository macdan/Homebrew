<?php

class App_Exception_Handler
{
	public function handle( Exception $e )
	{
		echo "Kind: ", get_class( $e ), "\n";
		echo "Occured In: ", $e->getFile(), '#', $e->getLine(), "\n";
		echo "Message: ", $e->getMessage(), "\n";
		
		die( "\n\n- Oh No! -\n" );
	}

	public static function register( $callback )
	{
		set_exception_handler( $callback );
	}
}