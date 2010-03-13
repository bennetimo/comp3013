<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	/**
	 * Instead of display the error on a separate page we throw an Exception that the controller can handle
	 * @override
	 */
	function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
    $message = implode(', ', ( ! is_array($message)) ? array($message) : $message);
    
    throw new Exception($message);
	}
}