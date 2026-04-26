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
        
        /* Styling Tombol Khusus Kopi */
        .btn-coffee {
            background-color: #5d4037; /* Cokelat Mocha */
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-coffee:hover {
            background-color: #3e2723;
            color: #fff;
            transform: translateY(-2px);
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

        /* Styling Kartu Elegan */
        .card-coffee {
            border: 1px solid #eaddcf;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(62, 39, 35, 0.05) !important;
            background-color: #ffffff;
            overflow: hidden;
        }
        .card-coffee-header {
            background-color: #f5e6d3; /* Light Cream */
            color: #3e2723;
            border-bottom: 1px solid #eaddcf;
        }

        /* Styling Tabel */
        .table-coffee-header {
            background-color: #f5e6d3 !important;
            color: #3e2723 !important;
        }
        .form-control:focus {
            border-color: #b97a57;
            box-shadow: 0 0 0 0.25rem rgba(185, 122, 87, 0.25);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-coffee-dark mb-4 shadow">
    <div class="container-fluid px-4 py-1">
        <a class="navbar-brand fw-bold text-light" href="<?= site_url('Admin/pendapatan'); ?>">🔙 Kembali ke Laba/Rugi</a>
    </div>
</nav>

<div class="container px-4">
    <h3 class="fw-bold mb-4 text-coffee-dark">☕ Catatan Belanja Bahan (Modal)</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-coffee h-100">
                <div class="card-header card-coffee-header py-3">
                    <h5 class="mb-0 fw-bold">➕ Tambah Belanjaan</h5>
                </div>
                <div class="card-body bg-white">
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= site_url('Admin/simpan_belanja'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-coffee-dark small">TANGGAL BELI</label>
                            <input type="date" name="tanggal" class="form-control text-secondary" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-coffee-dark small">NAMA BARANG</label>
                            <input type="text" name="nama_barang" class="form-control text-secondary" placeholder="Contoh: Biji Kopi Arabika 1Kg" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-coffee-dark small">TOTAL HARGA</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-coffee-dark fw-bold">Rp</span>
                                <input type="number" name="harga" class="form-control text-secondary" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-coffee w-100 fw-bold rounded-pill shadow-sm py-2">Simpan Belanjaan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card card-coffee h-100">
                <div class="card-body p-0 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="table-coffee-header py-3">Tanggal</th>
                                    <th class="table-coffee-header py-3">Nama Barang</th>
                                    <th class="table-coffee-header py-3">Harga</th>
                                    <th class="table-coffee-header py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($pengeluaran)): ?>
                                    <tr><td colspan="4" class="py-5 text-muted fst-italic">Belum ada catatan belanja bahan.</td></tr>
                                <?php else: ?>
                                    <?php foreach($pengeluaran as $row): ?>
                                    <tr>
                                        <td class="fw-medium text-secondary"><?= $row['tanggal']; ?></td>
                                        <td class="text-coffee-dark fw-bold"><?= $row['nama_barang']; ?></td>
                                        <td class="text-coffee-accent fw-bold fs-6">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                        <td class="py-2">
                                            <button class="btn btn-sm btn-outline-coffee rounded-pill px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_pengeluaran']; ?>">Edit</button>
                                            <a href="<?= site_url('Admin/hapus_belanja/'.$row['id_pengeluaran']); ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold" onclick="return confirm('Hapus catatan ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($pengeluaran)): ?>
    <?php foreach($pengeluaran as $row): ?>
    <div class="modal fade" id="editModal<?= $row['id_pengeluaran']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content text-start border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;" action="<?= site_url('Admin/edit_belanja'); ?>" method="post">
                <div class="modal-header card-coffee-header">
                    <h5 class="modal-title fw-bold">✏️ Edit Belanjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body bg-white p-4">
                    <input type="hidden" name="id_pengeluaran" value="<?= $row['id_pengeluaran']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-coffee-dark small">TANGGAL</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-coffee-dark small">NAMA BARANG</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= $row['nama_barang']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-coffee-dark small">TOTAL HARGA</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold text-coffee-dark">Rp</span>
                            <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-light rounded-pill fw-bold text-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-coffee rounded-pill fw-bold px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>