<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container text-center">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
            <div class="card-body p-5">
                <h1 class="text-success mb-3" style="font-size: 4rem;">✅</h1>
                <h3 class="fw-bold mb-3">Pesanan Berhasil Dibuat!</h3>
                <p class="text-muted">Terima kasih telah memesan di Jejak Rasa Kopi. Admin kami akan segera menyiapkan pesanan Anda.</p>
                
                <div class="bg-light p-3 rounded mb-4 border">
                    <span class="d-block text-muted small">Nomor Invoice:</span>
                    <span class="fs-4 fw-bold text-dark"><?= $id_transaksi; ?></span>
                </div>

                <a href="<?= site_url('Home'); ?>" class="btn btn-primary w-100">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>

</body>
</html>