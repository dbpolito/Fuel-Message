<?php

namespace Message;
/**
 * Message is a lightweight package that helps you to handle with Alerts of your system.
 */
class Message
{
	/**
	 * The prefix of Session Flashdata
	 *
	 * @var string
	 */
	protected static $prefix = 'message::';

	/**
	 * Allowed Types for Messages
	 *
	 * Heads Up: You need a View with the same name
	 *
	 * @var array
	 */
	protected static $allowed_types = array(
		'success',
		'info',
		'warning',
		'error',
	);

	/**
	 * Allowed Class for Bootstrap
	 *
	 * e.g. fade in -> <div class="alert alert-error fade in">
	 *
	 * @var array
	 */
	protected static $allowed_classe = '';

	/**
	 * All Messages will be stored on runtime
	 *
	 * @var array
	 */
	protected static $data = array();

	/**
	 * Initializes the Package loading config changes if needed
	 *
	 * @return void
	 */
	public static function _init()
	{
		\Config::load('message', 'message');

		static::$prefix = \Config::get('message.prefix', static::$prefix);
		static::$allowed_types = \Config::get('message.allowed_types', static::$allowed_types);
		static::$allowed_classe = \Config::get('message.allowed_classe', static::$allowed_classe);
	}

	/**
	 * Gets Messages
	 *
	 * @param  null|string  $name Name of the Message
	 * @return string       The output generated (html)
	 */
	public static function get($name = null)
	{
		$output = '';

		foreach (static::$allowed_types as $type)
		{
			if ( ! static::get_flash($type))
			{
				continue;
			}

			$output .= \View::forge($type, array('messages' => static::get_flash($type), 'classe' => static::$allowed_classe), false);
		}

		return $output;
	}

	/**
	 * Magic Method that sets the Message
	 *
	 * @param  string $name The Name of the Message
	 * @param  array $args
	 * @return void
	 */
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

	/**
	 * Get the Flashdata
	 *
	 * @param  string $name The Name of the Message
	 * @return array
	 */
	public static function get_flash($name = 'success')
	{
		return \Session::get_flash(static::$prefix.$name);
	}

	/**
	 * Set the Flashdata
	 *
	 * @param  string $name The Name of the Message
	 * @param  string $val  The Value of the Message
	 * @return void
	 */
	protected static function _set_flash($name = 'success', $val = '')
	{
		\Session::set_flash(static::$prefix.$name, $val);
	}
}