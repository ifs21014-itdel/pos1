<?php

/**
 * Controller Item API
 *
 * @author Razal.Gurning
 */
class Item extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_item');
    }

    /**
     * Get all items data
     */
    public function get_data() {
        $result = $this->model_item->get_data();
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($result));
    }

    /**
     * Get item data by barcode
     */
    public function get_data_by_barcode($barcode) {
        $result = $this->model_item->get_data_by_barcode($barcode);
        if ($result) {
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode($result));
        } else {
            $this->output->set_status_header(404)
                         ->set_output(json_encode(['message' => 'Item not found']));
        }
    }




    /**
     * Get items with pagination
     */
    public function get_items() {
        // Mengambil parameter pencarian jika ada
        $search = $this->input->get('search'); // Mengambil parameter 'search' dari query string
    
        $items = $this->model_item->get_all_items($search);  // Menyertakan parameter pencarian
    
        if (!empty($items)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $items
            ];
            $this->output->set_status_header(200) // HTTP status code 200 OK
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
            $this->output->set_status_header(404) // HTTP status code 404 Not Found
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        }
    }
    
    
    public function add_item() {
        // Mendapatkan data yang dikirimkan melalui form-data
        $sku = $this->input->post('sku');
        $name = $this->input->post('name');
        $barcode = $this->input->post('barcode');
        $cost = $this->input->post('cost');
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $uom_id = $this->input->post('uom_id');
        $carton = $this->input->post('carton');
        $inner = $this->input->post('inner');
        $retail_price = $this->input->post('retail_price');
        $trading_price = $this->input->post('trading_price');
        $bkp = $this->input->post('bkp');
        $consignment = $this->input->post('consignment');
        $type = $this->input->post('type');
        $bom_status = $this->input->post('bom_status');
        $status_sku = $this->input->post('status_sku');
    
        // Debugging untuk memeriksa apakah data berhasil diambil
        error_log("Received Form Data: " . print_r($_POST, true));
    
        // Validasi data
        if (empty($sku) || empty($name) || empty($barcode) || empty($cost)) {
            $response = [
                'status' => 'error',
                'message' => 'Missing required fields'
            ];
            $this->output->set_status_header(400)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
            return;
        }
    
        // Handle gambar upload jika ada
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            // Panggil function untuk meng-handle upload gambar
            $image = $this->upload_image($_FILES['image']);
            error_log("dedi: " . print_r($image, true));

            if (!$image) {
                $response = [
                    'status' => 'error',
                    'message' => 'Image upload failed'
                ];
                $this->output->set_status_header(400)
                             ->set_content_type('application/json')
                             ->set_output(json_encode($response));
                return;
            }
        }
    
        // Panggil model add_item dengan semua parameter yang diperlukan
        $insert_result = $this->model_item->add_item(
            $sku,
            $name,
            $barcode,
            $cost,
            $category1,
            $category2,
            $category3,
            $category4,
            $uom_id,
            $carton,
            $inner,
            $retail_price,
            $bkp,
            $consignment,
            $type,
            $trading_price,
            $bom_status,
            $status_sku,
            $image // Menambahkan gambar
        );
    
        // Mengecek apakah insert berhasil
        if ($insert_result) {
            $response = [
                'status' => 'success',
                'message' => 'Item added successfully'
            ];
            $this->output->set_status_header(201)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to add itemsss'
            ];
            $this->output->set_status_header(500)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        }
    }
    
    // Fungsi untuk meng-handle upload gambar
    private function upload_image($file) {
        // Tentukan direktori tempat menyimpan file
        $upload_path = './files/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
       
        $config['file_name'] = time() . '_' . $file['name']; // Penamaan file unik
    
        error_log("Uploaded file name: " . $file['name']);
        error_log("Uploaded file type: " . $file['type']);
        error_log("Uploaded file extension: " . pathinfo($file['name'], PATHINFO_EXTENSION));
    
        // Memuat library upload
        $this->load->library('upload', $config);
    
        // Lakukan upload file
        if (!$this->upload->do_upload('image')) {
            // Jika upload gagal
            error_log("Image upload error: " . $this->upload->display_errors());
            return false;
        } else {
            // Jika upload berhasil
            $data = $this->upload->data();
            error_log("Uploaded file path: " . $data['full_path']);
    
            // Kompres gambar
            $this->compress_image($data['full_path']);
            return $data['file_name']; // Return nama file
        }
    }
    
    

    private function compress_image($path) {
        // Konfigurasi kompresi
        $config['image_library'] = 'gd2'; // Gunakan GD2 untuk manipulasi gambar
        $config['source_image'] = $path; // Path file gambar
        $config['maintain_ratio'] = true; // Menjaga rasio aspek
        $config['width'] = 800; // Lebar maksimum setelah kompresi
        $config['height'] = 800; // Tinggi maksimum setelah kompresi
        $config['quality'] = '80%'; // Kualitas kompresi
    
        // Memuat library Image Manipulation
        $this->load->library('image_lib', $config);
    
        // Lakukan kompresi
        if (!$this->image_lib->resize()) {
            error_log("Image compression error: " . $this->image_lib->display_errors());
        } else {
            error_log("Image successfully compressed: " . $path);
        }
    
        // Clear settings untuk manipulasi berikutnya
        $this->image_lib->clear();
    }
    
    
    
    
        
    
    

    /**
     * Update an existing item
     */
    public function edit_item()
    {
        // Mendapatkan ID item dari input
        $id = $this->input->post('id');
    
        // Validasi apakah ID ada
        if (empty($id)) {
            $response = [
                'status' => 'error',
                'message' => 'Item ID is required'
            ];
            $this->output->set_status_header(400)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
            return;
        }
    
        // Mendapatkan data yang dikirimkan melalui form-data
        $sku = $this->input->post('sku');
        $name = $this->input->post('name');
        $barcode = $this->input->post('barcode');
        $cost = $this->input->post('cost');
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $uom_id = $this->input->post('uom_id');
        $carton = $this->input->post('carton');
        $inner = $this->input->post('inner');
        $retail_price = $this->input->post('retail_price');
        $trading_price = $this->input->post('trading_price');
        $bkp = $this->input->post('bkp');
        $consignment = $this->input->post('consignment');
        $type = $this->input->post('type');
        $bom_status = $this->input->post('bom_status');
        $status_sku = $this->input->post('status_sku');
    
        // Debugging untuk memeriksa apakah data berhasil diambil
        error_log("Received Form Data: " . print_r($_POST, true));
    
        // Validasi data minimal
        if (empty($sku) || empty($name) || empty($barcode) || empty($cost)) {
            $response = [
                'status' => 'error',
                'message' => 'Missing required fields'
            ];
            $this->output->set_status_header(400)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
            return;
        }
    
        // Handle gambar upload jika ada
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            // Panggil function untuk meng-handle upload gambar
            $image = $this->upload_image($_FILES['image']);
    
            if (!$image) {
                $response = [
                    'status' => 'error',
                    'message' => 'Image upload failed'
                ];
                $this->output->set_status_header(400)
                             ->set_content_type('application/json')
                             ->set_output(json_encode($response));
                return;
            }
        }
    
        // Panggil model edit_item dengan semua parameter yang diperlukan
        $update_result = $this->model_item->update_item(
            $id,
            $sku,
            $name,
            $barcode,
            $cost,
            $category1,
            $category2,
            $category3,
            $category4,
            $uom_id,
            $carton,
            $inner,
            $retail_price,
            $bkp,
            $consignment,
            $type,
            $trading_price,
            $bom_status,
            $status_sku,
            $image // Menambahkan gambar jika ada
        );
    
        // Mengecek apakah update berhasil
        if ($update_result) {
            $response = [
                'status' => 'success',
                'message' => 'Item updated successfully'
            ];
            $this->output->set_status_header(200)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update item'
            ];
            $this->output->set_status_header(500)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        }
    }
    
    
    
    // Fungsi untuk meng-handle upload gambar
 
    
    /**
 * Get item data by id
 */
public function get_item_by_id() {
    $id = $this->input->get('id'); // Mengambil id dari query string

    if ($id) {
        $result = $this->model_item->get_item_by_id($id);
        if ($result) {
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode($result));
        } else {
            $this->output->set_status_header(404)
                         ->set_output(json_encode(['message' => 'Item not found']));
        }
    } else {
        $this->output->set_status_header(400)
                     ->set_output(json_encode(['message' => 'ID parameter is missing']));
    }
}


    /**
     * Delete an item
     */
    public function delete_item($id) {
        $result = $this->model_item->delete_item($id);
        
        if ($result) {
            $this->output->set_status_header(200)
                         ->set_output(json_encode(['message' => 'Item successfully deleted']));
        } else {
            $this->output->set_status_header(400)
                         ->set_output(json_encode(['message' => 'Failed to delete item']));
        }
    }
}
