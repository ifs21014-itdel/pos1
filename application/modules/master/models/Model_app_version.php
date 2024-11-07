<?php

/**
 * @author 
 */
class Model_app_version extends MY_Model {
	
	public $table_name = "app_version";
	
	public function __construct() {
		parent::__construct ();
	}
	
    function get_data() {
    	$query = " SELECT version FROM app_version ORDER BY version DESC LIMIT 1";
    	$data = $this->db->query($query)->result();
    	return json_encode($data);
    }
    
    function add_version($git_version){
        $data = array(
            "version" => $git_version,
        );
        return $this -> insert($data);
    }
   
}