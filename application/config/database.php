<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

if($_SERVER['HTTP_HOST'] == 'localhost'){
    $db['default'] = array(
        'dsn'   => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'pureuniverse',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => (ENVIRONMENT !== 'production'),
        'db_debug' => (ENVIRONMENT !== 'production'),
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
    );
}elseif($_SERVER['HTTP_HOST'] == 'test.pureuniverse.live'){
    $db['default'] = array(
        'dsn'   => '',
        'hostname' => 'localhost',
        'username' => 'labmajol_pure_universe',
        'password' => 'pure_univers@pu',
        'database' => 'labmajol_pure_test',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => (ENVIRONMENT !== 'production'),
        'db_debug' => (ENVIRONMENT !== 'production'),
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
    );
}else{
    $db['default'] = array(
        'dsn'   => '',
        'hostname' => 'localhost',
        'username' => 'labmajol_pure_universe',
        'password' => 'pure_univers@pu',
        'database' => 'labmajol_pure_universe',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => (ENVIRONMENT !== 'production'),
        'db_debug' => (ENVIRONMENT !== 'production'),
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
    );
}
