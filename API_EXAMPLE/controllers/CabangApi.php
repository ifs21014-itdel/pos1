<?php
class CabangApi extends Ci_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('cabang_model');
    }

    public function getAll() {
     $result = $this->cabang_model->getAll();
     if(!empty($result)) {
        echo json_encode(array(
                'data' => $result,
                'status' => 200
                ));
        } else {
        echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "Data not found",
                ));
        }
        exit;
    }
}
?>
