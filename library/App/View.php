<?php

class App_View
{
	protected $_script = '';

	public function setScript( $path )
	{
		$this->_script = $path;
	}

	public function run()
	{
		ob_start();

		include APPLICATION_PATH . '/views/' . $this->_script;

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public function escape( $var )
	{
		$var = (string) $var;
		return htmlentities( $var, ENT_COMPAT, 'UTF-8' );
	}
}
