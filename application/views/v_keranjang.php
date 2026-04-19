<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa Kopi</a>
            <div class="d-flex align-items-center gap-3 text-white">
                <span class="small opacity-75">Halo, <?= $this->session->userdata('nama'); ?></span>
                
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm fw-bold">📄 Riwayat</a>
                
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold">🛒 Keranjang (<?= $total_keranjang; ?>)</a>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h4 class="mb-4">🛒 Keranjang Belanja Anda</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_belanja = 0;
                        if(empty($isi_keranjang)): ?>
                            <tr><td colspan="5" class="text-center">Keranjang masih kosong. <a href="<?= site_url('Home'); ?>">Ayo pesan kopi!</a></td></tr>
                        <?php else: ?>
                            <?php foreach($isi_keranjang as $item): 
                                $subtotal = $item['harga'] * $item['qty'];
                                $total_belanja += $subtotal;
                            ?>
                            <tr>
                                <td><?= $item['nama_produk']; ?></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td><?= $item['qty']; ?></td>
                                <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                <td>
    <a href="<?= site_url('Home/hapus_keranjang/'.$item['id_keranjang']); ?>" 
       class="btn btn-danger btn-sm" 
       onclick="return confirm('Hapus menu ini dari keranjang?')">
       Hapus
    </a>
</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if(!empty($isi_keranjang)): ?>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Pembayaran:</td>
                            <td colspan="2" class="fw-bold text-danger fs-5">Rp <?= number_format($total_belanja, 0, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>

                <?php if(!empty($isi_keranjang)): ?>
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('Home'); ?>" class="btn btn-outline-secondary">Kembali Belanja</a>
                    <a href="<?= site_url('Home/checkout'); ?>" class="btn btn-success px-5">Lanjut Pembayaran (Checkout)</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>