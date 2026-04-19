<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Jika tidak ada session ATAU yang login adalah admin, tendang ke login
        // Ini supaya kalau kamu login admin di tab lain, tab user ini otomatis gak bisa diakses
        if(!$this->session->userdata('id_user') || $this->session->userdata('role') != 'pelanggan') {
            $this->session->sess_destroy(); // Hancurkan sesi yang salah
            redirect('Auth');
        }
        $this->load->model('M_katalog');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Jejak Rasa Kopi - Welcome";
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $this->load->view('v_home_landing', $data);
    }

    public function menu() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Katalog Menu - Jejak Rasa Kopi";
        $data['promo'] = $this->M_katalog->get_promo();
        $data['produk'] = $this->M_katalog->get_produk();
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $this->load->view('v_home', $data);
    }

    public function contact_us() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Hubungi Kami - Jejak Rasa Kopi";
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $this->load->view('v_contact_us', $data);
    }

    public function tambah_keranjang($id_produk) {
        $id_user = $this->session->userdata('id_user');
        $cek = $this->M_katalog->cek_keranjang($id_user, $id_produk);
        if($cek) {
            $qty_baru = $cek['qty'] + 1;
            $this->M_katalog->update_qty_keranjang($cek['id_keranjang'], $qty_baru);
        } else {
            $data = array(
                'id_user' => $id_user,
                'id_produk' => $id_produk,
                'qty' => 1,
                'catatan_tambahan' => ''
            );
            $this->M_katalog->insert_keranjang($data);
        }
        redirect('Home/menu'); 
    }

    public function keranjang() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Keranjang Belanja - Jejak Rasa Kopi";
        $data['isi_keranjang'] = $this->M_katalog->get_isi_keranjang($id_user);
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $this->load->view('v_keranjang', $data);
    }

    public function hapus_keranjang($id_keranjang) {
        $this->M_katalog->hapus_item_keranjang($id_keranjang);
        redirect('Home/keranjang');
    }

    // --- LOGIKA CHECKOUT DENGAN PEMILIHAN KOPI GRATIS ---
    public function checkout() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Checkout Pesanan - Jejak Rasa Kopi";
        $data['isi_keranjang'] = $this->M_katalog->get_isi_keranjang($id_user);
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $data['user'] = $this->M_katalog->get_user_data($id_user); 

        if(empty($data['isi_keranjang'])) {
            redirect('Home/menu');
        }

        $total_belanja = 0;
        foreach($data['isi_keranjang'] as $item) {
            $total_belanja += ($item['harga'] * $item['qty']);
        }
        $data['total_belanja'] = $total_belanja;

        $diskon = 0;
        $hadiah = $data['user']['hadiah_game'];

        if($hadiah == 'Diskon 10%') {
            $diskon = $total_belanja * 0.10;
        } elseif($hadiah == 'Diskon 20%') {
            $diskon = $total_belanja * 0.20;
        } elseif($hadiah == 'Voucher 10rb') {
            $diskon = 10000;
        } elseif($hadiah == 'Kopi Gratis') {
            // Default diskon di layar: ambil harga item pertama di keranjang
            $diskon = $data['isi_keranjang'][0]['harga']; 
        }

        if($diskon > $total_belanja) $diskon = $total_belanja;

        $data['diskon'] = $diskon;
        $data['total_akhir'] = $total_belanja - $diskon;

        $this->load->view('v_checkout', $data);
    }

    // --- LOGIKA PROSES PESANAN (FIX KOPI GRATIS) ---
    public function proses_pesanan() {
        $id_user = $this->session->userdata('id_user'); 
        $user = $this->M_katalog->get_user_data($id_user);

        $tipe_pesanan = $this->input->post('tipe_pesanan');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $isi_keranjang = $this->M_katalog->get_isi_keranjang($id_user);

        $total_belanja = 0;
        foreach($isi_keranjang as $item) {
            $total_belanja += ($item['harga'] * $item['qty']);
        }

        $diskon = 0;
        $hadiah = $user['hadiah_game'];
        
        if($hadiah == 'Diskon 10%') {
            $diskon = $total_belanja * 0.10;
        } elseif($hadiah == 'Diskon 20%') {
            $diskon = $total_belanja * 0.20;
        } elseif($hadiah == 'Voucher 10rb') {
            $diskon = 10000;
        } elseif($hadiah == 'Kopi Gratis') {
            // Tangkap produk yang dipilih user dari dropdown v_checkout
            $id_produk_gratis = $this->input->post('id_produk_gratis');
            foreach($isi_keranjang as $item) {
                if($item['id_produk'] == $id_produk_gratis) {
                    $diskon = $item['harga']; // Potong 100% harga produk tersebut
                    break;
                }
            }
        }

        if($diskon > $total_belanja) $diskon = $total_belanja;
        $total_bayar_akhir = $total_belanja - $diskon;

        date_default_timezone_set('Asia/Jakarta');
        $id_transaksi = 'INV-' . date('Ymd-His');

        $data_transaksi = array(
            'id_transaksi' => $id_transaksi,
            'id_user' => $id_user,
            'total_bayar' => $total_bayar_akhir,
            'metode_pembayaran' => $metode_pembayaran,
            'tipe_pesanan' => $tipe_pesanan,
            'status_pesanan' => 'Menunggu Pembayaran'
        );
        $this->M_katalog->insert_transaksi($data_transaksi);

        foreach($isi_keranjang as $item) {
            $data_detail = array(
                'id_transaksi' => $id_transaksi,
                'id_produk' => $item['id_produk'],
                'qty' => $item['qty'],
                'harga_satuan' => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty']
            );
            $this->M_katalog->insert_detail_transaksi($data_detail);
            $this->M_katalog->kurangi_stok($item['id_produk'], $item['qty']);
        }

        $this->M_katalog->kosongkan_keranjang($id_user);
        $this->M_katalog->reset_hadiah_user($id_user); 
        
        redirect('Home/pesanan_sukses/'.$id_transaksi);
    }

    public function pesanan_sukses($id_transaksi = '') {
        if(empty($id_transaksi)) { redirect('Home/menu'); }
        $data['title'] = "Pesanan Berhasil - Jejak Rasa Kopi";
        $data['id_transaksi'] = $id_transaksi;
        $id_user = $this->session->userdata('id_user');
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $this->load->view('v_sukses', $data);
    }

    public function riwayat() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Riwayat Pesanan - Jejak Rasa Kopi";
        $data['riwayat'] = $this->M_katalog->get_riwayat_pesanan($id_user);
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user); 
        $this->load->view('v_riwayat', $data);
    }

    public function game() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Roda Keberuntungan - Jejak Rasa Kopi";
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $data['user'] = $this->M_katalog->get_user_data($id_user);
        $this->load->view('v_game', $data);
    }

    public function klaim_hadiah() {
        $id_user = $this->session->userdata('id_user');
        $hadiah = $this->input->post('hadiah');
        $this->M_katalog->simpan_hadiah_user($id_user, $hadiah);
        echo json_encode(array('status' => 'sukses'));
    }

    public function kupon() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "Kumpulkan Kupon - Jejak Rasa Kopi";
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $data['user'] = $this->M_katalog->get_user_data($id_user);
        $this->load->view('v_kupon', $data);
    }

    public function klaim_kupon() {
        $id_user = $this->session->userdata('id_user');
        $this->M_katalog->klaim_kupon($id_user);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success fw-bold text-center mb-4">🎉 SELAMAT! 1 Kopi Gratis telah ditambahkan ke akunmu. Silakan pesan kopi apa saja dan pilih produk yang digratiskan di Checkout!</div>');
        redirect('Home/kupon');
    }
    public function challenge_10s() {
        $id_user = $this->session->userdata('id_user'); 
        $data['title'] = "10-Second Challenge - Jejak Rasa Kopi";
        $data['total_keranjang'] = $this->M_katalog->hitung_keranjang($id_user);
        $data['user'] = $this->M_katalog->get_user_data($id_user);
        $this->load->view('v_challenge_10s', $data);
    }

    public function proses_menang_10s() {
        $id_user = $this->session->userdata('id_user');
        // Berikan hadiah Kopi Gratis
        $this->M_katalog->simpan_hadiah_user($id_user, 'Kopi Gratis');
        echo json_encode(['status' => 'sukses']);
    }

    public function gunakan_jatah_10s() {
        $id_user = $this->session->userdata('id_user');
        $this->M_katalog->kurangi_jatah_10detik($id_user);
        echo json_encode(['status' => 'jatah_dikurangi']);
    }
}