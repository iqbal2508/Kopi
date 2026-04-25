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
                        
                        <div class="d-flex justify-content-between text-success mb-2" id="barisDiskon" style="display: none !important;">
                            <span id="labelDiskon">🎁 Promo Dipakai</span>
                            <strong id="teksDiskon">- Rp 0</strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold" style="color: #4A2C2A;">Total Pembayaran</span>
                            <h3 class="fw-bold mb-0" style="color: #D25345;" id="teksTotal">Rp <?= number_format($total_belanja, 0, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-coffee p-4">
                    <h4 class="fw-bold mb-4" style="color: #4A2C2A;">Selesaikan Pesanan</h4>
                    <form action="<?= site_url('Home/proses_pesanan'); ?>" method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-warning" style="color: #C08261 !important;">🏷️ Pilih Promo Anda</label>
                            <select class="form-select border-warning" id="pilihVoucher" name="id_voucher" style="background-color: #fffaf0;">
                                <option value="0">--- Lanjut Tanpa Promo ---</option>

                                <?php if(!empty($user['hadiah_game']) && $user['hadiah_game'] != 'Zonk!'): ?>
                                    <option value="game_<?= $user['hadiah_game'] ?>">🎡 Game: <?= $user['hadiah_game'] ?></option>
                                <?php endif; ?>

                                <?php if($user['login_streak'] >= 1): ?>
                                    <option value="5">📅 Absen: Diskon 5%</option>
                                <?php endif; ?>
                                <?php if($user['login_streak'] >= 4): ?>
                                    <option value="10">📅 Absen: Diskon 10%</option>
                                <?php endif; ?>
                                <?php if($user['login_streak'] >= 7): ?>
                                    <option value="free">📅 Absen: 1 Kopi Gratis</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div id="wadahKopiGratis" class="mb-4 p-3 rounded d-none" style="background-color: #e8f5e9; border: 1px solid #81c784;">
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
            let prov = document.getElementById('provinsi').value;
            let kota = document.getElementById('kota').value;
            let tipePesanan = document.querySelector('select[name="tipe_pesanan"]').value;
            let metodePembayaran = document.querySelector('select[name="metode_pembayaran"]').value;
            let totalBelanja = <?= isset($total_belanja) ? $total_belanja : 0; ?>; 
            
            let kotaBodetabek = ['Bogor', 'Depok', 'Tangerang', 'Tangerang Selatan', 'Bekasi'];

            if (tipePesanan === 'Di Antar' && metodePembayaran === 'Bayar di Tempat') {
                e.preventDefault(); 
                alert('Maaf, pesanan yang di antar menggunakan ojek/kurir wajib dibayar di awal (QRIS/Transfer). Bayar di tempat hanya berlaku jika Anda datang ke rumah.');
                return; 
            }

            if (prov !== 'DKI Jakarta') {
                if (kotaBodetabek.includes(kota)) {
                    if (totalBelanja < 30000) {
                        e.preventDefault();
                        alert('Minimal pesanan untuk area luar Jakarta (Bodetabek) adalah Rp 30.000!');
                    }
                } else {
                    e.preventDefault();
                    alert('Maaf, alamat Anda di luar jangkauan pengiriman kami.');
                }
            }
        });
    </script>

    <script>
        const pilihVoucher = document.getElementById('pilihVoucher');
        const wadahKopiGratis = document.getElementById('wadahKopiGratis');
        const kopiGratisSelect = document.getElementById('kopiGratisSelect');
        const barisDiskon = document.getElementById('barisDiskon');
        const labelDiskon = document.getElementById('labelDiskon');
        const teksDiskon = document.getElementById('teksDiskon');
        const teksTotal = document.getElementById('teksTotal');
        
        let totalAwal = <?= isset($total_belanja) ? $total_belanja : 0; ?>;

        function hitungDiskonVoucher() {
            let tipe = pilihVoucher.value;
            let diskon = 0;
            let namaPromo = "";

            // Sembunyikan pilihan kopi gratis by default
            wadahKopiGratis.classList.add('d-none');

            if(tipe === "5") {
                diskon = totalAwal * 0.05;
                namaPromo = "Diskon 5% (Absen)";
            } else if(tipe === "10") {
                diskon = totalAwal * 0.10;
                namaPromo = "Diskon 10% (Absen)";
            } else if(tipe === "game_Diskon 10%") {
                diskon = totalAwal * 0.10;
                namaPromo = "Diskon 10% (Game)";
            } else if(tipe === "game_Diskon 20%") {
                diskon = totalAwal * 0.20;
                namaPromo = "Diskon 20% (Game)";
            } else if(tipe === "game_Voucher 10rb") {
                diskon = 10000;
                namaPromo = "Potongan 10Rb (Game)";
            } else if(tipe === "free" || tipe === "game_Kopi Gratis") {
                // Munculkan kembali wadah pilihan kopi jika jenis vouchernya "Gratis"
                wadahKopiGratis.classList.remove('d-none');
                namaPromo = "1 Kopi Gratis";
                
                // Ambil harga dari kopi yang sedang dipilih di dropdown kedua
                if(kopiGratisSelect && kopiGratisSelect.options.length > 0) {
                    diskon = parseInt(kopiGratisSelect.options[kopiGratisSelect.selectedIndex].getAttribute('data-harga'));
                }
            }

            // Cegah agar diskon tidak membuat harga minus
            if(diskon > totalAwal) diskon = totalAwal;
            
            let totalAkhir = totalAwal - diskon;

            // Update UI Interface
            if(diskon > 0) {
                barisDiskon.style.setProperty('display', 'flex', 'important');
                labelDiskon.innerText = "🎁 " + namaPromo;
                teksDiskon.innerText = "- Rp " + diskon.toLocaleString('id-ID');
            } else {
                barisDiskon.style.setProperty('display', 'none', 'important');
            }

            teksTotal.innerText = "Rp " + totalAkhir.toLocaleString('id-ID');
        }

        // Jalankan fungsi ketika opsi voucher diganti
        pilihVoucher.addEventListener('change', hitungDiskonVoucher);
        
        // Jalankan fungsi ketika kopi gratis yang dipilih diganti (agar harga potongan update)
        if(kopiGratisSelect) {
            kopiGratisSelect.addEventListener('change', hitungDiskonVoucher);
        }

        // Panggil 1 kali saat pertama kali load, agar total pembayaran muncul.
        hitungDiskonVoucher();
    </script>

</body>
</html>