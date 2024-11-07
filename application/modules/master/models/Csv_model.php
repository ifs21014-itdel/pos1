<?php
class Csv_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_item() {
        $query = $this->db->get('item');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function insert_csv($data) {
        $this->db->insert('item', $data);
    }
    
//     function getId($cat1){
//         $query= "SELECT id FROM category Where name ilike'$cat1'";
//         $data=$this->db->query($query)->result();
//         return  json_encode($data);
//     }
}