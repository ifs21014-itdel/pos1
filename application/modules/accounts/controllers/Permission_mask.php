<?php
/**
 * @author Rizal Gurning
 */
class Permission_mask extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_permission_mask');
    }

    function index() {
        $this->load->view('accounts/accounts/permission_mask/view');
    }

    function get_permission_masks_with_pagination(){
    	$page = $this->input->post('page');
    	$rows = $this->input->post('rows');
    	$searchCriteriaByCode = $this->input->post('code'); 
    	$searchCriteriaByGroupCode = $this->input->post('group_code');

    	$result = $this->model_permission_mask->get_permission_masks_with_pagination($page, $rows, $searchCriteriaByCode, $searchCriteriaByGroupCode);
    	echo json_encode($result);
    }
}
