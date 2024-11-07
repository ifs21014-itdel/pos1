<?php

/**
 * @author 
 */
class Version extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_version' );
	}
	
	function get_data() {
	    $result = $this->model_version->get_data();
	    echo json_encode($result);
	}
}
