<?php
class GuestbookApi extends Ci_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('guestbook_model');
    }

    public function insertData() {        
	$data_input = (array)json_decode(file_get_contents('php://input'));
	$required_data = "";
	if(!isset($data_input['nama'])) {
		$required_data = "Nama";
	} else if(!isset($data_input['no_hp'])) {
		$required_data = "No HP";
	} else if(!isset($data_input['alamat'])) {
		$required_data = "Alamat";
	} else if(!isset($data_input['email'])) {
		$required_data = "Email";
	} else if(!isset($data_input['cabang'])) {
		$required_data = "Cabang";
	} else if(!isset($data_input['no_ktp'])) {
		$data_input['no_ktp'] = "";
	}
	if($required_data == "") {
       	 $data = array(
            'nama' => $data_input['nama'],
       	    'no_hp' => $data_input['no_hp'],
            'email' => $data_input['email'],
            'alamat' => $data_input['alamat'],
            'no_ktp' => $data_input['no_ktp'],
            'cabang' => $data_input['cabang'],
	    'perusahaan' => isset($data_input['perusahaan']) ? $data_input['perusahaan'] : "",
        );
	
        $result = $this->guestbook_model->create($data);
        echo json_encode(array(
		'data' => $result,
		'status' => 200
		));
	} else {
	echo json_encode(array(
                'data' => false,
                'status' => 500,
		'message' => $required_data . " Harus Di Isi!!!",
                ));
	}
        exit;
    }
}
?>
