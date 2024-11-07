<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authority Helper
 *
 *This method can be called from View, Controller, Model, etc.
 *
 * @author Rizal.Gurning
 */

if ( ! function_exists('hasPermission'))
{
    function hasPermission($permissionMaskCode)
    {
        return Authority::hasPermission($permissionMaskCode);
    }
}

if ( ! function_exists('validateUserAuthorization'))
{
	function validateUserAuthorization($permissionMaskCode)
	{
		return Authority::validateUserAuthorization($permissionMaskCode);
	}
}

if ( ! function_exists('show_error_security'))
{
	/**
	 * Error Handler
	 *
	 * This function lets us invoke the exception class and
	 * display errors using the standard error template located
	 * in application/views/errors/error_authority.php
	 * This function will send the error page directly to the
	 * browser and exit.
	 *
	 * @param	string
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function show_error_security($message, $status_code = 401, $heading = 'An Error Was Encountered')
	{
		$status_code = abs($status_code);
		if ($status_code < 100)
		{
			$exit_status = $status_code + 9; // 9 is EXIT__AUTO_MIN
			if ($exit_status > 125) // 125 is EXIT__AUTO_MAX
			{
				$exit_status = 1; // EXIT_ERROR
			}

			$status_code = 500;
		}
		else
		{
			$exit_status = 1; // EXIT_ERROR
		}

		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error($heading, $message, 'error_security', $status_code);
		exit($exit_status);
	}
}