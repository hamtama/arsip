<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model"); //load model mahasiswa
    }

    public function index()
    {
        // $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->session->userdata('logged') != TRUE) {
            if ($this->session->userdata('id_role') == 1) {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->join('user_role', 'users.id_role = user_role.id_role');
                $this->db->where('username', $this->session->userdata('username'));
                $data['user'] = $this->db->get()->row_array();
                $data['show_kejahatan'] = $this->Admin_model->show_kejahatan();
                $data['sum_kejahatan'] = $this->Admin_model->sum_kejahatan();
                $data['title'] = 'Halaman Administrator';
                $this->load->view('template/head', $data);
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/header', $data);
                $this->load->view('administrator/index', $data);
                $this->load->view('template/footer');
                $this->load->view('administrator/fungsi_i', $data);
            } else {
                redirect('user');
            }
        } else {
            redirect('auth');
        };
    }

    
}