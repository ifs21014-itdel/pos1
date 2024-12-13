<?php


class Category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_category');
        header('Content-Type: application/json');  
    }

    
    public function get_data($level = 0) {
        $data = $this->model_category->get_data($level);
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
