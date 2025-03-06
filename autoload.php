<?php

$directories = [
	'app/',
	'controllers/',
	'models/',
	'views/',
];

foreach( $directories as $directory )
	if( file_exists( $directory ) )
		foreach( glob( __DIR__ .'/'. $directory .'*.php' ) as $class )
			include_once $class;
