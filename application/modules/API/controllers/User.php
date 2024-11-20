<?php
header('Content-Type: application/json');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_user'); 
    }

    public function get_user() {
        $result = $this->Model_user->get_data();
    
        if (!empty($result)) {
            echo json_encode(array(
                'data' => $result,
                'status' => 200,
                'message' => 'Data retrieved successfully'
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => 'Data not found'
            ));
        }
        exit;
    }

    public function add_user() {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validasi input
        if (empty($data['username']) || empty($data['email']) || empty($data['first_name']) || empty($data['last_name']) || empty($data['password'])) {
            echo json_encode(array(
                'status' => 400,
                'message' => 'Incomplete data. Please provide username, email, first_name, last_name, and password.'
            ));
            exit;
        }

        // Menambahkan user baru
        $isAdded = $this->Model_user->add_user($data);

        // Mengembalikan respons berdasarkan hasil penambahan
        if ($isAdded) {
            $this->getMessageResult(true);
        } else {
            $this->getMessageResult(false, 'Failed to add user. Please try again.');
        }
    }
    
   

    public function getMessageResult($isSuccess, $message = "") {
        if ($isSuccess) {
            echo json_encode(array(
                'status' => 200,
                'message' => "User berhasil ditambahkan."
            ));
        } else {
            echo json_encode(array(
                'status' => 500,
                'message' => $message ?: "Gagal menambahkan user."
            ));
        }
    }
}
?>
