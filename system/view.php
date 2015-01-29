<?php
class View {
	var $oname = 'view';
	function __construct() {
		//to do
	}
	//display the view, actually we should split the page into small parts, like head, foot.
	static function show($view, $params=array()) {
		$static_uri = Config::get('global.static_uri');
		extract($params);
		ob_start();
		$view_file = VIEW_PATH . "{$view}.phtml";
		if(file_exists($view_file)) {
			include_once $view_file;
		}
		ob_end_flush();
	}
}

function V($view, $params=array()) {
	if(! $view) return;
	View::show($view, $params);
}
