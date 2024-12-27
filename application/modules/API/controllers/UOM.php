<?php

class UOM extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_uom');
    }

    function get() {
        // Ambil data UOM dari model
        $data = $this->load->Model_uom->get();
        
        // Pastikan data tidak kosong
        if (!empty($data)) {
            // Jika data ada, kirimkan sebagai array JSON
            echo json_encode(array(
                'data' => json_decode($data),  // Parsing JSON string menjadi array
                'status' => 200
            ));
        } else {
            // Jika data kosong, kirimkan pesan bahwa UOM tidak ditemukan
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "UOM not found"
            ));
        }
        exit;
    }
    
}