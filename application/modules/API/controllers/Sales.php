<?php
class Sales extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_sales');
    }
  
    public function api_getCustomer() {
        $searchCustomerKey = null !== $this->input->post("searchCustomerKey") ? $this->input->post("searchCustomerKey") : "";
        $data = $this->model_sales->getCustomer($searchCustomerKey);

        if (!empty($data)) {
            echo json_encode(array(
                'data' => $data,
                'status' => 200
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "Customer not found"
            ));
        }
        exit;
    }


    public function api_getCustomers() {
        $searchCustomerKey = null !== $this->input->post("searchCustomerKey") ? $this->input->post("searchCustomerKey") : "";
        $data = $this->model_sales->getCustomers($searchCustomerKey);

        if (!empty($data)) {
            echo json_encode(array(
                'data' => $data,
                'status' => 200
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "Customers not found"
            ));
        }
        exit;
    }

    
    public function api_getItem() {
        $searchKey = null !== $this->input->post("searchKey") ? $this->input->post("searchKey") : "";
        $data = $this->model_sales->getItem($searchKey);

        if (!empty($data)) {
            echo json_encode(array(
                'data' => $data,
                'status' => 200
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 200,
                'message' => "Item not found"
            ));
        }
        exit;
    }

    public function api_getItems()
    {
        
        $searchKey = isset($_POST['searchKey']) ? $_POST['searchKey'] : "";

        
        $data = $this->model_sales->getItems($searchKey);

    
        $response = [
            'status' => 200,
            'success' => !empty($data),
            'message' => !empty($data) ? 'Items retrieved successfully' : 'Items not found',
            'data' => !empty($data) ? $data : [],
        ];

    
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }


        
    public function api_saveOrder() {
        
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
    
        // Memastikan data customer, items, dan payment ada dalam request
        if (empty($data['customer']) || empty($data['items']) || empty($data['payment'])) {
            echo json_encode([
                'status' => 400,
                'message' => 'Incomplete data. Customer, Items, and Payment data are required.'
            ]);
            exit;
        }
    
        // Transformasi data menjadi objek
        $customer = (object) $data['customer'];
        $items = array_map(function($item) {
            return (object) $item;  // Konversi setiap item menjadi objek
        }, $data['items']);
        $payment = (object) $data['payment'];
    
        // Panggil model untuk menyimpan order
        $order = $this->model_sales->saveOrder($customer, $items, $payment);
    
        // Mengirimkan response API
        if ($order) {
            echo json_encode([
                'status' => 200,
                'message' => 'Order saved successfully.',
                'data' => $order
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to save order. Please try again.'
            ]);
        }
        exit;
    }
    
    

    // API to check user permission to update discount
    public function api_checkUserPermissionToUpdateDiscount() {
        $isAuthorized = Authority::hasPermission(Permission::CASHIER_UPDATE_DISCOUNT);

        echo json_encode(array(
            'data' => $isAuthorized,
            'status' => 200,
            'success' => $isAuthorized,
            'message' => $isAuthorized ? "Permission granted" : "Permission denied"
        ));
        exit;
    }

    // API to get received data by sales ID
    public function api_getReceivedData() {
        $salesId = null !== $this->input->post("salesId") ? $this->input->post("salesId") : null;
        $data = $this->model_sales->getReceivedData($salesId);

        if ($data) {
            echo json_encode(array(
                'data' => $data,
                'status' => 200,
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 404,
                'message' => "Received data not found"
            ));
        }
        exit;
    }

    function apiPrintReceive() {
        // Load model untuk pengaturan
        $this->load->model("system/Model_settings");
        
        // Ambil pengaturan perusahaan
        $COMPANY_NAME = $this->Model_settings->get_setting_value('COMPANY_NAME');
        $COMPANY_ADDRESS = $this->Model_settings->get_setting_value('COMPANY_ADDRESS');
        $COMPANY_TELEPHONE = $this->Model_settings->get_setting_value('COMPANY_TELEPHONE');
        $STORE_NPWP = $this->Model_settings->get_setting_value('STORE_NPWP');
        
        // Persiapkan data pengaturan perusahaan
        $settings = array(
            "COMPANY_NAME" => $COMPANY_NAME,
            "COMPANY_ADDRESS" => $COMPANY_ADDRESS,
            "COMPANY_TELEPHONE" => $COMPANY_TELEPHONE,
            "STORE_NPWP" => $STORE_NPWP
        );
        
        // Ambil ID transaksi sales dari parameter GET
        $salesId = $this->input->get("salesId");
        error_log("errorid:".$salesId);
        
        // Pastikan salesId ada
        if (!$salesId) {
            echo json_encode(array(
                'status' => 400,
                'message' => 'Sales ID tidak ditemukan.'
            ));
            exit;
        }
        
        // Load model untuk sales data
        $this->load->model("sales/model_sales");
        
        // Ambil data transaksi berdasarkan salesId
        $orderData = $this->model_sales->getReceivedData($salesId);
        
        // Cek apakah data transaksi ada
        if (empty($orderData['sales'])) {
            echo json_encode(array(
                'status' => 404,
                'message' => 'Data transaksi tidak ditemukan.'
            ));
            exit;
        }
        
        // Ambil data transaksi sales dan detailnya
        $salesData = $orderData['sales'];
        $salesDetails = $orderData['salesDetails'];
        $customerData = $orderData['customer'];
    
        // Persiapkan data untuk dicetak
        $receiptData = array(
            'company' => $settings,
            'sales' => $salesData,
            'salesDetails' => $salesDetails,
            'customer' => $customerData
        );
    
        // Menyusun response untuk print
        echo json_encode(array(
            'status' => 200,
            'message' => 'Data siap untuk dicetak.',
            'data' => $receiptData
        ));
        exit;
    }
    
    
    
    
}
?>
