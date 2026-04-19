<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
            <span class="text-white fs-5 fw-bold">Layar Kasir (Point of Sales)</span>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row">
            
            <div class="col-md-8">
                <div class="row">
                    <?php foreach($produk as $p): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center d-flex flex-column">
                                <h6 class="card-title fw-bold mb-1"><?= $p['nama_produk']; ?></h6>
                                <p class="text-danger mb-3">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                                
                                <a href="<?= site_url('Admin/tambah_pos/'.$p['id_produk']); ?>" 
   class="btn btn-outline-primary btn-sm mt-auto">Pilih</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-primary">
                    <div class="card-header bg-primary text-white fw-bold">
                        🛒 Pesanan Saat Ini
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu</th>
                                    <th>Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($this->cart->contents())): ?>
                                    <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada menu yang dipilih</td></tr>
                                <?php else: ?>
                                    <?php foreach($this->cart->contents() as $item): ?>
                                    <tr>
                                        <td><?= $item['name']; ?></td>
                                        <td class="text-center fw-bold"><?= $item['qty']; ?></td>
                                        <td class="text-end">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer bg-white pt-3">
                        <h4 class="d-flex justify-content-between text-danger fw-bold">
                            <span>TOTAL:</span>
                            <span>Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></span>
                        </h4>
                        
                        <hr>
                        
                        <form action="<?= site_url('Admin/proses_pos'); ?>" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Metode Bayar:</label>
                                <select name="metode_pembayaran" class="form-select form-select-sm" required>
                                    <option value="Tunai/Kasir">Uang Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Debit/Transfer">Debit/Transfer</option>
                                </select>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('Admin/reset_pos'); ?>" class="btn btn-danger w-50">Batalkan</a>
                                <button type="submit" class="btn btn-success w-50" <?= empty($this->cart->contents()) ? 'disabled' : ''; ?>>Bayar & Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>