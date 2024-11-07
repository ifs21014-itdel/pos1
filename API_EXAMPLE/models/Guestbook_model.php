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

class Guestbook_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        return $this->db->insert('guesbook', array(
                    "nama" => $data['nama'],
                    "no_hp" => $data['no_hp'],
                    "email" => $data['email'],
                    "alamat" => $data['alamat'],
                    "no_ktp" => (int)$data['no_ktp'],
                    "cabang" => $data['cabang'],
		    "perusahaan" => $data['perusahaan'],
                ));
    }
    
}
?>
