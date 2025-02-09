<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class hook act as Pre-Authentication.
 * Always work before controller executed.
 *
 * @author Rizal.Gurning
 */
class PreControllerAuthentication {

    public function __construct() {}

    /**
     * Initialize authentication route
     */
    function initializeAuthenticationRoute(){
		$CI = &get_instance();
		$path_uri_login = $CI->config->item('PATH_URI_LOGIN');
		$path_uri_login_authentication = $CI->config->item('PATH_URI_LOGIN_AUTHENTICATION');
		$path_uri_login_authentication_api = $CI->config->item('PATH_URI_LOGIN_AUTHENTICATION_API'); // Tambahkan ini
		$path_uri_synchronize_authentication_store_ho = $CI->config->item('PATH_URI_SYNCHRONIZE_AUTHENTICATION_STORE_HO');
		$path_uri_synchronize_authentication_client = $CI->config->item('PATH_URI_SYNCHRONIZE_AUTHENTICATION_CLIENT');
		$current_uri_string = $CI->uri->uri_string();
	
		// Jika pengguna belum diautentikasi
		if (!Authority::isUserAuthenticated()) {
			if (
				$path_uri_login != $current_uri_string &&
				$path_uri_login_authentication != $current_uri_string &&
				$path_uri_login_authentication_api != $current_uri_string // Tambahkan ini
			) {
				$segments = $CI->uri->segments;
				$current_uri_synchronize = count($segments) > 1 ? $segments[1] . "/" . $segments[2] : "";
	
				if (
					$path_uri_synchronize_authentication_store_ho == $current_uri_synchronize
					/* || $path_uri_synchronize_authentication_client == $current_uri_synchronize */
				) {
					if ($path_uri_synchronize_authentication_store_ho == $current_uri_string) {
						$this->performAuthenticationCheckOfSychronization();
					}
				} else {
					redirect(site_url($path_uri_login), "refresh");
				}
			}
		}
	}
	

    /**
     * Perform authentication check for synchronization
     */
    private function performAuthenticationCheckOfSychronization() {
        $CI = &get_instance();
        $store_ho_serial_number = $CI->input->post("store_ho_serial_number");
        $store_serial_number = $CI->input->post("store_serial_number");

        $isAuthentic = FALSE;
        $CI->load->model("system/Model_security");
        $isAuthentic = $CI->Model_security->is_synchronization_authentic($store_ho_serial_number, $store_serial_number);

        if (!$isAuthentic) {
            $response = array(
                'status' => 'Forbidden'
            );
            $CI->output->set_status_header(203)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))->_display();
            exit();
        } else {
            echo "</br>isAuthentic: $isAuthentic</br>";
        }
    }
}
