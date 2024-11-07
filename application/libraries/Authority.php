<?php (defined('BASEPATH')) or exit('No direct script access allowed');
/**
 * class Authority
 *
 *Use this class to check authentication, authorization.
 *
 * @author Rizal.Gurning
 */
class Authority{

	public function __construct(){}

	/**
	 * Method to get Current User Id
	 * <br/>ex: Authority::getUserId();
	 *
	 * @return string user id
	 */
	public static function getUserId(){
		$ci = &get_instance();
		return $ci->session->userdata('id');
	}
	
	/**
	 * Method to get Current User Name
	 * <br/>ex: Authority::getUserName();
	 * 
	 * @return string user name
	 */
	public static function getUserName(){
		$ci = &get_instance();
		return $ci->session->userdata('username');
	}
	
	/**
	 * Method to get Current User Language
	 * <br/>ex: Authority::getUserName();
	 *
	 * @return string language
	 */
	public static function getUserLanguage(){
		$ci = &get_instance();
		return $ci->session->userdata('language');
	}
	
	/**
	 * Method to get whether User has been authenticated
	 * @return boolean
	 */
	public static function isUserAuthenticated(){
		$ci = &get_instance();
		return $ci->session->userdata('username') != "" ? true : false;
	}
	
	/**
	 * Method to check User Autorization. Can be used before method implementation
	 * <br/>ex: Authority::validateUserAuthorization(Permission::MASTER_USER_INSERT);
	 * 
	 * @param string $permissionMaskCode
	 */
	public static function validateUserAuthorization($permissionMaskCode){
		$authorized = static::hasPermission($permissionMaskCode);
		if( ! $authorized){
			show_error_security("Seems you don't allowed to access this page. You don't have permission [<b>$permissionMaskCode</b>]. <br/>For more information, please ask your Administrator", 401, "Authorization Exception");
		}
	}

	/**
	 * Method to check whether User has permission or not
	 * <br/>ex: Authority::hasPermission(Permission::MASTER_USER_INSERT);
	 * 
	 * @param String $permissionMaskCode
	 * @return boolean
	 */
	public static function hasPermission($permissionMaskCode){
		static $_granted_permissions;
		if( ! is_array($_granted_permissions)){
			$ci = &get_instance();
			$ci -> load -> model("accounts/model_user");
			$permissions = $ci -> model_user -> getGrantedPermissionMaskCurrentUser();
			if(empty($permissions) or !is_array($permissions)){
				$permissions = array();
			}
			$_granted_permissions = $permissions;
		}
		return isset($_granted_permissions[$permissionMaskCode]) ? true : false;
	}
}