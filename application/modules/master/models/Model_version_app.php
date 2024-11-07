<?php

/**
 * @author 
 */
class Model_version_app extends MY_Model {
	
	public $table_name = "version_app";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_data() {
	    $query = " SELECT version_name FROM version ORDER BY id DESC LIMIT 1";
	    $data = $this->db->query($query)->result();
	    return json_encode($data);
	}
	
	function get_app_data() {
	    $query = " SELECT version_name FROM version_app ORDER BY id DESC LIMIT 1";
	    $data = $this->db->query($query)->result();
	    return json_encode($data);
	}
    
    function add_version($client_version){
        $data = array(
            "version_name" => $client_version,
        );
        return $this -> insert($data);
    }
    
    function get_db_count() {
        $query = " SELECT Count(version_num) FROM db_version";
        $data = $this->db->query($query)->result();
        return json_encode($data);
    }
    
//     function add_db_version($db_count){
//         $data = array(
//             "version_num" => $db_count,
//         );
//         return $this -> insert($data);
//     }
}