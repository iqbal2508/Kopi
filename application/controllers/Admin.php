<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // PENGAMAN: Kunci pintu admin. Jika bukan admin, hancurkan sesi dan tendang ke login.
        if(!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            $this->session->sess_destroy();
            redirect('Auth');
        }

        $this->load->model('M_admin');
        $this->load->model('M_katalog');
        $this->load->library('cart');
        $this->load->helper('url');
    }

    // 1. DASHBOARD UTAMA
    public function index() {
        $data['title'] = "POS Kasir - Jejak Rasa Kopi";
        // Mengambil transaksi yang BELUM di-soft delete dari dashboard
        $data['transaksi'] = $this->M_admin->get_semua_transaksi();
        
        $this->load->view('v_admin_dashboard', $data);
    }

    // 2. UBAH STATUS & UPDATE KUPON
    public function ubah_status($id_transaksi, $status) {
        // Update status pesanan
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status_pesanan' => $status));

        // Logika Stempel/Kupon jika status Selesai
        if($status == 'Selesai') {
            $trx = $this->db->get_where('tb_transaksi', ['id_transaksi' => $id_transaksi])->row_array();
            
            // Berikan kupon hanya jika ini user terdaftar (bukan pesanan kasir offline)
            if($trx && $trx['id_user'] != 0) { 
                $user = $this->db->get_where('tb_users', ['id_user' => $trx['id_user']])->row_array();
                
                // Cek syarat: belum klaim promo besar & stempel < 5
                if($user['is_kupon_klaim'] == 0 && $user['stempel_kopi'] < 5) {
                    $this->db->set('stempel_kopi', 'stempel_kopi+1', FALSE);
                    $this->db->where('id_user', $trx['id_user']);
                    $this->db->update('tb_users');
                }
            }
        }
        redirect('Admin');
    }

    // 3. FITUR POS (KASIR OFFLINE)
    public function pos() {
        $data['title'] = "Layar Kasir POS - Jejak Rasa Kopi";
        $data['produk'] = $this->M_katalog->get_produk();
        $this->load->view('v_admin_pos', $data);
    }

    public function tambah_pos($id_produk) {
        $produk = $this->db->get_where('tb_produk', array('id_produk' => $id_produk))->row_array();
        if($produk) {
            $data = array(
                'id'    => $produk['id_produk'],
                'qty'   => 1,
                'price' => $produk['harga'],
                'name'  => $produk['nama_produk']
            );
            $this->cart->insert($data);
        }
        redirect('Admin/pos');
    }

    public function reset_pos() {
        $this->cart->destroy();
        redirect('Admin/pos');
    }

    public function proses_pos() {
        if(empty($this->cart->contents())) { redirect('Admin/pos'); }

        date_default_timezone_set('Asia/Jakarta');
        $id_transaksi = 'POS-' . date('Ymd-Hi'); 

        $data_transaksi = array(
            'id_transaksi' => $id_transaksi,
            'id_user' => 0, 
            'total_bayar' => $this->cart->total(),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'tipe_pesanan' => 'Dine In', 
            'status_pesanan' => 'Selesai'
        );
        $this->M_katalog->insert_transaksi($data_transaksi);

        foreach ($this->cart->contents() as $item) {
            $data_detail = array(
                'id_transaksi' => $id_transaksi,
                'id_produk' => $item['id'],
                'qty' => $item['qty'],
                'harga_satuan' => $item['price'],
                'subtotal' => $item['subtotal']
            );
            $this->M_katalog->insert_detail_transaksi($data_detail);
            // Potong stok otomatis
            $this->M_katalog->kurangi_stok($item['id'], $item['qty']);
        }

        $this->cart->destroy();
        redirect('Admin');
    }

    // 4. KELOLA PRODUK (CRUD)
    public function produk() {
        $data['title'] = "Kelola Menu - Jejak Rasa Kopi";
        $data['produk'] = $this->M_admin->get_semua_produk();
        $data['kategori'] = $this->db->get('tb_kategori')->result_array(); 
        $this->load->view('v_admin_produk', $data);
    }

    public function aksi_tambah_produk() {
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name']     = 'kopi-' . date('YmdHis');

        $this->load->library('upload', $config);

        $gambar = ($this->upload->do_upload('gambar')) ? $this->upload->data('file_name') : 'default.jpg';

        $data = array(
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
            'gambar'      => $gambar
        );

        $this->M_admin->tambah_produk($data);
        redirect('Admin/produk');
    }

    public function edit_produk($id_produk) {
        $data['title'] = "Edit Menu Kopi - Admin";
        $data['produk'] = $this->M_admin->get_produk_by_id($id_produk);
        $this->load->view('v_admin_edit_produk', $data);
    }

    public function proses_edit_produk() {
        $id_produk = $this->input->post('id_produk');
        $gambar_lama = $this->input->post('gambar_lama');

        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name']     = 'kopi-edit-' . date('Ymd-His');
        
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_baru')) {
            $gambar_final = $this->upload->data('file_name');
            if(file_exists('./assets/uploads/'.$gambar_lama)) { unlink('./assets/uploads/'.$gambar_lama); }
        } else {
            $gambar_final = $gambar_lama;
        }

        $data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
            'gambar'      => $gambar_final
        );

        $this->M_admin->update_produk($id_produk, $data);
        redirect('Admin/produk');
    }

    public function hapus_produk($id_produk) {
        $this->M_admin->hapus_produk($id_produk);
        redirect('Admin/produk');
    }

    // 5. LAPORAN & SOFT DELETE
    public function laporan() {
        $data['title'] = "Laporan Penjualan - Jejak Rasa Kopi";
        $data['laporan'] = $this->M_admin->get_laporan();
        $data['total_pendapatan'] = $this->M_admin->get_total_pendapatan();
        $this->load->view('v_admin_laporan', $data);
    }

    public function hapus_transaksi($id_transaksi) {
        // Menggunakan SOFT DELETE agar hilang di dashboard tapi tetap ada di laporan
        $this->M_admin->hapus_transaksi($id_transaksi);
        redirect('Admin');
    }

    public function hapus_laporan($id_transaksi) {
        // Benar-benar menghapus data dari database (permanent)
        $this->M_admin->hapus_laporan($id_transaksi);
        redirect('Admin/laporan');
    }

    public function reset_laporan() {
        $this->M_admin->reset_semua_laporan();
        redirect('Admin/laporan');
    }

    // 6. KELOLA PENGGUNA
    public function users() {
        $data['title'] = "Kelola User - Jejak Rasa Kopi";
        $data['users'] = $this->M_admin->get_semua_user();
        $this->load->view('v_admin_users', $data);
    }

    public function hapus_user($id_user) {
        $this->M_admin->hapus_user($id_user);
        redirect('Admin/users');
    }

    public function detail($id_transaksi) {
        $data['title'] = "Detail Pesanan - Jejak Rasa Kopi";
        $data['transaksi'] = $this->M_admin->get_transaksi_by_id($id_transaksi);
        $data['detail'] = $this->M_admin->get_detail_transaksi($id_transaksi);
        if(empty($data['transaksi'])) { redirect('Admin'); }
        $this->load->view('v_admin_detail', $data);
    }
}