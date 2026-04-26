<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Palet Warna Tema Kopi */
        body {
            background-color: #fdfaf6; /* Krem sangat muda / Latte */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-coffee-dark {
            background-color: #3e2723 !important; /* Cokelat Espresso */
        }
        .text-coffee-dark {
            color: #3e2723 !important;
        }
        .text-coffee-accent {
            color: #b97a57 !important; /* Cokelat Karamel / Emas */
        }
        .border-coffee {
            border-color: #3e2723 !important;
        }
        
        /* Styling Tombol Khusus Kopi */
        .btn-coffee {
            background-color: #5d4037; /* Cokelat Mocha */
            color: #fff;
            border: none;
        }
        .btn-coffee:hover {
            background-color: #3e2723;
            color: #fff;
        }
        .btn-outline-coffee {
            color: #5d4037;
            border: 1px solid #5d4037;
            background-color: transparent;
        }
        .btn-outline-coffee:hover {
            background-color: #5d4037;
            color: #fff;
        }

        /* Styling Kartu Menu Elegan */
        .card-menu {
            border: 1px solid #eaddcf;
            background-color: #ffffff;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(62, 39, 35, 0.1) !important;
            border-color: #d4a373;
        }
        
        /* Styling Tabel Keranjang */
        .table-coffee-header {
            background-color: #f5e6d3 !important; /* Light Cream */
            color: #3e2723 !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-coffee-dark shadow mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-light" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
            <span class="text-white fs-5 fw-bold" style="letter-spacing: 1px;">☕ Layar Kasir (Point of Sales)</span>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row">
            
            <div class="col-md-8">
                <div class="row">
                    <?php foreach($produk as $p): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm card-menu">
                            <div class="card-body text-center d-flex flex-column">
                                <h6 class="card-title fw-bold text-coffee-dark mb-1"><?= $p['nama_produk']; ?></h6>
                                <p class="text-coffee-accent fw-bold mb-3 fs-5">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                                
                                <a href="<?= site_url('Admin/tambah_pos/'.$p['id_produk']); ?>" 
                                   class="btn btn-outline-coffee btn-sm mt-auto fw-semibold rounded-pill">Pilih Menu</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-coffee-dark text-white fw-bold py-3">
                        🛒 Pesanan Saat Ini
                    </div>
                    <div class="card-body p-0 bg-white">
                        <table class="table table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="table-coffee-header py-2 px-3">Menu</th>
                                    <th class="table-coffee-header py-2 text-center">Qty</th>
                                    <th class="table-coffee-header py-2 text-end px-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($this->cart->contents())): ?>
                                    <tr><td colspan="3" class="text-center py-5 text-muted fst-italic">Belum ada pesanan yang dipilih</td></tr>
                                <?php else: ?>
                                    <?php foreach($this->cart->contents() as $item): ?>
                                    <tr>
                                        <td class="px-3 py-2 text-coffee-dark fw-medium"><?= $item['name']; ?></td>
                                        <td class="text-center py-2 fw-bold text-secondary"><?= $item['qty']; ?></td>
                                        <td class="text-end px-3 py-2 text-coffee-dark">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer bg-white pt-4 pb-4 border-top">
                        <h4 class="d-flex justify-content-between text-coffee-dark fw-bold mb-4">
                            <span>TOTAL:</span>
                            <span class="text-coffee-accent fs-3">Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></span>
                        </h4>
                        
                        <form action="<?= site_url('Admin/proses_pos'); ?>" method="POST">
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">METODE PEMBAYARAN</label>
                                <select name="metode_pembayaran" class="form-select border-secondary shadow-sm" required>
                                    <option value="Tunai/Kasir">Uang Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Debit/Transfer">Debit/Transfer</option>
                                </select>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('Admin/reset_pos'); ?>" class="btn btn-outline-danger w-50 fw-bold rounded-pill">Batalkan</a>
                                <button type="submit" class="btn btn-coffee w-50 fw-bold rounded-pill shadow-sm" <?= empty($this->cart->contents()) ? 'disabled' : ''; ?>>Bayar & Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>