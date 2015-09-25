<?php
class Autoload
{
	private static $_autoLoadModule;

	static function loadModule($module)
	{
		if(! $module) return;
		$callback = 'self::_autoload';
		self::$_autoLoadModule = $module;

		self::register($callback);
	}

	static function register($callback)
	{
		spl_autoload_register($callback);
	}

	private static function _autoload()
	{
		$params = func_get_args();
		$class = $params[0];
		$length = strcspn($class, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$filename = substr($class, 0, $length);
		$fileType = strtolower(substr($class, $length));
		$requireFile = '';
		switch($fileType)
		{
			case 'controller':
				$requireFile = FRAME_ROOT . '/modules/' . self::$_autoLoadModule . "/controller/{$filename}.php";
				break;
			default :
				break;
		}
		require($requireFile);
	}
	
	static function unregister()
	{
		spl_autoload_unregister($callback);
	}
}