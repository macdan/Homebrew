<?php

return array(
	'index' => array(
		'route' => array(
			'regex' => '~^/$~'
		),
		'params' => array(
			'controller' => 'index',
			'action' => 'index'
		),
		'defaults' => array()
	),
	'login' => array(
		'route' => array(
			'regex' => '~^/login$~'
		),
		'params' => array(
			'controller' => 'index',
			'action' => 'login'
		)
	),
	'logout' => array(
		'route' => array(
			'regex' => '~^/logout$~'
		),
		'params' => array(
			'controller' => 'index',
			'action' => 'logout'
		)
	),
	'note_list' => array(
		'route' => array(
			'regex' => '~^/notes$~',
		),
		'params' => array(
			'controller' => 'note',
			'action' => 'list'
		)
	),
	'note_new' => array(
		'route' => array(
			'regex' => '~^/notes/new$~',
		),
		'params' => array(
			'controller' => 'note',
			'action' => 'new'
		)
	),
	'note_view' => array(
		'route' => array(
			'regex' =>'~^/notes/(.*?)$~',
			'params' => array( 'note_id' ),
		),
		'params' => array(
			'controller' => 'note',
			'action' => 'view'
		)
	),
	'note_edit' => array(
		'route' => array(
			'regex' =>'~^/notes/(.*?)/edit$~',
			'params' => array( 'note_id' ),
		),
		'params' => array(
			'controller' => 'note',
			'action' => 'edit'
		)
	)
);