<?php

class Routes
{
	private $route_list = [];

	public function __construct()
	{
		$this->add( '', '', '', '' );
	}

	private function add( $verb, $route, $class, $method )
	{
		$obj = [
			'route' => $verb .'://'. $route,
			'class' => $class,
			'method' => $method,
		];

		if( ! array_search( $obj['route'], array_column( $this->route_list, 'route' ) ) )
			$this->route_list[] = $obj;
	}

	public function get( $route, $class, $method )
	{
		$this->add( 'GET', $route, $class, $method );
	}
	
	public function post( $route, $class, $method )
	{
		$this->add( 'POST', $route, $class, $method );
	}
	
	public function put( $route, $class, $method )
	{
		$this->add( 'PUT', $route, $class, $method );
	}
	
	public function delete( $route, $class, $method )
	{
		$this->add( 'DELETE', $route, $class, $method );
	}

	public function resource( $route, $class )
	{
		$this->get( $route, $class, 'index' );
		$this->get( $route .'/{id}', $class, 'show' );
		$this->post( $route, $class, 'store' );
		$this->put( $route .'/{id}', $class, 'update' );
		$this->delete( $route .'/{id}', $class, 'destroy' );
	}

	public function call( $path )
	{
		$index = 0;
		$params = [];
		$path_segments = explode('/', $_SERVER['REQUEST_METHOD'] .'://'. $path);

		foreach( $this->route_list as $i => $rota ){
			$route_segments = explode('/', $rota['route']);

			if( count( $route_segments ) != count( $path_segments ) )
				continue;

			$found = true;
			foreach( $route_segments as $j => $segment  ){
				if( substr($segment, 0, 1) == '{' ){
					$params[ preg_replace( '/[\{\}]/', '', $segment ) ] = $path_segments[$j];
					continue;
				}

				if( $segment != $path_segments[$j] ){
					$found = false;
					break;
				}
			}

			if( $found ){
				$index = $i;
				break;
			}
		}

		$class = $this->route_list[ $index ]['class'];
		$method = $this->route_list[ $index ]['method'];

		if( class_exists( $class ) )
			if( method_exists( $class, $method ) )
				return call_user_func_array( [ new $class, $method ], $params );

		Response::json(code:404);
	}
}