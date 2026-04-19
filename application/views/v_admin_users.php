<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
            <span class="text-white">Kelola Akun Pelanggan</span>
        </div>
    </nav>

    <div class="container bg-white p-4 shadow-sm rounded">
        <h4 class="mb-4">👥 Daftar Akun Pelanggan Terdaftar</h4>

        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
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
                        <td><?= $no++; ?></td>
                        <td class="text-start fw-bold"><?= $u['nama_lengkap']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><span class="badge bg-success">Pelanggan Aktif</span></td>
                        <td>
                            <a href="<?= site_url('Admin/hapus_user/'.$u['id_user']); ?>" class="btn btn-sm btn-danger px-4" onclick="return confirm('Yakin ingin menghapus akun pelanggan ini secara permanen?')">Hapus Akun</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>