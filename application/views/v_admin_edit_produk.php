<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; }
        .card-custom { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-coffee { background-color: #6F4E37; color: white; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom p-4">
                    <h4 class="fw-bold mb-4" style="color: #4A2C2A;">✏️ Edit Menu Kopi</h4>
                    
                    <form action="<?= site_url('Admin/proses_edit_produk'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $produk['gambar']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Menu</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?= $produk['nama_produk']; ?>" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?= $produk['harga']; ?>" required>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">Stok Cup</label>
                                <input type="number" name="stok" class="form-control" value="<?= $produk['stok']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Produk</label><br>
                            <img src="<?= base_url('assets/uploads/'.$produk['gambar']); ?>" width="100" class="rounded mb-2 border">
                            <input type="file" name="gambar_baru" class="form-control">
                            <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-coffee w-100 py-2 fw-bold">Simpan Perubahan</button>
                            <a href="<?= site_url('Admin/produk'); ?>" class="btn btn-outline-secondary w-100 py-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>