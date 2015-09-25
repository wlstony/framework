<?php
$mode = php_sapi_name();
if(strcmp($mode, 'cli') !== 0)
{
	echo 'This is the entrance of cli mode, only cli is allowed';
	die;
}
define('FRAME_ROOT', dirname(__FILE__));
require FRAME_ROOT . '/system/core.php';

Core::setup();

$module = isset($argv[1]) ? $argv[1] : 'demo';
$controller = isset($argv[2]) ? ($argv[2] . 'Controller') : 'indexController';
$action = isset($argv[3]) ? ($argv[3] . 'Action') : 'indexAction';

Core::loadModule($module);

if(class_exists($controller))
{
	$c = new $controller;
	if(method_exists($c, $action))
	{
		call_user_func_array(array($c, $action), array());
	}
	else
	{
		echo "action '{$action}' doest exit in controller '{$controller}'";
	}
}
else
{
	echo "controller '{$controller}' doest exist";
}