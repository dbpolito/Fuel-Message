<?php
return array(
	/**
	 * The prefix of Session Flashdata
	 */
	'prefix' => 'message::',

	/**
	 * Allowed Types for Messages
	 *
	 * Heads Up: You need a View with the same name
	 */
	'allowed_types' => array(
		'success',
		'info',
		'warning',
		'error',
	)
);