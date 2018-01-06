<?php
require 'environment.php';

define("BASE", "http://localhost/painel/");

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'lojatapperware';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	$config['dbname'] = 'lojatapperware';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

$config['status_pgto'] = array(
	'1' => 'Aguardando Pgto.',
	'2' => 'Aprovado',
	'3' => 'Cancelado'
);

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>