<?php
class Core
{
	static function setup()
	{
        require_once FRAME_ROOT . '/system/config.php';
        Config::init();
	}

	static function loadModule($module)
	{
		if(! $module) return;
		$modules = Config::get('common.modules');
		if(in_array($module, $modules))
		{
			Config::loadModule($module);
			require_once FRAME_ROOT . '/system/autoload.php';
			Autoload::loadModule($module);

		}
	}
}
// function alert_message($msg, $redirect_url='') {
// 	$extrajs = $redirect_url ? 'window.location.href="' . $redirect_url. '";' : 'history.back(-1);';
// 	echo '<script type="text/javascript">alert("' . $msg . '");' . $extrajs. '</script>';
// 	exit;
// }
