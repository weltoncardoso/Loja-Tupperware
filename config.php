<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/lojatupperware/");
	$config['dbname'] = 'lojatapperware';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://localhost/lojatupperware/");
	$config['dbname'] = 'lojatapperware';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

$config['default_lang'] = 'pt-br';
$config['cep_origin'] = '72301407';
$config['pagseguro_seller'] = 'weltonvcardoso@gmail.com';
// Informações do MercadoPago colocar a da aline do site https://applications.mercadopago.com.br
$config['mp_appid'] = '2047528515231387';
$config['mp_key'] = 'ZgANzkWZNXHAbesba86fNXLm99jTZv6r';

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("lojatupperware")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("lojatupperware")->setRelease("1.0.0");


\PagSeguro\Configuration\Configure::setEnvironment('sandbox');

\PagSeguro\Configuration\Configure::setAccountCredentials('weltonvcardoso@gmail.com','AE5F24800A594E028A4BF765549EFA10');
\PagSeguro\Configuration\Configure::setCharset('UTF-8');
\PagSeguro\Configuration\Configure::setLog(true, 'pagseguro.log');
?>