<?php
class View {
	var $oname = 'view';
	var $_left = '';
	var $_header = '';
	var $_body = '';
	var $_footer = '';
	var $_right = '';
	var $view_arr;

	function __construct() {
		$this->view_arr = array('header', 'body', 'footer', 'left', 'right');
	}

    function factory() {
        return new View();    
    }

	/*one view is divided into 5 parts: left, header, body, foooter, right
	*$part: one of the 5 parts
	*$path: location of the file which consists of the view represents one part
	*$parms: parameters which will transmit into the part
	*/
	function add_part($part, $path, $params=array()) {
		if(in_array($part, $this->view_arr)) {
			$part_file = VIEW_PATH . $path . '.phtml';
			if(! file_exists($part_file)) {
				$part = '_' . $part;
				$this->$part = "$part_file does not exist in your project!";
				return;
			}
			$params = is_array($params) ? $params : (array)$params;
			extract($params);
			ob_start();
			include_once $part_file;
			$part_content = ob_get_contents();
			ob_end_clean();
			$part = '_' . $part;
			$this->$part = $part_content;
		}
		else {
			$error = strtr('sorry, $part does not exist in our pre-definition!',array(
					'$part' => $part,
			));
			error_log($error);
		}

	}

	function show($basepage='page', $params=array()) {
		$params = (array)$params + array(	
									'header' => $this->_header, 
									'left' => $this->_left, 
									'body' => $this->_body, 
									'right' => $this->_right, 
									'footer' => $this->_footer);
		extract($params);
		
		ob_start();
		$base_page_path = VIEW_PATH . "{$basepage}.phtml";
		
		if(file_exists($base_page_path)) {
			 include_once $base_page_path;
		}
		else {
			echo "File {$base_page_path} can not be found!";
		}
		ob_end_flush();
	}
}
