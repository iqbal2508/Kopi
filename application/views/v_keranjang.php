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
            --danger-red: #8c2b2b;
            --success-green: #3b593f;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--espresso); 
            padding-top: 120px; 
            padding-bottom: 70px;
            min-height: 100vh;
        }

        /* --- NAVBAR --- */
        .navbar-coffee { 
            background: rgba(44, 24, 16, 0.95) !important; 
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
            margin-bottom: 10px;
            font-size: 2.2rem;
        }
        .section-title::after { 
            content: ''; 
            position: absolute; 
            left: 0;
            bottom: -5px; 
            width: 60px; 
            height: 4px; 
            background-color: var(--caramel); 
            border-radius: 2px; 
        }

        /* --- KARTU ELEGAN --- */
        .card-custom { 
            background-color: var(--white); 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(44, 24, 16, 0.05);
            padding: 10px;
        }

        /* --- TABEL ELEGAN --- */
        .table-coffee { margin-bottom: 0; }
        .table-coffee thead th {
            background-color: transparent;
            color: var(--espresso);
            border-bottom: 2px solid var(--caramel);
            font-weight: 600;
            padding-bottom: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table-coffee tbody td {
            vertical-align: middle;
            border-bottom: 1px dashed rgba(44, 24, 16, 0.1);
            padding: 20px 10px;
            color: var(--mocha);
        }
        .table-coffee tbody tr:last-child td { border-bottom: none; }
        
        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--espresso);
            font-weight: 700;
        }

        .total-price {
            color: var(--caramel);
            font-size: 1.5rem;
            font-family: 'Playfair Display', serif;
        }

        /* --- BUTTONS --- */
        .btn-kopi-primary {
            background-color: var(--success-green);
            color: var(--white);
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }
        .btn-kopi-primary:hover {
            background-color: #2c422f;
            color: var(--white);
            box-shadow: 0 5px 15px rgba(59, 89, 63, 0.3);
        }

        .btn-kopi-outline {
            background-color: transparent;
            color: var(--espresso);
            border: 1px solid var(--espresso);
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-kopi-outline:hover {
            background-color: var(--espresso);
            color: var(--white);
        }

        .btn-hapus {
            background-color: rgba(140, 43, 43, 0.1);
            color: var(--danger-red);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 6px 15px;
            transition: 0.3s;
            font-size: 0.85rem;
        }
        .btn-hapus:hover {
            background-color: var(--danger-red);
            color: white;
        }

        .empty-icon { font-size: 4rem; color: var(--caramel); margin-bottom: 15px; }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top shadow-sm">
        <div class="container px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-2 text-white">
                <span class="small opacity-75 d-none d-md-inline me-2">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm">Katalog</a>
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm">Riwayat</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold shadow-sm" style="background-color: var(--caramel); border: none; color: white;">🛒 (<?= $total_keranjang; ?>)</a>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm" style="background-color: var(--danger-red); border: none;">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 1000px;">
        
        <div class="mb-4 text-center text-md-start">
            <h2 class="section-title">Keranjang Belanja</h2>
            <p class="text-muted mt-2">Periksa kembali racikan pilihan Anda sebelum melanjutkan pembayaran.</p>
        </div>

        <div class="card card-custom">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-coffee align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Qty</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_belanja = 0;
                            if(empty($isi_keranjang)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-icon">🛒</div>
                                        <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--espresso);">Keranjang Masih Kosong</h5>
                                        <p class="text-muted mb-4">Anda belum menambahkan kopi ke dalam keranjang.</p>
                                        <a href="<?= site_url('Home/menu'); ?>" class="btn btn-kopi-outline">Ayo Pesan Kopi!</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($isi_keranjang as $item): 
                                    $subtotal = $item['harga'] * $item['qty'];
                                    $total_belanja += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <span class="product-name"><?= $item['nama_produk']; ?></span>
                                    </td>
                                    <td class="fw-medium">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center fw-bold text-dark fs-5"><?= $item['qty']; ?></td>
                                    <td class="fw-bold" style="color: var(--caramel);">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('Home/hapus_keranjang/'.$item['id_keranjang']); ?>" 
                                           class="btn btn-hapus" 
                                           onclick="return confirm('Hapus menu ini dari keranjang?')">
                                           Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(!empty($isi_keranjang)): ?>
                <div class="mt-4 pt-4 border-top" style="border-color: rgba(44, 24, 16, 0.1) !important;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <span class="text-muted fw-medium mb-2 mb-md-0">Total Pembayaran:</span>
                        <span class="fw-bold total-price">Rp <?= number_format($total_belanja, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mt-5 gap-3">
                    <a href="<?= site_url('Home/menu'); ?>" class="btn btn-kopi-outline w-100 w-md-auto text-center">Kembali Belanja</a>
                    <a href="<?= site_url('Home/checkout'); ?>" class="btn btn-kopi-primary w-100 w-md-auto text-center px-5">Lanjut Pembayaran (Checkout) &rarr;</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>