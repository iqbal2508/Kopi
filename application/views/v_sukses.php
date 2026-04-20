<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="card shadow-sm p-4 text-center mt-5">
    <h2 class="text-success fw-bold">🎉 Pesanan Berhasil!</h2>
    <p>Nomor Invoice Anda: <strong><?= $id_transaksi; ?></strong></p>
    
    <hr>
    
    <?php if($transaksi['metode_pembayaran'] == 'QRIS'): ?>
        <h4 class="fw-bold mb-3">Silakan Scan QRIS Berikut</h4>
        <p class="text-muted small">Total yang harus dibayar: Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></p>
        <img src="<?= base_url('assets/img/qris.png'); ?>" alt="QRIS Jejak Rasa" class="img-fluid border rounded" style="max-width: 250px;">
        <p class="mt-3 text-danger small">*Harap simpan bukti pembayaran Anda.</p>

    <?php elseif($transaksi['metode_pembayaran'] == 'Transfer Bank'): ?>
        <h4 class="fw-bold mb-3">Silakan Transfer ke Rekening Berikut</h4>
        <div class="alert alert-info d-inline-block text-start">
            <strong>Bank BCA</strong><br>
            No. Rekening: <span class="fs-5 fw-bold">1234 5678 910</span><br>
            Atas Nama: <strong>Iqbal</strong><br>
            Nominal: <strong>Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></strong>
        </div>
        <p class="mt-3 text-danger small">*Harap simpan bukti transfer Anda.</p>

    <?php elseif($transaksi['metode_pembayaran'] == 'Bayar di Tempat'): ?>
        <h4 class="fw-bold mb-3 text-warning">Pesanan Anda Segera Disiapkan!</h4>
        <p>Anda memilih untuk mengambil dan membayar di lokasi kami.</p>
        <div class="alert alert-warning d-inline-block text-start">
            <strong>Alamat Pengambilan:</strong><br>
            JL Thalib 3 Dalam<br>
            Jakarta Barat
        </div>
        <p class="mt-2 text-muted">Tunjukkan nomor invoice <b><?= $id_transaksi; ?></b> saat tiba di lokasi.</p>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-primary">Cek Riwayat Pesanan</a>
        <a href="<?= site_url('Home/menu'); ?>" class="btn btn-primary">Kembali ke Menu</a>
    </div>
</div>

</body>
</html>