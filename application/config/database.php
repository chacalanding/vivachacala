<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';

//hostinger credentials
// $db['default']['database'] = 'u626994591_viva_chacala'; // Hostinger
// $db['default']['username'] = 'u626994591_viva_chacala'; // Hostinger
// $db['default']['password'] = 'Viva_chacala12'; // Hostinger

//Localhost
$db['default']['username'] = 'root';
$db['default']['database'] = 'realtyitcc_viva_chacala';
$db['default']['password'] = '';

//cpanel before
// $db['default']['database'] = 'realtyitcc_viva_chacala';
// $db['default']['username'] = 'realtyitcc_viva_chacala';
// $db['default']['password'] = '^HET?+EMXQuS';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = 'vc_';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;