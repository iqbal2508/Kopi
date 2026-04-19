<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_auth');
    }

    // Menampilkan Halaman Login
    public function index() {
        $this->load->view('v_login');
    }

    // Memproses Data dari Form Login
    public function proses_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cek = $this->M_auth->cek_login($email, $password);
    
        if($cek->num_rows() > 0) {
            $data_user = $cek->row_array();
            
            // Tetap pakai cara lama kamu
            $this->session->set_userdata('id_user', $data_user['id_user']);
            $this->session->set_userdata('nama', $data_user['nama_lengkap']);
            $this->session->set_userdata('role', $data_user['role']);
    
            if($data_user['role'] == 'admin') {
                redirect('Admin');
            } else {
                redirect('Home');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Email atau Password salah!</div>');
            redirect('Auth');
        }
    }

    // Proses Keluar (Hapus Session)
    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth');
    }
    // Halaman Form Registrasi
    public function registrasi() {
     $this->load->view('v_registrasi');
 }

 // Proses Simpan Registrasi
 public function proses_registrasi() {
     $data = array(
         'nama_lengkap' => $this->input->post('nama'),
         'email'        => $this->input->post('email'),
         'password'     => $this->input->post('password'),
         'role'         => 'pelanggan' // Default pendaftar adalah pelanggan
     );

     $this->M_auth->simpan_registrasi($data);
     $this->session->set_flashdata('pesan', '<div class="alert alert-success">Registrasi berhasil! Silakan login.</div>');
     redirect('Auth');
 }
}