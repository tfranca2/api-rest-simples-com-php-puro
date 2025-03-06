<?php

class Response
{
	public static function json( $data=[], $code=200 )
	{
		header('Content-type: application/json');
		http_response_code($code);

		if( $data )
			echo json_encode($data);

		exit();
	}

	public static function file( $path )
	{
		if( ! file_exists( $path ) )
			Self::json(code:404);

		http_response_code(200);
		header('Content-type: '. mime_content_type( $path ));
		header('Content-Disposition: attachment; filename="'. basename( $path ) .'"');
		header('Content-Length: '. filesize( $path ));
		readfile( $path );

		exit();
	}
}