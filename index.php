<?php
require_once "autoload.php";

$route = new Routes();
$route->get('clientes', Clientes::class, 'index');
$route->get('clientes/{id}', Clientes::class, 'show');
$route->post('clientes', Clientes::class, 'store');
$route->put('clientes/{id}', Clientes::class, 'update');
$route->delete('clientes/{id}', Clientes::class, 'destroy');

header('Access-Control-Allow-Origin: *');
@$route->call($_GET['path']);
