<?php

class App_Router_Exception extends Exception
{
	const ROUTE_ALREADY_EXISTS = 1;
	const INVALID_PARAMETER_COUNT = 2;
	const NO_ROUTE_FOUND = 3;
}
