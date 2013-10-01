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
		'danger',
	),

	/**
	 * Add css class for Messages
	 *
	 * e.g. 'fade in' -> <div class="alert alert-error fade in">
	 */
	'allowed_classe' => 'fade in',
	
);