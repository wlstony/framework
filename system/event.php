<?php
class Event
{
	private static $_events = array();

	static function trigger($idenfier, $params = array())
	{
		$return = array();
		if(isset(self::$_events[$idenfier]))
		{
			$events = self::$_events[$idenfier];
			foreach((array)$events as $e)
			{
				list($class, $method) = explode('::', $e);
				$return[] = call_user_func_array(array($class, $method), $params);
			}
		}
		return $return;
	}

	static function bind($idenfier, $event='')
	{
		if(! $event) $event = $idenfier;
		self::$_events[$idenfier][] = $event;
	}

	static function remove($idenfier)
	{
		if(! $idenfier) return;
		if(isset(self::$_events[$idenfier]))
		{
			unset(self::$_events[$idenfier]);
		}
	}
}