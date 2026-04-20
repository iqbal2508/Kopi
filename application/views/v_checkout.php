<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; padding-top: 80px; }
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; }
        .card-coffee { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa Kopi</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card card-coffee p-4">
                    <h4 class="fw-bold mb-4" style="color: #4A2C2A;">Rincian Pesanan</h4>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <?php foreach($isi_keranjang as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="my-0 fw-bold"><?= $item['nama_produk']; ?></h6>
                                <small class="text-muted"><?= $item['qty']; ?>x @ Rp <?= number_format($item['harga'], 0, ',', '.'); ?></small>
                            </div>
                            <span class="text-muted">Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.'); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="p-3 rounded" style="background-color: #FDFBF9; border: 1px dashed #C08261;">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal Belanja</span>
                            <strong>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></strong>
                        </div>
                        
                        <?php if($diskon > 0): ?>
                        <div class="d-flex justify-content-between text-success mb-2">
                            <span>🎁 Promo Dipakai (<?= $user['hadiah_game']; ?>)</span>
                            <strong id="teksDiskon">- Rp <?= number_format($diskon, 0, ',', '.'); ?></strong>
                        </div>
                        <?php endif; ?>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold" style="color: #4A2C2A;">Total Pembayaran</span>
                            <h3 class="fw-bold mb-0" style="color: #D25345;" id="teksTotal">Rp <?= number_format($total_akhir, 0, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-coffee p-4">
                    <h4 class="fw-bold mb-4" style="color: #4A2C2A;">Selesaikan Pesanan</h4>
                    <form action="<?= site_url('Home/proses_pesanan'); ?>" method="POST">
                        
                        <?php if($user['hadiah_game'] == 'Kopi Gratis'): ?>
                        <div class="mb-4 p-3 rounded" style="background-color: #e8f5e9; border: 1px solid #81c784;">
                            <label class="form-label fw-bold text-success">🎉 Pilih 1 Kopi yang Digratiskan</label>
                            <select name="id_produk_gratis" id="kopiGratisSelect" class="form-select border-success">
                                <?php foreach($isi_keranjang as $item): ?>
                                    <option value="<?= $item['id_produk']; ?>" data-harga="<?= $item['harga']; ?>">
                                        <?= $item['nama_produk']; ?> (Potongan Rp <?= number_format($item['harga'], 0, ',', '.'); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-success mt-1 d-block">*Diskon memotong harga 1 cup kopi pilihanmu.</small>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipe Pesanan</label>
                            <select name="tipe_pesanan" class="form-select" required>
                                <option value="Di Antar">Di Antar (Ojek / Kurir)</option>
                                <option value="Datang ke Rumah">Datang ke Rumah (Ambil Sendiri)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select" required>
                                <option value="QRIS">QRIS / E-Wallet</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="Bayar di Tempat">Bayar di Tempat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-select" required>
                                <option value="">-- Pilih Provinsi --</option>
                                <option value="DKI Jakarta">DKI Jakarta</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Banten">Banten</option>
                                <option value="Luar Jabodetabek">Lainnya (Luar Jabodetabek)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Kota / Kabupaten</label>
                            <select name="kota" id="kota" class="form-select" required>
                                <option value="">-- Pilih Kota --</option>
                                <optgroup label="DKI Jakarta">
                                    <option value="Jakarta Barat">Jakarta Barat</option>
                                    <option value="Jakarta Pusat">Jakarta Pusat</option>
                                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                                    <option value="Jakarta Timur">Jakarta Timur</option>
                                    <option value="Jakarta Utara">Jakarta Utara</option>
                                </optgroup>
                                <optgroup label="Bodetabek">
                                    <option value="Bogor">Bogor</option>
                                    <option value="Depok">Depok</option>
                                    <option value="Tangerang">Tangerang</option>
                                    <option value="Tangerang Selatan">Tangerang Selatan</option>
                                    <option value="Bekasi">Bekasi</option>
                                </optgroup>
                                <optgroup label="Lainnya">
                                    <option value="Luar Jangkauan">Luar Jangkauan</option>
                                </optgroup>
                            </select>
                        </div>

                        <button type="submit" class="btn w-100 fw-bold py-3 text-white" style="background-color: #6F4E37; border-radius: 10px;">
                            Pesan & Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
const formCheckout = document.querySelector('form'); 

formCheckout.addEventListener('submit', function(e) {
    // Ambil semua nilai input
    let prov = document.getElementById('provinsi').value;
    let kota = document.getElementById('kota').value;
    let tipePesanan = document.querySelector('select[name="tipe_pesanan"]').value;
    let metodePembayaran = document.querySelector('select[name="metode_pembayaran"]').value;
    let totalBelanja = <?= isset($total_belanja) ? $total_belanja : 0; ?>; 
    
    let kotaBodetabek = ['Bogor', 'Depok', 'Tangerang', 'Tangerang Selatan', 'Bekasi'];

    // MASALAH 1: Validasi Ojek/Kurir tidak boleh Bayar di Tempat
    if (tipePesanan === 'Di Antar' && metodePembayaran === 'Bayar di Tempat') {
        e.preventDefault(); // Batalkan kirim form
        alert('Maaf, pesanan yang di antar menggunakan ojek/kurir wajib dibayar di awal (QRIS/Transfer). Bayar di tempat hanya berlaku jika Anda datang ke rumah.');
        return; // Berhenti di sini
    }

    // Validasi Lokasi & Minimal Order (DKI Jakarta vs Bodetabek)
    if (prov !== 'DKI Jakarta') {
        if (kotaBodetabek.includes(kota)) {
            // Jika Bodetabek (Bogor, Bekasi, Tangerang, dll), minimal 30rb
            if (totalBelanja < 30000) {
                e.preventDefault();
                alert('Minimal pesanan untuk area luar Jakarta (Bodetabek) adalah Rp 30.000!');
            }
        } else {
            // Jika di luar Jabodetabek sama sekali
            e.preventDefault();
            alert('Maaf, alamat Anda di luar jangkauan pengiriman kami.');
        }
    }
});
</script>

    <script>
        const selectGratis = document.getElementById('kopiGratisSelect');
        const teksDiskon = document.getElementById('teksDiskon');
        const teksTotal = document.getElementById('teksTotal');
        const subtotal = <?= $total_belanja; ?>;

        if (selectGratis) {
            selectGratis.addEventListener('change', function() {
                // Ambil harga dari kopi yang dipilih
                const hargaDiskon = parseInt(this.options[this.selectedIndex].getAttribute('data-harga'));
                
                // Hitung total baru
                let totalAkhir = subtotal - hargaDiskon;
                if(totalAkhir < 0) totalAkhir = 0;

                // Update tampilan (Ubah format angka jadi Rupiah)
                teksDiskon.innerText = "- Rp " + hargaDiskon.toLocaleString('id-ID');
                teksTotal.innerText = "Rp " + totalAkhir.toLocaleString('id-ID');
            });
        }
    </script>

</body>
</html>