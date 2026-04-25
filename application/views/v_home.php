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
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--espresso); 
            padding-top: 120px; /* Jarak ekstra agar judul tidak menabrak ombak atas */
            padding-bottom: 70px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- OMBAK KOPI (OCEAN COFFEE WAVES) --- */
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

        /* Gelombang Atas (Diturunkan 65px agar berada tepat di bawah navbar) */
        .ombak-atas-1 { 
            top: 65px; height: 50px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,50 Q750,100 500,50 T0,50 Z' fill='%23C08261' opacity='0.7'/%3E%3C/svg%3E"); 
            animation: waveRoll 12s linear infinite; 
        }
        .ombak-atas-2 { 
            top: 65px; height: 40px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,40 Q750,80 500,40 T0,40 Z' fill='%235d4037' opacity='0.85'/%3E%3C/svg%3E"); 
            animation: waveRoll 8s linear infinite reverse; 
        }
        .ombak-atas-3 { 
            top: 65px; height: 30px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,0 L1000,0 L1000,30 Q750,60 500,30 T0,30 Z' fill='%232C1810'/%3E%3C/svg%3E"); 
            animation: waveRoll 10s linear infinite; 
        }

        /* Gelombang Bawah */
        .ombak-bawah-1 { 
            bottom: 0; height: 60px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,50 Q750,0 500,50 T0,50 Z' fill='%23C08261' opacity='0.7'/%3E%3C/svg%3E"); 
            animation: waveRoll 10s linear infinite; 
        }
        .ombak-bawah-2 { 
            bottom: 0; height: 50px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,60 Q750,10 500,60 T0,60 Z' fill='%235d4037' opacity='0.85'/%3E%3C/svg%3E"); 
            animation: waveRoll 7s linear infinite reverse; 
        }
        .ombak-bawah-3 { 
            bottom: 0; height: 40px; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100' preserveAspectRatio='none'%3E%3Cpath d='M0,100 L1000,100 L1000,70 Q750,30 500,70 T0,70 Z' fill='%232C1810'/%3E%3C/svg%3E"); 
            animation: waveRoll 11s linear infinite; 
        }

        @keyframes waveRoll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50vw); }
        }

        /* --- NAVBAR --- */
        .navbar-coffee { 
            background: rgba(44, 24, 16, 0.9) !important; 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(192, 130, 97, 0.2);
            height: 65px; /* Mengunci tinggi navbar agar presisi dengan ombak */
        }

        /* --- TITLES --- */
        .section-title { 
            font-family: 'Playfair Display', serif;
            font-weight: 700; 
            color: var(--espresso); 
            position: relative; 
            display: inline-block; 
            margin-bottom: 40px;
            font-size: 2.5rem;
        }
        .section-title::after { 
            content: ''; 
            position: absolute; 
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px; 
            width: 80px; 
            height: 4px; 
            background-color: var(--caramel); 
            border-radius: 2px; 
        }

        /* --- KOPI CARDS (ELEGAN) --- */
        .card-coffee { 
            background-color: var(--white); 
            border: none; 
            border-radius: 20px; 
            overflow: hidden; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            height: 100%;
            box-shadow: 0 10px 20px rgba(44, 24, 16, 0.05);
        }
        .card-coffee:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 20px 40px rgba(44, 24, 16, 0.15); 
        }
        
        .img-wrapper { 
            overflow: hidden; 
            position: relative;
            background-color: var(--espresso);
        }
        .card-coffee img { 
            height: 250px; 
            object-fit: cover; 
            width: 100%;
            transition: transform 0.6s ease; 
            opacity: 0.9;
        }
        .card-coffee:hover img { transform: scale(1.1); opacity: 1; }

        /* Badge Stok Habis */
        .badge-habis { 
            background: var(--espresso); 
            color: var(--white);
            position: absolute; 
            top: 15px; 
            right: 15px; 
            font-weight: 600; 
            padding: 5px 15px; 
            border-radius: 50px; 
            z-index: 2;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        /* Info & Price */
        .price-tag { color: var(--caramel); font-weight: 700; font-size: 1.25rem; }
        
        .btn-add-cart { 
            background-color: var(--espresso); 
            color: var(--white); 
            border-radius: 12px; 
            font-weight: 600; 
            border: none; 
            transition: 0.3s; 
            padding: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }
        .btn-add-cart:hover { 
            background-color: var(--caramel); 
            color: var(--white); 
            box-shadow: 0 5px 15px rgba(192, 130, 97, 0.3);
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

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-2">
                <?php if($this->session->userdata('id_user')): ?>
                    <span class="text-white opacity-75 small d-none d-md-inline me-2">Halo, <?= $this->session->userdata('nama'); ?></span>
                    <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm">Riwayat</a>
                    <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold shadow-sm">🛒 (<?= $total_keranjang; ?>)</a>
                    <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm">Keluar</a>
                <?php else: ?>
                    <a href="<?= site_url('Auth'); ?>" class="btn btn-primary btn-sm fw-bold shadow-sm">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        
        <div class="mt-4 mb-5" style="position: relative; z-index: 10;">
            <h1 class="section-title">Eksplorasi Rasa</h1>
            <p class="text-muted mx-auto" style="max-width: 600px;">Pilih racikan kopi terbaik kami yang diproses dengan dedikasi untuk menemani setiap cerita Anda hari ini.</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5" style="position: relative; z-index: 10;">
            <?php foreach($produk as $item): ?>
            <div class="col">
                <div class="card card-coffee shadow-sm">
                    
                    <?php if($item['stok'] <= 0): ?>
                        <span class="badge badge-habis shadow-sm">Sold Out</span>
                    <?php endif; ?>

                    <div class="img-wrapper">
                        <img src="<?= base_url('assets/uploads/'.$item['gambar']); ?>" alt="<?= $item['nama_produk']; ?>" class="card-img-top">
                    </div>
                    
                    <div class="card-body d-flex flex-column p-4 text-start">
                        <h5 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif;"><?= $item['nama_produk']; ?></h5>
                        <p class="text-muted small mb-3">Tersedia: <?= $item['stok']; ?> cup</p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="price-tag">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></span>
                        </div>

                        <div class="mt-3">
                            <?php if($item['stok'] > 0): ?>
                                <a href="<?= site_url('Home/tambah_keranjang/'.$item['id_produk']); ?>" class="btn btn-add-cart w-100">
                                    + Keranjang
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100 fw-bold" disabled style="border-radius: 12px; padding: 12px;">Stok Habis</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <footer class="text-center py-5 text-muted small" style="position: relative; z-index: 10;">
        <p>&copy; <?= date('Y'); ?> Jejak Rasa Kopi. Dirancang dengan penuh dedikasi oleh Iqbal.</p>
    </footer>

</body>
</html>