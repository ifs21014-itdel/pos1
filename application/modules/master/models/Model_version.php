<?php

/**
 * @author 
 */
class Model_version extends MY_Model {
	
	public $table_name = "version";
	
	public function __construct() {
		parent::__construct ();
	}
	
    function get_data() {
    	$query = " SELECT version_name FROM version ORDER BY id DESC LIMIT 1";
    	$data = $this->db->query($query)->result();
    	return json_encode($data);
    }
   
}