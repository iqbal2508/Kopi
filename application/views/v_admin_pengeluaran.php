<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> body { background-color: #f4f6f9; } </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4 shadow">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="<?= site_url('Admin/pendapatan'); ?>">🔙 Kembali ke Laba/Rugi</a>
    </div>
</nav>

<div class="container px-4">
    <h3 class="fw-bold mb-4">🛒 Catatan Belanja Bahan (Modal)</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-dark py-3"><h5 class="mb-0 fw-bold">➕ Tambah Belanjaan</h5></div>
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= site_url('Admin/simpan_belanja'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Beli</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Biji Kopi Arabika 1Kg" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Total Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 fw-bold">Simpan Belanjaan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tanggal</th>
                                    <th class="text-start">Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($pengeluaran)): ?>
                                    <tr><td colspan="4" class="py-4">Belum ada catatan belanja.</td></tr>
                                <?php else: ?>
                                    <?php foreach($pengeluaran as $row): ?>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                        <td class="text-start"><?= $row['nama_barang']; ?></td>
                                        <td class="text-danger fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_pengeluaran']; ?>">Edit</button>
                                            <a href="<?= site_url('Admin/hapus_belanja/'.$row['id_pengeluaran']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus barang ini?');">Hapus</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal<?= $row['id_pengeluaran']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form class="modal-content text-start" action="<?= site_url('Admin/edit_belanja'); ?>" method="post">
                                                <div class="modal-header"><h5 class="modal-title">Edit Belanjaan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pengeluaran" value="<?= $row['id_pengeluaran']; ?>">
                                                    <div class="mb-2"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required></div>
                                                    <div class="mb-2"><label>Nama Barang</label><input type="text" name="nama_barang" class="form-control" value="<?= $row['nama_barang']; ?>" required></div>
                                                    <div class="mb-2"><label>Harga</label><input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required></div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-success">Simpan Perubahan</button></div>
                                            </form>
                                        </div>
                                    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>