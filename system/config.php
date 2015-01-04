<?php
class Config {
	private static $configs;

	//scan the config files, and require them.
	static function init() {
		$config_path = FRAME_ROOT . '/config/';
		if(is_dir($config_path)) {
			if($dh = opendir($config_path)) {
				while(($config_file = readdir($dh)) !== false) {
				 	if(substr($config_file, -4) != '.php') continue;
				 	include $config_path . $config_file;
				 	$prefix = basename($config_file, '.php');
				 	foreach ((array)$config as $k => $v) {
				 		Config::$configs[$prefix . '.' . $k] = $v;
				 	}
				 }
			}
			closedir($dh);
		}
	}
	static function get($key) {
		return Config::$configs[$key];
	}
}