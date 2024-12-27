<?php


class Category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_category');
        header('Content-Type: application/json');  
    }

    
    public function get_data($level = 0) {
        // Ambil data kategori berdasarkan level
        $data = $this->model_category->get_data($level);
        
        // Periksa apakah data ada
        if (!empty($data)) {
            // Jika ada data, kirimkan data tersebut dengan status success
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            // Jika data tidak ditemukan, kirimkan status success dan data null
            echo json_encode([
                'status' => 'success',
                'data' => null,
                'message' => 'No categories found'  // Bisa ditambahkan pesan jika perlu
            ]);
        }
        exit; // Jangan lupa exit setelah echo json_encode
    }
    
    
}
