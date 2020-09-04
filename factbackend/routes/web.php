<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'CpeController@index');
$app->get('/config', 'CpeController@config');


$app->get('/demo','FacturadorController@demo');
$app->get('/generarpem','FacturadorController@generarpem');
$app->get('/generarcer','FacturadorController@generarcer');

$app->get('/documentos','DocumentosController@index');

$app->get('/firmar/{iddoc}','CpeController@firmar');
$app->get('/eliminardoc','CpeController@eliminardoc');

$app->get('/enviarfactura/{iddoc}','CpeController@enviarFactura');
$app->get('/enviarfacturas','CpeController@enviarfacturas');
$app->get('/enviarnotas','CpeController@enviarnotas');

$app->get('/generaresumen','CpeController@generarResumen');

$app->get('/generacomunicacionbaja','CpeController@generarComunicacionBaja');

$app->get('/generarepgraficas','CpeController@generarepgraf');

$app->get('/enviaremails','CpeController@enviarEmails');
$app->get('/enviaresumenes','CpeController@enviarResumen');
$app->get('/enviarcomunicacionbaja','CpeController@enviarComunicacionBaja');
$app->get('/publicarcomprobantes','CpeController@subirComprobantes');
$app->get('/vercomprobante/{ndocumento}','CpeController@vercomprobante');
$app->get('/enviaremail/{ndocumento}','CpeController@enviarEmail');

$app->get('/verdocumentos','CpeController@verdocumentos');
$app->get('/verdocumento/{id}','CpeController@verdocumento');


$app->get('/firmarpendientes','CpeController@firmarPendientes');
$app->get('/enviaresumen/{id}','CpeController@enviarUnResumen');
$app->get('/regeneraresumen/{id}','CpeController@regenerarResumen');
$app->get('/consultaruc/{ruc}','CpeController@sunat');

/*  */

$app->get('demoresumen','CpeController@demoSistema');