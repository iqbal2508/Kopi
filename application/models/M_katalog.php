<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_katalog extends CI_Model {

    // Mengambil semua menu produk kopi
    public function get_produk() {
        return $this->db->get('tb_produk')->result_array();
    }

    // Mengambil promo yang statusnya 'Y' (Aktif)
    public function get_promo() {
        $this->db->where('status_aktif', 'Y');
        return $this->db->get('tb_promo')->result_array();
    }

    // Cek apakah produk sudah ada di keranjang user
    public function cek_keranjang($id_user, $id_produk) {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_produk', $id_produk);
        return $this->db->get('tb_keranjang')->row_array();
    }

    // Tambah produk baru ke keranjang
    public function insert_keranjang($data) {
        $this->db->insert('tb_keranjang', $data);
    }

    // Update jumlah (qty) jika produk sudah ada di keranjang
    public function update_qty_keranjang($id_keranjang, $qty_baru) {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->update('tb_keranjang', array('qty' => $qty_baru));
    }

    // Menghitung total barang di keranjang untuk ditampilkan di Navbar
    public function hitung_keranjang($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->select_sum('qty');
        $query = $this->db->get('tb_keranjang')->row();
        return $query->qty ? $query->qty : 0;
    }
// Mengambil detail isi keranjang beserta nama dan harga produk
public function get_isi_keranjang($id_user) {
     $this->db->select('tb_keranjang.*, tb_produk.nama_produk, tb_produk.harga, tb_produk.gambar');
     $this->db->from('tb_keranjang');
     $this->db->join('tb_produk', 'tb_keranjang.id_produk = tb_produk.id_produk');
     $this->db->where('tb_keranjang.id_user', $id_user);
     return $this->db->get()->result_array();
 }
 // Simpan data transaksi utama ke tabel tb_transaksi
 public function insert_transaksi($data) {
     $this->db->insert('tb_transaksi', $data);
 }

 // Simpan rincian pesanan ke tabel tb_detail_transaksi
 public function insert_detail_transaksi($data) {
     $this->db->insert('tb_detail_transaksi', $data);
 }

 // Kosongkan keranjang setelah pesanan berhasil dibuat
 public function kosongkan_keranjang($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->delete('tb_keranjang');
}
 // Menghapus 1 item spesifik dari keranjang
 public function hapus_item_keranjang($id_keranjang) {
    $this->db->where('id_keranjang', $id_keranjang);
    $this->db->delete('tb_keranjang');
}
// Fungsi untuk memotong stok produk secara otomatis
public function kurangi_stok($id_produk, $qty_dibeli) {
    // 1. Ambil data stok produk saat ini
    $this->db->where('id_produk', $id_produk);
    $produk = $this->db->get('tb_produk')->row_array();

    if($produk) {
        // 2. Kurangi stok lama dengan jumlah yang dibeli
        $stok_baru = $produk['stok'] - $qty_dibeli;
        
        // (Opsional) Cegah stok menjadi minus (kurang dari 0)
        if($stok_baru < 0) {
            $stok_baru = 0;
        }

        // 3. Update / Simpan sisa stok kembali ke database
        $this->db->where('id_produk', $id_produk);
        $this->db->update('tb_produk', array('stok' => $stok_baru));
    }
}
// Mengambil riwayat pesanan khusus untuk user yang sedang login
public function get_riwayat_pesanan($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->order_by('tgl_transaksi', 'DESC'); // Urutkan dari yang terbaru
    return $this->db->get('tb_transaksi')->result_array();
}
// Mengambil data spesifik user (termasuk jatah spin)
public function get_user_data($id_user) {
    $this->db->where('id_user', $id_user);
    return $this->db->get('tb_users')->row_array();
}

// Mengupdate data user (mengurangi jatah spin dan simpan hadiah)
public function simpan_hadiah_user($id_user, $hadiah) {
    $this->db->where('id_user', $id_user);
    $this->db->update('tb_users', array(
        'jatah_spin' => 0,       // Habiskan jatah mainnya
        'hadiah_game' => $hadiah // Simpan hadiahnya
    ));
}
// Menghapus hadiah setelah dipakai checkout
public function reset_hadiah_user($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->update('tb_users', array('hadiah_game' => NULL));
}
// Fungsi untuk mengklaim 5 kupon menjadi 1 Kopi Gratis
public function klaim_kupon($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->update('tb_users', array(
        'is_kupon_klaim' => 1, // Kunci promo (hanya 1x seumur hidup)
        'hadiah_game' => 'Kopi Gratis' // Berikan hadiahnya
    ));
}
public function kurangi_jatah_10detik($id_user) {
    $this->db->set('jatah_10detik', 'jatah_10detik-1', FALSE);
    $this->db->where('id_user', $id_user);
    $this->db->update('tb_users');
}

} // <-- Pastikan kurung kurawal penutup class ini ada di paling bawah