<?php

class Rotas
{
	private $listaRotas = [''];
	private $listaCallback = [''];

	public function get( $rota, $callback ){
		return $this->add( 'GET', $rota, $callback );
	}
	
	public function post( $rota, $callback ){
		return $this->add( 'POST', $rota, $callback );
	}
	
	public function put( $rota, $callback ){
		return $this->add( 'PUT', $rota, $callback );
	}
	
	public function delete( $rota, $callback ){
		return $this->add( 'DELETE', $rota, $callback );
	}

	private function add( $metodo, $rota, $callback )
	{
		$this->listaRotas[] = strtoupper($metodo).':'.$rota;
		$this->listaCallback[] = $callback;

		return $this;
	}

	public function call( $url )
	{
		$index = 0;
		$params = [];
		$callback = '';
		$methodServer = $_SERVER['REQUEST_METHOD'];
		$methodServer = isset($_POST['_method']) ? $_POST['_method'] : $methodServer;
		$url = $methodServer.":/".$url;
		$e_url = explode('/', $url);

		foreach( $this->listaRotas as $i => $rota ){
			$e_rot = explode('/', $rota);

			if( count( $e_rot ) != count( $e_url ) )
				continue;

			$igual = true;
			foreach( $e_rot as $j => $segmento_rota  ){
				$nome_parametro = str_replace('{', '', $segmento_rota);
				$nome_parametro = str_replace('}', '', $nome_parametro);

				if( substr($segmento_rota, 0, 1) == '{' ){
					$params[ $nome_parametro ] = $e_url[$j];
					continue;
				}

				if( $segmento_rota != $e_url[$j] ){
					$igual = false;
					break;
				}
			}

			if( $igual )
				$index = $i;
		}

		if( $index == 0 )
			Response::json(codigo:404);

		$callback = explode("::", $this->listaCallback[$index]);
		$class = isset($callback[0]) ? $callback[0] : '';
		$method = isset($callback[1]) ? $callback[1] : '';

		if( class_exists( $class ) )
			if( method_exists( $class, $method ) )
				return call_user_func_array( [ new $class(), $method ], $params );
	}
}