<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

    // Mengambil semua data transaksi dari yang paling baru
  // Mengambil semua transaksi untuk Dashboard Kasir
  public function get_semua_transaksi() {
    $this->db->select('tb_transaksi.*, tb_users.nama_lengkap');
    $this->db->from('tb_transaksi');
    $this->db->join('tb_users', 'tb_transaksi.id_user = tb_users.id_user', 'left');
    
    // ---> INI KUNCI UTAMANYA: Hanya tampilkan yang belum dihapus dari dashboard <---
    $this->db->where('is_deleted_dashboard', 0); 
    
    $this->db->order_by('tgl_transaksi', 'DESC');
    return $this->db->get()->result_array();
}

    // Mengubah status pesanan (misal: Diproses / Selesai)
    public function update_status_pesanan($id_transaksi, $status_baru) {
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status_pesanan' => $status_baru));
    }
    // Mengambil data 1 transaksi spesifik untuk detail
    public function get_transaksi_by_id($id_transaksi) {
     $this->db->where('id_transaksi', $id_transaksi);
     return $this->db->get('tb_transaksi')->row_array();
 }

 // Mengambil rincian kopi apa saja di dalam transaksi tersebut
 public function get_detail_transaksi($id_transaksi) {
     $this->db->select('tb_detail_transaksi.*, tb_produk.nama_produk');
     $this->db->from('tb_detail_transaksi');
     $this->db->join('tb_produk', 'tb_detail_transaksi.id_produk = tb_produk.id_produk');
     $this->db->where('tb_detail_transaksi.id_transaksi', $id_transaksi);
     return $this->db->get()->result_array();
 }
 // Mengambil data transaksi yang sudah Selesai untuk laporan
 public function get_laporan() {
    $this->db->where('status_pesanan', 'Selesai');
    $this->db->order_by('tgl_transaksi', 'DESC');
    return $this->db->get('tb_transaksi')->result_array();
}

// Menghitung total omzet/pendapatan
public function get_total_pendapatan() {
    $this->db->select_sum('total_bayar');
    $this->db->where('status_pesanan', 'Selesai');
    $query = $this->db->get('tb_transaksi')->row();
    return $query->total_bayar ? $query->total_bayar : 0;
}
// Mengambil semua produk beserta nama kategorinya
public function get_semua_produk() {
    $this->db->select('tb_produk.*, tb_kategori.nama_kategori');
    $this->db->from('tb_produk');
    $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left');
    return $this->db->get()->result_array();
}

// Menyimpan produk baru ke database
public function tambah_produk($data) {
    $this->db->insert('tb_produk', $data);
}

// Menghapus produk
public function hapus_produk($id_produk) {
    $this->db->where('id_produk', $id_produk);
    $this->db->delete('tb_produk');
}
// --- FITUR HAPUS TRANSAKSI ---
// Fitur Soft Delete: Sembunyikan dari Dashboard, tapi tetap ada di Database & Laporan
public function hapus_transaksi($id_transaksi) {
    $this->db->where('id_transaksi', $id_transaksi);
    // Kita gunakan UPDATE, bukan DELETE
    $this->db->update('tb_transaksi', array('is_deleted_dashboard' => 1));
}

// --- FITUR KELOLA USER ---
// Mengambil daftar pelanggan (role selain admin)
public function get_semua_user() {
    $this->db->where('role', 'pelanggan');
    return $this->db->get('tb_users')->result_array();
}

// Menghapus akun pelanggan
public function hapus_user($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->delete('tb_users');
}
// Menghapus 1 transaksi secara permanen dari laporan
public function hapus_laporan($id_transaksi) {
    $this->db->where('id_transaksi', $id_transaksi);
    $this->db->delete('tb_detail_transaksi');

    $this->db->where('id_transaksi', $id_transaksi);
    $this->db->delete('tb_transaksi');
}

// Menghapus semua transaksi yang sudah "Selesai" (Reset Laporan)
public function reset_semua_laporan() {
    $this->db->where('status_pesanan', 'Selesai');
    $this->db->delete('tb_transaksi');
}
// Ambil 1 data produk berdasarkan ID (untuk ditampilkan di form edit)
public function get_produk_by_id($id_produk) {
    $this->db->where('id_produk', $id_produk);
    return $this->db->get('tb_produk')->row_array();
}

// Proses update data produk ke database
public function update_produk($id_produk, $data) {
    $this->db->where('id_produk', $id_produk);
    $this->db->update('tb_produk', $data);
}
// Fungsi untuk menyimpan data inputan manual
public function simpan_keuangan($data) {
    return $this->db->insert('tb_keuangan', $data);
}

// Fungsi untuk memanggil riwayat pembukuan dari yang terbaru
public function get_riwayat_keuangan() {
    $this->db->order_by('waktu_input', 'DESC');
    return $this->db->get('tb_keuangan')->result_array();
}
// --- FUNGSI HALAMAN PENDAPATAN (TAMBAHAN EDIT & HAPUS) ---
public function hapus_keuangan($id) {
    return $this->db->delete('tb_keuangan', ['id_keuangan' => $id]);
}
public function edit_keuangan($id, $data) {
    $this->db->where('id_keuangan', $id);
    return $this->db->update('tb_keuangan', $data);
}

// --- FUNGSI HALAMAN CATATAN BELANJA (BARANG DIBELI) ---
public function get_pengeluaran() {
    $this->db->order_by('tanggal', 'DESC');
    return $this->db->get('tb_pengeluaran')->result_array();
}
public function simpan_pengeluaran($data) {
    return $this->db->insert('tb_pengeluaran', $data);
}
public function hapus_pengeluaran($id) {
    return $this->db->delete('tb_pengeluaran', ['id_pengeluaran' => $id]);
}
public function edit_pengeluaran($id, $data) {
    $this->db->where('id_pengeluaran', $id);
    return $this->db->update('tb_pengeluaran', $data);
}

// --- FUNGSI TARIK DATA OTOMATIS ---
public function get_total_pengeluaran_bulan($bulan) {
    // $bulan formatnya "YYYY-MM" (Contoh: 2026-04)
    $this->db->select_sum('harga');
    $this->db->like('tanggal', $bulan, 'after');
    $hasil = $this->db->get('tb_pengeluaran')->row_array();
    return $hasil['harga'] ? $hasil['harga'] : 0;
}

public function get_total_pendapatan_bulan($bulan) {
    // Karena ID transaksi Anda formatnya INV-YYYYMMDD-HHmmss
    $bulan_format = str_replace('-', '', $bulan); // Ubah 2026-04 jadi 202604
    
    $this->db->select_sum('total_bayar');
    $this->db->like('id_transaksi', 'INV-' . $bulan_format, 'after');
    // Hanya hitung yang sudah dibayar (abaikan yang menunggu pembayaran)
    $this->db->where('status_pesanan !=', 'Menunggu Pembayaran'); 
    $hasil = $this->db->get('tb_transaksi')->row_array();
    return $hasil['total_bayar'] ? $hasil['total_bayar'] : 0;
}
}