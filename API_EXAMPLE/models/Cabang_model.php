<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Guestbook_model
 *
 * @author Yusuf PM Pangaribuan
 */

class Cabang_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
	$this->db->from('cabang');
        return $this->db->get()->result();
    }

}
?>
