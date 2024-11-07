<?php

/**
 * @author 
 */
class Model_db_version extends MY_Model {
	
	public $table_name = "db_version";
	
	public function __construct() {
		parent::__construct ();
	}
	
    function get_data() {
    	$query = " SELECT *FROM db_version ORDER BY version DESC LIMIT 1";
    	$data = $this->db->query($query)->result();
    	return json_encode($data);
    }  
    
    function get_row_count() {
        $query = " SELECT Count(version_num) FROM db_version";
        $data = $this->db->query($query)->result();
        return json_encode($data);
    }
    
    function add_db_version($db_count){
        $data = array(
            "version_num" => $db_count,
        );
        return $this -> insert($data);
    }
    
}