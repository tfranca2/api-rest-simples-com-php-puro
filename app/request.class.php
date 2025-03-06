<?php

class Request
{
	public static function all()
	{
		switch( $_SERVER["CONTENT_TYPE"] ){
			case 'application/json':
				$data = json_decode(file_get_contents('php://input'));
			break;
			case 'application/x-www-form-urlencoded':
				parse_str(file_get_contents('php://input'), $data);
			break;
			case 'multipart/form-data':
			default:
				$data = $_POST;
			break;
		}

		if( $_SERVER['REQUEST_METHOD'] == 'GET' && isset( $_GET ) ){
			$url_params = $_GET;
			unset($url_params['path']);

			$data = array_merge($url_params, $data);
		}

		return $data;
	}

	public static function files()
	{
		$data = [];
		foreach( normalizeFiles() as $name => $file ){
			foreach( $file as $i => $f )
				$file[$i]['extension'] = pathinfo( $file[$i]['name'], PATHINFO_EXTENSION );

			$data[ $name ] = $file;
		}

		return $data;
	}

	public static function file( $name )
	{
		foreach( Self::files() as $key_name => $file )
			if( $name == $key_name )
				return $file;

		return [];
	}
}