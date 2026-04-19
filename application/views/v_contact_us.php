<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; }
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .contact-section { padding-top: 120px; padding-bottom: 80px; }
        .card-coffee { background-color: #4A2C2A; color: #F8F5F2; border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .form-control { background-color: rgba(255,255,255,0.05); border: 1px solid #6F4E37; color: white; border-radius: 8px; padding: 12px; }
        .form-control:focus { background-color: rgba(255,255,255,0.1); border-color: #C08261; color: white; box-shadow: 0 0 0 0.25rem rgba(192, 130, 97, 0.25); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white opacity-75 small">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm fw-bold">Katalog</a>
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm">Riwayat</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold">🛒 Keranjang (<?= $total_keranjang; ?>)</a>
            </div>
        </div>
    </nav>

    <div class="container contact-section">
        <div class="row">
            
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h2 class="fw-bold mb-3" style="color: #EAE0D5;">Hubungi Kami</h2>
                <p class="text-muted mb-5">Kami sangat senang mendengar dari Anda! Apakah Anda memiliki pertanyaan tentang kopi kami, ingin memberikan saran, atau sekadar menyapa, silakan hubungi kami melalui formulir di samping atau informasi di bawah ini.</p>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span style="font-size: 1.5rem;">📍</span>
                    <div>
                        <p class="fw-bold mb-0">Alamat</p>
                        <p class="text-muted small mb-0">Jl. Jejak Rasa No. 123, Kota Kopi, Indonesia</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span style="font-size: 1.5rem;">📞</span>
                    <div>
                        <p class="fw-bold mb-0">Telepon</p>
                        <p class="text-muted small mb-0">+62 123 4567 890</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span style="font-size: 1.5rem;">✉️</span>
                    <div>
                        <p class="fw-bold mb-0">Email</p>
                        <p class="text-muted small mb-0">hello@jejakrasa.com</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="card card-coffee p-4 p-md-5">
                    <h4 class="fw-bold mb-4" style="color: #EAE0D5;">Kirim Pesan</h4>
                    <form>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan email Anda">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small text-muted">Pesan Anda</label>
                            <textarea class="form-control" rows="5" placeholder="Tuliskan pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-light fw-bold w-100 py-3" style="border-radius: 8px;">Kirim Pesan Sekarang</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>