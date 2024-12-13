<?php

class UOM extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_uom');
    }

    function get(){
        $data = $this->load->Model_uom->get();
        if (!empty($data)) {
            echo json_encode(array(
                'data' => $data,
                'status' => 200
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "UOM not found"
            ));
        }
        exit;
    }
}