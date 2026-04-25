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
        <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">🔙 Kembali ke Dashboard</a>
        <a href="<?= site_url('Admin/belanja'); ?>" class="btn btn-warning btn-sm fw-bold">🛒 Kelola Catatan Belanja</a>
    </div>
</nav>

<div class="container px-4">
    <h3 class="fw-bold mb-4">💰 Hitung Laba/Rugi</h3>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white py-3"><h5 class="mb-0 fw-bold">📝 Form Input Keuangan</h5></div>
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= site_url('Admin/simpan_keuangan'); ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Opsi Pengisian</label>
                            <select id="opsi_input" class="form-select bg-light text-primary fw-bold">
                                <option value="manual">✍️ Input Manual</option>
                                <option value="otomatis">🤖 Tarik Otomatis dari Sistem</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Bulan</label>
                            <input type="month" name="bulan" id="bulan" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Modal Pembelian</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="modal" id="modal" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Pendapatan Kotor</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="pendapatan" id="pendapatan" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Hitung & Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom"><h5 class="mb-0 fw-bold text-dark">📊 Riwayat Perhitungan</h5></div>
                <div class="card-body p-0">
                <div class="table-responsive">
    <table class="table table-hover text-center align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>Bulan</th>
                <th>Modal</th>
                <th>Pendapatan</th>
                <th>Laba Bersih</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($riwayat)): ?>
                <tr><td colspan="6" class="py-4 text-muted">Belum ada data.</td></tr>
            <?php else: ?>
                <?php foreach($riwayat as $row): ?>
                <tr>
                    <td class="fw-bold"><?= $row['bulan']; ?></td>
                    <td class="text-danger">Rp <?= number_format($row['modal'], 0, ',', '.'); ?></td>
                    <td class="text-primary">Rp <?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
                    <td class="fw-bold">Rp <?= number_format($row['laba_rugi'], 0, ',', '.'); ?></td>
                    <td>
                        <?php if($row['laba_rugi'] > 0): ?> <span class="badge bg-success px-2 py-1">Untung</span>
                        <?php else: ?> <span class="badge bg-danger px-2 py-1">Rugi</span> <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_keuangan']; ?>">Edit</button>
                        <a href="<?= site_url('Admin/hapus_keuangan/'.$row['id_keuangan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if(!empty($riwayat)): ?>
    <?php foreach($riwayat as $row): ?>
    <div class="modal fade" id="editModal<?= $row['id_keuangan']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content text-start" action="<?= site_url('Admin/edit_keuangan'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bulan <?= $row['bulan']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_keuangan" value="<?= $row['id_keuangan']; ?>">
                    <div class="mb-2"><label>Bulan</label><input type="month" name="bulan" class="form-control" value="<?= $row['bulan']; ?>" required></div>
                    <div class="mb-2"><label>Modal</label><input type="number" name="modal" class="form-control" value="<?= $row['modal']; ?>" required></div>
                    <div class="mb-2"><label>Pendapatan</label><input type="number" name="pendapatan" class="form-control" value="<?= $row['pendapatan']; ?>" required></div>
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
<script>
    // --- SCRIPT AUTO-FETCH DATA SISTEM ---
    const opsiInput = document.getElementById('opsi_input');
    const inputBulan = document.getElementById('bulan');
    const inputModal = document.getElementById('modal');
    const inputPendapatan = document.getElementById('pendapatan');

    function cekDataSistem() {
        if(opsiInput.value === 'otomatis' && inputBulan.value !== '') {
            inputModal.readOnly = true;
            inputPendapatan.readOnly = true;
            inputModal.value = 'Mencari data...';
            inputPendapatan.value = 'Mencari data...';

            // Panggil API lewat AJAX
            fetch('<?= site_url("Admin/get_data_sistem"); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'bulan=' + inputBulan.value
            })
            .then(response => response.json())
            .then(data => {
                inputModal.value = data.modal;
                inputPendapatan.value = data.pendapatan;
            });
        } else if (opsiInput.value === 'manual') {
            inputModal.readOnly = false;
            inputPendapatan.readOnly = false;
            inputModal.value = '';
            inputPendapatan.value = '';
        }
    }

    // Jalankan pengecekan setiap kali Opsi atau Bulan diganti
    opsiInput.addEventListener('change', cekDataSistem);
    inputBulan.addEventListener('change', cekDataSistem);
</script>
</body>
</html>