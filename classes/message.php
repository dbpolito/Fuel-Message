<?php

namespace Message;
/**
 * Gets all ACL permission in the Database
 */
class Message
{

	protected static $prefix = 'message::';

	protected static $allowed_types = array(
		'success',
		'info',
		'error',
		'custom',
	);

	protected static $data = array();

	public static function _init()
	{
		\Config::load('message', 'message');
		
		static::$prefix = \Config::get('message.prefix', static::$prefix);
		static::$allowed_types = \Config::get('message.allowed_types', static::$allowed_types);
	}

	public static function get($name = null)
	{
		$output = '';
		
		foreach (static::$allowed_types as $type)
		{
			if ( ! static::get_flash($type))
			{
				continue;
			}

			$output .= \View::forge($type, array('messages' => static::get_flash($type)));
		}

		return $output;
	}

	public static function __callStatic($name, $args)
	{
		if (in_array($name, static::$allowed_types))
		{
			if (isset($args[1]) and $args[1] === true)
			{
				static::$data[$name] = array();
			}

			static::$data[$name][] = $args[0];
			static::_set_flash($name, static::$data[$name]);
		}
	}

	public static function get_flash($name = 'success')
	{
		return \Session::get_flash(static::$prefix.$name);
	}

	protected static function _set_flash($name = 'success', $val = '')
	{
		\Session::set_flash(static::$prefix.$name, $val);
	}
}