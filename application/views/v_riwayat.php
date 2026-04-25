<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --espresso: #2C1810;
            --mocha: #5d4037;
            --caramel: #C08261;
            --cream: #F8F5F2;
            --white: #ffffff;
            --success-green: #3b593f; /* Hijau gelap elegan */
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--espresso); 
            padding-top: 120px; 
            padding-bottom: 70px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- OMBAK KOPI (Sama dengan halaman Menu) --- */
        .ombak-kopi-container {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
            border-left: 6px solid var(--espresso);
            border-right: 6px solid var(--espresso);
        }

        .ombak {
            position: absolute;
            left: 0;
            width: 200vw; 
            background-repeat: repeat-x;
            background-size: 50vw 100%;
        }

        /* Gelombang Atas */
        .ombak-atas-1 { top: 65px; height: 50px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,50 Q750,100 500,50 T0,50 Z' fill='%23C08261' opacity='0.7'/%3E%3C/svg%3E"); animation: waveRoll 12s linear infinite; }
        .ombak-atas-2 { top: 65px; height: 40px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,40 Q750,80 500,40 T0,40 Z' fill='%235d4037' opacity='0.85'/%3E%3C/svg%3E"); animation: waveRoll 8s linear infinite reverse; }
        .ombak-atas-3 { top: 65px; height: 30px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,30 Q750,60 500,30 T0,30 Z' fill='%232C1810'/%3E%3C/svg%3E"); animation: waveRoll 10s linear infinite; }

        /* Gelombang Bawah */
        .ombak-bawah-1 { bottom: 0; height: 60px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,50 Q750,0 500,50 T0,50 Z' fill='%23C08261' opacity='0.7'/%3E%3C/svg%3E"); animation: waveRoll 10s linear infinite; }
        .ombak-bawah-2 { bottom: 0; height: 50px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,60 Q750,10 500,60 T0,60 Z' fill='%235d4037' opacity='0.85'/%3E%3C/svg%3E"); animation: waveRoll 7s linear infinite reverse; }
        .ombak-bawah-3 { bottom: 0; height: 40px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,70 Q750,30 500,70 T0,70 Z' fill='%232C1810'/%3E%3C/svg%3E"); animation: waveRoll 11s linear infinite; }

        @keyframes waveRoll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50vw); }
        }

        /* --- NAVBAR --- */
        .navbar-coffee { 
            background: rgba(44, 24, 16, 0.9) !important; 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(192, 130, 97, 0.2);
            height: 65px;
        }

        /* --- TITLES --- */
        .section-title { 
            font-family: 'Playfair Display', serif;
            font-weight: 700; 
            color: var(--espresso); 
            position: relative; 
            display: inline-block; 
            margin-bottom: 40px;
            font-size: 2.2rem;
        }
        .section-title::after { 
            content: ''; 
            position: absolute; 
            left: 0;
            bottom: -10px; 
            width: 60px; 
            height: 4px; 
            background-color: var(--caramel); 
            border-radius: 2px; 
        }

        /* --- KARTU RIWAYAT (ELEGAN) --- */
        .card-history { 
            background-color: var(--white); 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 20px rgba(44, 24, 16, 0.05);
            transition: all 0.3s ease; 
        }
        .card-history:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 15px 30px rgba(44, 24, 16, 0.1); 
        }

        .card-header-custom {
            background-color: transparent;
            border-bottom: 1px dashed rgba(44, 24, 16, 0.15);
            padding: 20px;
        }

        .invoice-text {
            color: var(--espresso);
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .total-price {
            color: var(--caramel);
            font-size: 1.3rem;
        }

        /* --- BUTTONS --- */
        .btn-kopi-primary {
            background-color: var(--espresso);
            color: var(--white);
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }
        .btn-kopi-primary:hover {
            background-color: var(--caramel);
            color: var(--white);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 15px;
            color: var(--caramel);
        }

    </style>
</head>
<body>

    <div class="ombak-kopi-container">
        <div class="ombak ombak-atas-1"></div>
        <div class="ombak ombak-atas-2"></div>
        <div class="ombak ombak-atas-3"></div>
        
        <div class="ombak ombak-bawah-1"></div>
        <div class="ombak ombak-bawah-2"></div>
        <div class="ombak ombak-bawah-3"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top shadow-sm">
        <div class="container px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-2 text-white">
                <span class="small opacity-75 d-none d-md-inline me-2">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm">Katalog</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold shadow-sm" style="background-color: var(--caramel); border: none; color: white;">🛒 (<?= $total_keranjang; ?>)</a>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm" style="background-color: #8c2b2b; border: none;">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5" style="position: relative; z-index: 10; max-width: 900px;">
        
        <div class="mb-5 text-center text-md-start">
            <h2 class="section-title">Riwayat Perjalanan Rasa</h2>
            <p class="text-muted">Jejak pesanan kopi Anda yang pernah kami racik dengan sepenuh hati.</p>
        </div>

        <?php if(empty($riwayat)): ?>
            <div class="card card-history text-center py-5 shadow-sm">
                <div class="card-body">
                    <div class="empty-state-icon">☕</div>
                    <h4 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Belum Ada Cerita</h4>
                    <p class="text-muted mb-4">Sepertinya Anda belum pernah memesan kopi. Yuk, mulai hari ini dengan secangkir kopi terbaik dari kami.</p>
                    <a href="<?= site_url('Home/menu'); ?>" class="btn btn-kopi-primary px-4 py-2">Eksplorasi Menu</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach($riwayat as $r): ?>
                <div class="col-md-6">
                    <div class="card card-history h-100">
                        <div class="card-header-custom d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.8rem;">Tanggal Pesanan</small>
                                <span class="fw-semibold" style="font-size: 0.9rem;"><?= date('d M Y • H:i', strtotime($r['tgl_transaksi'])); ?></span>
                            </div>
                            
                            <?php 
                                // Kustomisasi Warna Badge Status Tema Kopi
                                $bg_status = 'background-color: var(--caramel); color: white;';
                                $icon = '⏳';
                                if($r['status_pesanan'] == 'Diproses') { 
                                    $bg_status = 'background-color: var(--mocha); color: white;'; 
                                    $icon = '👨‍🍳'; 
                                }
                                if($r['status_pesanan'] == 'Selesai') { 
                                    $bg_status = 'background-color: var(--success-green); color: white;'; 
                                    $icon = '✅'; 
                                }
                            ?>
                            <span class="badge rounded-pill shadow-sm px-3 py-2" style="<?= $bg_status ?> font-weight: 500; font-size: 0.8rem;">
                                <?= $icon; ?> <?= $r['status_pesanan']; ?>
                            </span>
                        </div>
                        
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between mb-2 align-items-center">
                                <span class="text-muted small">No. Invoice</span>
                                <span class="fw-bold invoice-text">#<?= $r['id_transaksi']; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Tipe Pesanan</span>
                                <span class="fw-medium text-dark small"><?= $r['tipe_pesanan']; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Pembayaran</span>
                                <span class="fw-medium text-dark small"><?= $r['metode_pembayaran']; ?></span>
                            </div>
                            
                            <hr style="border-color: rgba(44, 24, 16, 0.1);">
                            
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="text-muted fw-medium">Total Belanja</span>
                                <h5 class="fw-bold mb-0 total-price">Rp <?= number_format($r['total_bayar'], 0, ',', '.'); ?></h5>
                            </div>
                        </div>
                        
                        <?php if($r['status_pesanan'] == 'Menunggu Pembayaran'): ?>
                        <div class="card-footer bg-light border-0 text-center py-3 rounded-bottom-4" style="background-color: rgba(192, 130, 97, 0.05) !important;">
                            <small class="text-muted fst-italic">Silakan lakukan pembayaran di kasir dengan menyebutkan <strong style="color: var(--caramel);">Nomor Invoice</strong> Anda.</small>
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