<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->session();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        if ($this->session->userdata('id')) {
            $this->load->model('company_organization/Model_cabang');
            $data['menu_group'] = $this->Model_user->selectMenuGroup($this->session->userdata('id'));
            //$data['cabang'] = $this->Model_cabang->selectById($this->session->userdata('cost_center_id'));
            $this->load->view('home', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function login() {
        $this->load->model("configuration/Model_user");
        $user = $this->Model_user->selectRowByNameAndPassword($this->input->post('user_name'), md5($this->input->post('password')));
        $type = $this->input->post("type");
        if (!empty($user)) {
            $this->session->set_userdata('id', $user->id);
            $this->session->set_userdata('name', $user->name);
            $this->session->set_userdata('cost_center_id', $user->cabang_id);
            $this->session->set_userdata('cabang_id', $user->cabang_id);
            if (empty($type)) {
                redirect(base_url());
            } else {
                echo json_encode(array('success' => true));
            }
        } else {
            $msg = "User and Password Faild!";
            if (empty($type)) {
                $this->session->set_userdata('msg', $msg);
                redirect(base_url());
            } else {
                echo json_encode(array('msg' => $msg));
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('id');
        redirect('');
    }

    public function getMenu() {
        $this->load->model("configuration/Model_user");
        echo json_encode($this->Model_user->selectMenuByUser($this->session->userdata('id')));
    }

    public function loginCheck() {
        if (!$this->session->userdata('id')) {
            $this->load->view('login');
        }
    }

    function user_login() {
        $this->load->view('login');
    }

    function changePassword() {
        $this->load->view('change_password');
    }

    function checkSession() {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $request = $this->input->request_headers();
//$time = date('r');
        $check = false;
        if ($this->session->userdata('id')) {
            $check = true;
        }
        if ($request["Accept"] == "text/event-stream") {
            echo "data:{$check}\n\n";
        } else {
            echo json_encode(array("alive" => $check));
        }
        flush();
    }

}
