<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #F5EFE6 !important; /* Warna Krem / Latte */
            color: #3e2723; /* Warna Teks Cokelat Tua */
        }
        .navbar-kopi {
            background-color: #3e2723 !important; /* Cokelat Gelap / Espresso */
        }
        .container-kopi {
            border-top: 5px solid #5D4037; /* Aksen garis Mocha di atas kontainer */
            border-radius: 8px;
        }
        .table-kopi thead {
            background-color: #5D4037 !important; /* Cokelat Sedang / Mocha */
            color: #F5EFE6; /* Teks terang */
        }
        .badge-kopi {
            background-color: #8D6E63 !important; /* Cokelat Susu terang */
            color: #ffffff;
        }
        .btn-kopi-danger {
            background-color: #bcaaa4; /* Cokelat pucat untuk tombol bahaya */
            border-color: #bcaaa4;
            color: #3e2723;
            font-weight: bold;
        }
        .btn-kopi-danger:hover {
            background-color: #8D6E63;
            border-color: #8D6E63;
            color: #ffffff;
        }
        .navbar-kopi .navbar-brand {
            color: #F5EFE6 !important;
        }
        .navbar-kopi .navbar-brand:hover {
            color: #ffffff !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-kopi shadow-sm mb-4 p-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
            <span class="text-white">Kelola Akun Pelanggan</span>
        </div>
    </nav>

    <div class="container bg-white p-4 shadow-sm container-kopi">
        <h4 class="mb-4 fw-bold" style="color: #4b3832;">☕ Daftar Akun Pelanggan Terdaftar</h4>

        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-kopi">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Status Akses</th>
                    <th>Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($users)): ?>
                    <tr><td colspan="5" class="text-center py-4">Belum ada pelanggan yang mendaftar.</td></tr>
                <?php else: ?>
                    <?php $no=1; foreach($users as $u): ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $no++; ?></td>
                        <td class="text-start fw-bold" style="color: #3e2723;"><?= $u['nama_lengkap']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><span class="badge badge-kopi px-3 py-2">Pelanggan Aktif</span></td>
                        <td>
                            <a href="<?= site_url('Admin/hapus_user/'.$u['id_user']); ?>" class="btn btn-sm btn-kopi-danger px-4 shadow-sm" onclick="return confirm('Yakin ingin menghapus akun pelanggan ini secara permanen?')">Hapus Akun</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>