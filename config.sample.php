<?php
ini_set('display_errors',true);
error_reporting(E_ALL);

function autoload($class)
{
    $class = str_replace('_', '/', $class);
    include $class . '.php';
}

spl_autoload_register("autoload");

set_include_path(dirname(__FILE__).'/src'.PATH_SEPARATOR.dirname(__FILE__).'/lib/php');

UNL_Annotate::$url = 'http://localhost/workspace/unl_annotate/www/';

//Database username/password
UNL_Annotate::$db_user = 'annotate';
UNL_Annotate::$db_pass = 'annotate';