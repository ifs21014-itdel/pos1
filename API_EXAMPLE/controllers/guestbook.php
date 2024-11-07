<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class guestbook extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_guestbook');
    }

   public function index_post() {
        $data = array(
            'nama' => $this->input->post('nama'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'no_ktp' => $this->input->post('no_ktp'),
            'cabang' => $this->input->post('cabang'),
        );

        $result = $this->model_guestbook->create($data);
        if ($result) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
