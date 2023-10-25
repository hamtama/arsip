<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
    }

    public function index()
    {
        if ($this->session->userdata('logged') != TRUE) {
            if ($this->session->userdata('id_role') != 1) {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->join('user_role', 'users.id_role = user_role.id_role');
                $this->db->where('username', $this->session->userdata('username'));
                $data['user'] = $this->db->get()->row_array();
                $data['title'] = 'Halaman Utama';
                $this->load->view('template/head', $data);
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/header', $data);
                $this->load->view('user/index', $data);
                $this->load->view('template/footer');
            } else {
                redirect('auth/blocked');
            }
        } else {
            redirect('auth');
        }
    }
}
