<?php
class Config
{
	private static $_configs;

	//scan the config files, and require them.
	static function init()
	{
		$configPath = FRAME_ROOT . '/config';
		if(is_dir($configPath)) {
			if($dh = opendir($configPath)) {
				while(($configFile = readdir($dh)) !== false)
				{
					self::_parseConfigFile("{$configPath}/{$configFile}"); 	
				}
			}
			closedir($dh);
		}
	}

	static function loadModule($module)
	{
		$mpath = FRAME_ROOT . "/modules/{$module}/config";
		if(is_dir($mpath))
		{
			$filesArr = glob("{$mpath}/*.php");
			foreach((array)$filesArr as $file)
			{
				self::_parseConfigFile($file);
			}
		}
	}

	private static function _parseConfigFile($file)
	{
		if(is_file($file) && substr($file, -4) == '.php')
		{
			$config = '';
			include $file;
		 	$prefix = basename($file, '.php');
		 	foreach ((array)$config as $k => $v)
		 	{
		 		self::$_configs[$prefix . '.' . $k] = $v;
		 	}
		}
	}

	static function get($key)
	{
		return self::$_configs[$key];
	}
}