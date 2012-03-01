<?php

/**
 * Autoload.php
 *
 * @author Daniel Kendell <daniel.kendell@gmail.com>
 */

/**
 * App_Autoload
 *
 * The main autoloader, just a container for the autoload and controller
 * autoload methods as well as provide an interface for registering autoloaders.
 */
class App_Autoload
{
	/**
	 * Register Autoloader
	 *
	 * Basic wrapper for spl_autoload_register()
	 *
	 * @static
	 * @access public
	 * @param callback $autoloader Autoloader callback
	 * @return void
	 */
	public static function registerAutoloader( $autoloader )
	{
		spl_autoload_register( $autoloader, true );
	}

	/**
	 * Autoload
	 *
	 * Finds and requires the file for a given class name
	 *
	 * @access public
	 * @param string $class The class to autoload
	 * @return void
	 */
	public function autoload( $class )
	{
		$path = $this->_classNameToPath( $class );
		require_once $path;
	}

	/**
	 * Autoload Controller
	 * 
	 * Find and load a controller class
	 * 
	 * @param <type> $class 
	 */
	public function autoloadController( $class )
	{
		$path = APPLICATION_PATH . '/controllers/' . $class . '.php';
		require_once $path;
	}

	/**
	 * Class Name to Path
	 *
	 * Converts a class name into a path according to the PEAR convention
	 *
	 * @access protected
	 * @param string $class The class name
	 * @return string The relative path of the class file
	 */
	protected function _classNameToPath( $class )
	{
		return str_replace( '_', '/', $class ) . '.php';
	}
}
