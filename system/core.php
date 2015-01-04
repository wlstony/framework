<?php
class Core{
	static function startup() {
		require FRAME_ROOT . '/system/view.php';
		require FRAME_ROOT . '/system/config.php';
		require FRAME_ROOT . '/system/orm.php';
		require FRAME_ROOT . '/system/log.php';
		Config::init();
	}
}
function alert_message($msg, $redirect_url='') {
	$extrajs = $redirect_url ? 'window.location.href="' . $redirect_url. '";' : 'history.back(-1);';
	echo '<script type="text/javascript">alert("' . $msg . '");' . $extrajs. '</script>';
	exit;
}