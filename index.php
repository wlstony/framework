<?php
define('FRAME_ROOT', $_SERVER['DOCUMENT_ROOT']);

$url_str = $script_url = rtrim($_SERVER['SCRIPT_URL'], '/');
$first_dot = strpos($script_url, '.');
if($first_dot) {
    $params_str = substr($script_url, $first_dot + 1);
    $url_str = substr($script_url, 0, $first_dot);
}
$params = $params_str ? explode('.', $params_str) : null;
$times = substr_count($url_str, '/');

switch($times) {
    case 0:
	$controller = 'index';
	$action = 'index';
	break;
    case 1:
        $controller = substr($url_str, 1); 
        $action = 'index';
        break;
    case 2:
        list($controller, $action) = explode('/', ltrim($url_str, '/'));
        break;
    default:
        $last_occurrence = strrpos($url_str, '/');
        $action = substr($url_str, $last_occurrence + 1);
        $controller = substr($url_str, 1, $last_occurrence -1);
        break;
}

dispatch($controller, $action, $params);

function dispatch($controller='index', $action='index', $params) {
    $controller_path = FRAME_ROOT . "controllers/{$controller}.php";
    var_dump($controller_path);
   echo "<pre>";
    var_dump( func_get_args());
   echo "</pre>";
}
