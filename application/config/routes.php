<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['login'] = 'auth/login';

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
