<?php

class Clientes
{
	public function index()
	{
		Response::json(["clientes" => []]);
	}

	public function show($id)
	{
		// Response::file('documento_de_teste.pdf');
		Response::json(["cliente" => $id]);
	}

	public function store()
	{
		$data = Request::all();
		// Request::file('key_name_file_upload');
		Response::json(["cliente" => $data], 201);
	}

	public function update($id)
	{
		$data = Request::all();
		Response::json(["cliente" => $data], 202);
	}

	public function destroy($id)
	{
		Response::json(codigo:204);
	}
}
