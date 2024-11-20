<?php
class Model_user extends CI_Model {

    public $table_name = "kds_user"; // Nama tabel

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk mendapatkan semua data user
    public function get_data() {
        $this->db->from($this->table_name);
        return $this->db->get()->result();
    }

    // Fungsi untuk mendapatkan data user berdasarkan kondisi tertentu
    public function select_where($where) {
        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    // Fungsi untuk menambahkan user baru
    public function add_user($data) {
        return $this->db->insert($this->table_name, array(
            "active" => isset($data['active']) ? $data['active'] : true,
            "email" => $data['email'],
            "username" => $data['username'],
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "user_password" => md5($data['password']), // Hash password
            "password_reset" => isset($data['password_reset']) ? $data['password_reset'] : false
        ));
    }
}
?>
