<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function cek_login($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password); // Untuk TA, kita pakai teks biasa dulu agar mudah
        return $this->db->get('tb_users');
    }
    // Menyimpan data user baru (Registrasi)
    public function simpan_registrasi($data) {
     $this->db->insert('tb_users', $data);
 }
}