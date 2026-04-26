<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* TEMA KOPI ELEGAN & CREAMY */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FDF8F5; /* Warna dasar creamy warm */
            color: #4A3324;
        }
        
        /* Navbar Latte */
        .navbar-coffee {
            background-color: #C39873 !important;
            box-shadow: 0 4px 15px rgba(195, 152, 115, 0.2);
        }
        
        .navbar-coffee .btn-outline-light {
            border-color: #FAF4F0;
            color: #FAF4F0;
            transition: all 0.3s ease;
        }
        .navbar-coffee .btn-outline-light:hover {
            background-color: #FAF4F0;
            color: #C39873;
        }

        /* Card & Layout */
        .card-custom {
            border-radius: 16px;
            border: 1px solid #F0E6D9;
            background-color: #FFFFFF;
            box-shadow: 0 10px 30px rgba(139, 94, 60, 0.06);
            overflow: hidden;
        }
        
        .card-header-coffee {
            background-color: #EAD8C3; /* Warna creamy beige */
            color: #5C3D2E;
            border-bottom: 1px solid #F0E6D9;
        }

        /* Modifikasi Tabel Creamy */
        .table-coffee thead th {
            background-color: #EAD8C3 !important;
            color: #5C3D2E !important;
            font-weight: 600;
            border-bottom: none;
            padding: 14px;
        }
        .table-hover tbody tr:hover {
            background-color: #FCF9F5;
        }
        .table td {
            vertical-align: middle;
            border-color: #F0E6D9;
            color: #5C3D2E;
        }

        /* Form Input Custom */
        .input-group-text {
            background-color: #F0E6D9;
            border-color: #EAD8C3;
            color: #5C3D2E;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-color: #EAD8C3;
            color: #4A3324;
        }
        .form-control:focus, .form-select:focus {
            border-color: #C39873;
            box-shadow: 0 0 0 0.25rem rgba(195, 152, 115, 0.25);
        }

        /* Tombol Aksi Kustom */
        .btn-caramel {
            background-color: #D4A373; /* Karamel cerah */
            color: white;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-caramel:hover {
            background-color: #BC8A5B;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(212, 163, 115, 0.3);
        }

        .btn-mocha {
            background-color: #8C6A53; /* Cokelat susu */
            color: white;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-mocha:hover {
            background-color: #6F513D;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(140, 106, 83, 0.3);
        }
        
        .text-coffee {
            color: #5C3D2E !important;
        }
        .text-coffee-light {
            color: #C39873 !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-coffee py-3 mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white" href="<?= site_url('Admin'); ?>">
            <span style="font-size: 1.2rem;">🔙</span> Kembali ke Dashboard
        </a>
        <a href="<?= site_url('Admin/belanja'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-bold shadow-sm">
            🛒 Kelola Catatan Belanja
        </a>
    </div>
</nav>

<div class="container-fluid px-4 pb-5">
    <h3 class="fw-bold mb-4" style="color: #4A3324;">💰 Hitung Laba/Rugi</h3>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-custom h-100">
                <div class="card-header card-header-coffee py-3">
                    <h5 class="mb-0 fw-bold">📝 Form Input Keuangan</h5>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= site_url('Admin/simpan_keuangan'); ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-coffee">Opsi Pengisian</label>
                            <select id="opsi_input" class="form-select fw-bold text-coffee">
                                <option value="manual">✍️ Input Manual</option>
                                <option value="otomatis">🤖 Tarik Otomatis dari Sistem</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-coffee">Pilih Bulan</label>
                            <input type="month" name="bulan" id="bulan" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-coffee">Modal Pembelian</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="modal" id="modal" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-coffee">Pendapatan Kotor</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan" id="pendapatan" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-caramel w-100 py-2 fw-bold">Hitung & Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card card-custom h-100">
                <div class="card-header card-header-coffee py-3">
                    <h5 class="mb-0 fw-bold">📊 Riwayat Perhitungan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-coffee table-hover text-center align-middle mb-0">
                            <thead>
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
                                    <tr><td colspan="6" class="py-5 text-muted">Belum ada data perhitungan.</td></tr>
                                <?php else: ?>
                                    <?php foreach($riwayat as $row): ?>
                                    <tr>
                                        <td class="fw-bold text-coffee"><?= $row['bulan']; ?></td>
                                        <td style="color: #D25345;">Rp <?= number_format($row['modal'], 0, ',', '.'); ?></td>
                                        <td style="color: #C39873; font-weight: 500;">Rp <?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
                                        <td class="fw-bold" style="color: #5C3D2E;">Rp <?= number_format($row['laba_rugi'], 0, ',', '.'); ?></td>
                                        <td>
                                            <?php if($row['laba_rugi'] > 0): ?> 
                                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Untung</span>
                                            <?php else: ?> 
                                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Rugi</span> 
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-mocha mb-1 w-100" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_keuangan']; ?>">Edit</button>
                                            <a href="<?= site_url('Admin/hapus_keuangan/'.$row['id_keuangan']); ?>" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus data ini secara permanen?');">Hapus</a>
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

<?php if(!empty($riwayat)): ?>
    <?php foreach($riwayat as $row): ?>
    <div class="modal fade" id="editModal<?= $row['id_keuangan']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="card card-custom border-0">
                <form action="<?= site_url('Admin/edit_keuangan'); ?>" method="post">
                    <div class="card-header card-header-coffee border-bottom-0 rounded-top">
                        <h5 class="modal-title fw-bold">Edit Laporan Bulan <?= $row['bulan']; ?></h5>
                        <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-white">
                        <input type="hidden" name="id_keuangan" value="<?= $row['id_keuangan']; ?>">
                        
                        <div class="mb-3">
                            <label class="fw-bold text-coffee mb-1">Bulan</label>
                            <input type="month" name="bulan" class="form-control" value="<?= $row['bulan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold text-coffee mb-1">Modal</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="modal" class="form-control" value="<?= $row['modal']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold text-coffee mb-1">Pendapatan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan" class="form-control" value="<?= $row['pendapatan']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0 rounded-bottom">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-caramel px-4 fw-bold">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

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