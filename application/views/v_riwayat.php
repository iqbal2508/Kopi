<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; }
        .navbar-coffee { background-color: #4A2C2A !important; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa Kopi</a>
            <div class="d-flex align-items-center gap-3 text-white">
                <span class="small opacity-75">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm fw-bold">📄 Riwayat Pesanan</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold">🛒 Keranjang (<?= $total_keranjang; ?>)</a>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h4 class="fw-bold mb-4" style="color: #4A2C2A;">📄 Riwayat Pesanan Saya</h4>

        <?php if(empty($riwayat)): ?>
            <div class="alert alert-light border text-center py-5 shadow-sm rounded-4">
                <h1 class="display-4 text-muted mb-3">🛍️</h1>
                <h5 class="text-muted">Kamu belum pernah memesan kopi.</h5>
                <a href="<?= site_url('Home'); ?>" class="btn btn-primary mt-2">Mulai Pesan Sekarang</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($riwayat as $r): ?>
                <div class="col-md-6 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                            <div>
                                <small class="text-muted d-block">Tanggal Pesanan</small>
                                <span class="fw-bold"><?= date('d F Y, H:i', strtotime($r['tgl_transaksi'])); ?></span>
                            </div>
                            
                            <?php 
                                $bg_status = 'bg-warning text-dark';
                                $icon = '⏳';
                                if($r['status_pesanan'] == 'Diproses') { $bg_status = 'bg-info text-dark'; $icon = '👨‍🍳'; }
                                if($r['status_pesanan'] == 'Selesai') { $bg_status = 'bg-success'; $icon = '✅'; }
                            ?>
                            <span class="badge <?= $bg_status; ?> px-3 py-2" style="font-size: 0.85rem;">
                                <?= $icon; ?> <?= $r['status_pesanan']; ?>
                            </span>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">No. Invoice:</span>
                                <span class="fw-bold text-primary"><?= $r['id_transaksi']; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tipe Pesanan:</span>
                                <span><?= $r['tipe_pesanan']; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Metode Pembayaran:</span>
                                <span><?= $r['metode_pembayaran']; ?></span>
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-muted">Total Belanja:</span>
                                <h5 class="fw-bold mb-0 text-danger">Rp <?= number_format($r['total_bayar'], 0, ',', '.'); ?></h5>
                            </div>
                        </div>
                        
                        <?php if($r['status_pesanan'] == 'Menunggu Pembayaran'): ?>
                        <div class="card-footer bg-light border-top-0 text-center py-3">
                            <small class="text-muted">Silakan lakukan pembayaran di kasir dengan menyebutkan Nomor Invoice Anda.</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>