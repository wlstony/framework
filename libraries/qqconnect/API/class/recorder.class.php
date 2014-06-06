<?php
require_once QQCONNECT . '/API/class/error.class.php';

class Recorder {
	private static $data;
	private $inc;
	private $error;

	function __construct() {
		$this->error = new Error();
		//read configuration file
		$incContents = file_get_contents(QQCONNECT . '/API/comm/inc.php');
		/*The amount of HTTP_HOST does not only, if it is configured fixly, session_id is
		*different from 'u seris' to 'www seris'
		*/
		$incContents = str_replace('httphost', $_SERVER['HTTP_HOST'], $incContents);
		$this->inc = json_decode($incContents);

		if(empty($this->inc)) {
			$this->error->showErrMsg(10000);
		} 

		if(empty($_SESSION['QC_UserData'])) {
			self::$data = array();
		}
		else {
			self::$data = $_SESSION['QC_UserData'];
		}
	}
	/*read value from configuration file*/
	public function readInc($name) {	
		return $this->inc->$name;
	}
	/**/
	public function write($name, $value) {
		 //error_log("write $name: " .  'session_id: ' . session_id());
		self::$data[$name] = $value;
	}
	/**/
	public function read($name) {
		//error_log("read $name: " .  'session_id: ' . session_id());
		return empty(self::$data[$name]) ? null : self::$data[$name];
	}

	function __destruct() {
		//error_log('destruct: ' . session_id());
		$_SESSION['QC_UserData'] = self::$data;
	}
}