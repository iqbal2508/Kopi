<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; padding-top: 80px;}
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; border-bottom: 1px solid #4A2C2A;}
        
        .kupon-card {
            background: linear-gradient(135deg, #4A2C2A, #33211D);
            border-radius: 20px; padding: 40px; border: 2px dashed #C08261;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4); max-width: 650px; margin: 0 auto;
        }

        .kupon-circle {
            width: 90px; height: 90px; border-radius: 50%;
            background-color: #1e1311; border: 3px solid #6F4E37;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; transition: 0.3s;
        }

        .kupon-active { background-color: #C08261; border-color: #F8F5F2; box-shadow: 0 0 20px rgba(192, 130, 97, 0.5); }
        .kupon-empty { opacity: 0.2; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa</a>
            <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm">Belanja Sekarang</a>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <?= $this->session->flashdata('pesan'); ?>

        <?php if($user['is_kupon_klaim'] == 1): ?>
            <div class="kupon-card text-center py-5">
                <h1 class="display-1 mb-3">🏆</h1>
                <h3 class="fw-bold text-warning">Promo Sudah Digunakan!</h3>
                <p class="text-light opacity-75 mt-3">Kamu sudah menyelesaikan misi "Kumpulkan 5 Kupon" dan mendapatkan hadiahnya. Promo ini hanya berlaku 1x untuk setiap akun.</p>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-warning fw-bold mt-4 px-4 py-2">Lihat Promo Lainnya</a>
            </div>

        <?php else: ?>
            <h2 class="fw-bold mb-2" style="color: #C08261;">🎟️ Kumpulkan Kupon</h2>
            <p class="text-light opacity-75 mb-5">Setiap pesanan Selesai = 1 Kupon. Kumpulkan 5 kupon untuk mendapatkan <strong>1 Kopi Gratis (Varian Apa Saja)</strong>. Berlaku khusus untuk pelanggan baru!</p>

            <div class="kupon-card">
                <div class="d-flex justify-content-center flex-wrap gap-4 mb-4">
                    <?php 
                        $kupon = $user['stempel_kopi'];
                        for($i = 1; $i <= 5; $i++): 
                    ?>
                        <div class="kupon-circle <?= ($i <= $kupon) ? 'kupon-active' : 'kupon-empty'; ?>">
                            <?= ($i <= $kupon) ? '☕' : ''; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <h5 class="fw-bold text-warning mb-4">Kupon Terkumpul: <?= $kupon; ?> / 5</h5>

                <?php if($kupon >= 5): ?>
                    <a href="<?= site_url('Home/klaim_kupon'); ?>" class="btn btn-success fw-bold py-3 px-5 w-100 fs-5 shadow" onclick="return confirm('Klaim Kopi Gratis sekarang? Promo ini hanya bisa digunakan 1x.')">🎁 Klaim 1 Kopi Gratis Sekarang!</a>
                <?php else: ?>
                    <div class="alert text-white opacity-75 mb-0" style="background-color: #1e1311;">
                        Lakukan <strong><?= 5 - $kupon; ?> transaksi lagi</strong> untuk membuka hadiah ini!
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>