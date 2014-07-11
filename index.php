<?php
define('FRAME_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('VIEW_PATH', FRAME_ROOT . '/views/');
define('SITE_ROOT', $_SERVER['SCRIPT_URI']);

$url_str = $script_url = rtrim($_SERVER['SCRIPT_URL'], '/');
$first_dot = strpos($script_url, '.');
$params_str = '';
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

function dispatch($controller='index', $action='index', $params='') {
    $controller_path = FRAME_ROOT . "/controllers/{$controller}.controller.php";
    if(file_exists($controller_path)) {
        require_once $controller_path;
    }
    else{
        //postpone to deal with the error
        die('controller does not exist!');
    }
   $controller =  ucfirst($controller) . '_Controller';
   $controller = new $controller; 
   $func = $action . 'Action';
   $params_str = is_array($params) ? implode(', ', $params) : $params;
   if(method_exists($controller, $func)){
        $controller->$func($params_str);
   }
   else{
       die('no action');
   }



}
