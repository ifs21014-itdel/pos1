<?php
class Sales extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_sales');
    }
    // API to get a single customer by search key
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

    // API to get a single item by search key
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

    // API to get all items by search key
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


    // API to save order
    public function api_saveOrder() {
        $order = json_decode($this->input->post("order"), true);
        $customer = isset($order['customer']) ? $order['customer'] : null;
        $items = isset($order['items']) ? $order['items'] : null;
        $payment = isset($order['payment']) ? $order['payment'] : null;

        $orderData = $this->model_sales->saveOrder($customer, $items, $payment);

        if ($orderData) {
            echo json_encode(array(
                'data' => $orderData,
                'status' => 200,
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'data' => false,
                'status' => 500,
                'message' => "Failed to save order"
            ));
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
    
    
}
?>
