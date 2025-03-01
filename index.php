<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Sao_Paulo");
require_once "autoload.class.php";

$rota = new Rotas();
$rota->get('/clientes', 'Clientes::index');
$rota->get('/clientes/{id}', 'Clientes::show');
$rota->post('/clientes', 'Clientes::store');
$rota->put('/clientes/{id}', 'Clientes::update');
$rota->delete('/clientes/{id}', 'Clientes::destroy');

@$rota->call($_GET['path']);
