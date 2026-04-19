<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">💻 POS Kasir - Jejak Rasa</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>📄 Detail Invoice: <?= $transaksi['id_transaksi']; ?></h4>
            <a href="<?= site_url('Admin'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md-3"><strong>Waktu:</strong> <br><?= date('d M Y, H:i', strtotime($transaksi['tgl_transaksi'])); ?></div>
                    <div class="col-md-3"><strong>Tipe Pesanan:</strong> <br><?= $transaksi['tipe_pesanan']; ?></div>
                    <div class="col-md-3"><strong>Metode Bayar:</strong> <br><?= $transaksi['metode_pembayaran']; ?></div>
                    <div class="col-md-3"><strong>Status:</strong> <br><span class="badge bg-info text-dark"><?= $transaksi['status_pesanan']; ?></span></div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Menu Kopi</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $item): ?>
                        <tr>
                            <td><?= $item['nama_produk']; ?></td>
                            <td class="text-center">Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                            <td class="text-center fw-bold"><?= $item['qty']; ?></td>
                            <td class="text-end">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end fs-5">TOTAL KESELURUHAN:</th>
                            <th class="text-end text-danger fs-5">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="text-end">
            <button onclick="window.print()" class="btn btn-warning px-4">🖨️ Cetak Struk (Dapur)</button>
        </div>
    </div>

</body>
</html>