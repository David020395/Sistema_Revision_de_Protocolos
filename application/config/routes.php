<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['alumnos/nuevo'] = 'alumnos/nuevo';
$route['alumnos/borrar/(:any)'] = 'alumnos/borrar/$1';
$route['alumnos'] = 'alumnos/index';

$route['default_controller'] = 'pages/view';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;