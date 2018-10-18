<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['alumnos/nuevo'] = 'alumnos/nuevo';
$route['alumnos'] = 'alumnos/index';
$route['profesores'] = 'profesores/index';
$route['protocolos'] = 'protocolos/index';

$route['cred/change_user_fields'] = 'cred/change_user_fields';

$route['default_controller'] = 'pages/view';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;