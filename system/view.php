<?php
class View {
	//static $base_path = dirname(__FILE__);
	static function show($view_name, $param) {
		$base_path = dirname(dirname(__FILE__));
		$view_path = $base_path . '/views/' . $view_name . '.html';
		ob_start();
		$html = '';
		if ( file_exists($view_path) ) {
			$html  = file_get_contents( $view_path );
		}
		else {
			$html = 'view file does not exist!';

		}
		echo $html;
		ob_end_flush();

	}

}

