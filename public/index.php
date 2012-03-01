<?php

if ( isset( $_SERVER['argv'] ) )
{
	$_SERVER['REQUEST_URI'] = $_SERVER['argv'][1];
}

// -----------------------------------------------------------------------------

set_include_path( implode( PATH_SEPARATOR, array(
    realpath( dirname( __FILE__ ) . '/../library' ),
    realpath( dirname( __FILE__ ) . '/../controllers' ),
    realpath( dirname( __FILE__ ) . '/../models' ),
    get_include_path(),
) ) );

define( 'APPLICATION_PATH', realpath( dirname( __FILE__ ) . '/../' ) );

require_once 'App/Autoload.php';

$autoloader = new App_Autoload;
App_Autoload::registerAutoloader( array( $autoloader, 'autoload' ) );
App_Autoload::registerAutoloader( array( $autoloader, 'autoloadController' ) );

$front = App_Controller_Front::getInstance();
$front->init();
$front->run();
