<?php
class Error {
	private $errorArr;

	function __construct() {
		//init error messages
		$this->errorArr = array(
			'10000' => 'Can not read configs from the file inc.php, the file does not exist or no permission to read!',
			'20000' => 'Authorise failed, state code expired or exception occurs!',
			'30000' => '<h2></h2>'
		);

	}
	/*
	$level: error level
	*/
	public function showErrMsg($level, $description='$') {
		if($description == '$') {
			$msg = $this->errorArr[$level];
			$msg = $msg ? : 'undefined error!';
		}
		else {
			$msg = $level . ': ' . $description;
		}
		
		echo  $msg;
		error_log($msg);
		exit;
	}

}