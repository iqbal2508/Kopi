<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* TEMA KOPI PREMIUM */
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; color: #33211D; }
        .navbar-coffee { background-color: #4A2C2A !important; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .card-custom { border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(74, 44, 42, 0.08); background-color: white;}
        .table-coffee thead th { background-color: #6F4E37 !important; color: #ffffff !important; border-bottom: none; }
        .btn-caramel { background-color: #C08261; color: white; border: none; border-radius: 8px; transition: 0.3s; }
        .btn-caramel:hover { background-color: #A0694A; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-coffee mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
            <span class="text-white opacity-75">Kelola Data Menu</span>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="card-custom p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0" style="color: #4A2C2A;">📦 Daftar Menu Kopi</h3>
                <button class="btn btn-caramel fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Menu Baru</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-coffee">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($produk as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><span class="badge bg-secondary"><?= $p['nama_kategori']; ?></span></td>
                            <td class="text-start fw-bold"><?= $p['nama_produk']; ?></td>
                            <td class="fw-bold" style="color: #D25345;">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td><?= $p['stok']; ?></td>
                            
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?= site_url('Admin/edit_produk/'.$p['id_produk']); ?>" class="btn btn-sm btn-info text-white fw-bold px-3">Edit</a>
                                    <a href="<?= site_url('Admin/hapus_produk/'.$p['id_produk']); ?>" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
                                </div>
                            </td>
                            
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($produk)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada menu yang ditambahkan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header text-white" style="background-color: #4A2C2A;">
                    <h5 class="modal-title fw-bold">Tambah Menu Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= site_url('Admin/aksi_tambah_produk'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Menu</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Menu (JPG/PNG)</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-caramel fw-bold px-4">Simpan Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>