<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper custom_helper
 *
 * @author Rizal.Gurning
 */

if ( ! function_exists('get_parameter_from_front_end'))
{
	function get_parameter_from_front_end($array_field,$array_data, $exclude_fields = []){
		$result = array ();
		foreach($array_field as $field){
			$value = null;
			if( ! is_array($exclude_fields) ||  ! in_array($field, $exclude_fields)){
				if(array_key_exists($field, $array_data)){
					$value = $array_data[$field];
				}
			}
			$result[$field] = $value;
		}
		return $result;
	}

}

// ------------------------------------------------------------------------
if ( ! function_exists('permission_mask'))
{
	/**
	 * Permission Mask
	 *
	 * Get Permission Mask Code from Permission Mask Config List define in "config\permission_mask.php"
	 *
	 * @param string permission mask code
	 */
	function permission_mask($permissionMaskCode = '')
	{
		static $ACL_permission_mask;

		if ( ! is_array($ACL_permission_mask))
		{
			if (file_exists(APPPATH.'config/permission_mask.php'))
			{
				include(APPPATH.'config/permission_mask.php');
			}

			if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/permission_mask.php'))
			{
				include(APPPATH.'config/'.ENVIRONMENT.'/permission_mask.php');
			}

			if (empty($permission_mask) OR ! is_array($permission_mask))
			{
				$ACL_permission_mask = array();
				return '';
			}

			$ACL_permission_mask = $permission_mask;
		}

		return isset($ACL_permission_mask[$permissionMaskCode]) ? $ACL_permission_mask[$permissionMaskCode] : '';
	}
}

if ( ! function_exists('show_error_module_application'))
{
	function show_error_module_application($message, $status_code = 500, $heading = 'An Error Was Encountered')
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
		echo $_error->show_error($heading, $message, 'error_module_application', $status_code);
		exit($exit_status);
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('label'))
{
	/**
	 * Label
	 *
	 * Get Label with appropriate language (Multi Language)
	 * ex: label("hello.world")  => "Hello World"
	 * @param string label
	 */
	function label($label = '')
	{
		$ci = &get_instance();
		$return = $ci->lang->line($label);
	    if($return != FALSE)
	        echo $return;
	    else
        	echo $label;
	}
}

if ( ! function_exists('load_language'))
{
	/**
	 * loadLanguage
	 *
	 * Load Language
	 * ex: load_language("error_message")
	 * @param string message_resource_name
	 */
	function load_language($message_resource_name = '')
	{
		$idiom = Authority::getUserLanguage();
		
		if($idiom != "english" && $idiom !="bahasa"){
			$idiom = "english";
		}
		$ci = &get_instance();
		$ci->lang->load($message_resource_name, $idiom);
	}
}
