<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* TEMA GELAP PREMIUM KOPI */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #33211D; /* Espresso Dark */
            color: #F8F5F2; 
            padding-top: 90px; /* Jarak untuk fixed navbar */
            padding-bottom: 50px;
        }
        
        /* Navbar Senada dengan Landing Page */
        .navbar-coffee { 
            background-color: rgba(51, 33, 29, 0.95) !important; 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #4A2C2A;
        }

        /* Styling Judul Section */
        .section-title { 
            font-weight: 700; 
            color: #F8F5F2; 
            position: relative; 
            display: inline-block; 
            padding-bottom: 10px; 
            margin-bottom: 30px;
        }
        .section-title::after { 
            content: ''; 
            position: absolute; 
            left: 0; 
            bottom: 0; 
            width: 60px; 
            height: 4px; 
            background-color: #C08261; /* Caramel Accent */
            border-radius: 2px; 
        }

        /* Styling Promo Card */
        .promo-card { 
            background: linear-gradient(135deg, #6F4E37, #4A2C2A); 
            border-radius: 16px; 
            border: 1px solid #8e6345;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: 0.3s;
        }
        .promo-card:hover { transform: translateY(-5px); }

        /* Styling Katalog Card Kopi */
        .card-coffee { 
            background-color: #4A2C2A; 
            border: none; 
            border-radius: 16px; 
            overflow: hidden; 
            transition: all 0.4s ease; 
            height: 100%;
        }
        .card-coffee:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 15px 25px rgba(0,0,0,0.4); 
        }
        
        /* Animasi Gambar Zoom saat di-hover */
        .img-wrapper { overflow: hidden; }
        .card-coffee img { 
            height: 220px; 
            object-fit: cover; 
            width: 100%;
            transition: transform 0.6s ease; 
        }
        .card-coffee:hover img { transform: scale(1.08); }

        /* Teks & Tombol */
        .price-tag { color: #C08261; font-weight: 700; font-size: 1.2rem; }
        
        .btn-add-cart { 
            background-color: #C08261; 
            color: white; 
            border-radius: 8px; 
            font-weight: 600; 
            border: none; 
            transition: 0.3s; 
            padding: 10px;
        }
        .btn-add-cart:hover { 
            background-color: #A0694A; 
            color: white; 
            box-shadow: 0 4px 12px rgba(192, 130, 97, 0.4);
        }
        
        /* Badge Stok Habis */
        .badge-habis { background-color: #dc3545; position: absolute; top: 15px; right: 15px; font-weight: 600; padding: 8px 12px; border-radius: 8px; z-index: 2;}
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white opacity-75 small d-none d-md-inline">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm fw-bold">Katalog</a>
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm">Riwayat</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold shadow-sm">🛒 Keranjang (<?= $total_keranjang; ?>)</a>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <?php if(!empty($promo)): ?>
        <div class="mb-5 mt-3">
            <h3 class="section-title">🔥 Penawaran Spesial</h3>
            <div class="row">
                <?php foreach($promo as $p): ?>
                <div class="col-md-6 mb-3">
                    <div class="promo-card p-4 text-white">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="fw-bold text-warning mb-1"><?= $p['nama_promo']; ?></h4>
                                <p class="opacity-75 mb-0"><?= $p['keterangan']; ?></p>
                            </div>
                            <span class="badge bg-danger fs-5 rounded-pill px-3 shadow">Diskon <?= $p['diskon_persen']; ?>%</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="mb-4 d-flex justify-content-between align-items-end">
            <h3 class="section-title mb-0">📚 Eksplorasi Rasa</h3>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            <?php foreach($produk as $item): ?>
            <div class="col">
                <div class="card card-coffee shadow-sm">
                    
                    <?php if($item['stok'] <= 0): ?>
                        <span class="badge badge-habis shadow">Sold Out</span>
                    <?php endif; ?>

                    <div class="img-wrapper">
                        <img src="<?= base_url('assets/uploads/'.$item['gambar']); ?>" alt="<?= $item['nama_produk']; ?>" class="card-img-top">
                    </div>
                    
                    <div class="card-body d-flex flex-column p-4">
                        <p class="text-muted small mb-1">Stok: <?= $item['stok']; ?> cup</p>
                        <h5 class="card-title fw-bold text-white mb-1"><?= $item['nama_produk']; ?></h5>
                        
                        <p class="price-tag mb-4">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                        
                        <?php if($item['stok'] > 0): ?>
                            <a href="<?= site_url('Home/tambah_keranjang/'.$item['id_produk']); ?>" class="btn btn-add-cart w-100 mt-auto">
                                + Keranjang
                            </a>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100 mt-auto fw-bold" disabled>Stok Habis</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <footer class="text-center pb-4 text-muted small">
        <p>&copy; <?= date('Y'); ?> Jejak Rasa Kopi. Dirancang dengan penuh dedikasi oleh Iqbal.</p>
    </footer>

</body>
</html>