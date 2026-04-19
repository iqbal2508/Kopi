<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; color: #33211D; }
        .navbar-coffee { background-color: #4A2C2A !important; }
        .card-custom { border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(74, 44, 42, 0.08); }
        .table-coffee thead th { background-color: #6F4E37 !important; color: #ffffff !important; border-bottom: none; }
        
        /* Hilangkan elemen tertentu saat di-print (seperti tombol dan kolom aksi) */
        @media print {
            body { background-color: white !important; }
            .card-custom { box-shadow: none !important; }
            .d-print-none { display: none !important; }
            .cetak-hilang { display: none !important; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-coffee shadow-sm mb-4 d-print-none">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin'); ?>">⬅️ Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="card card-custom p-4 p-md-5 bg-white">
            
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A2C2A;">LAPORAN PENJUALAN</h2>
                <h5 class="text-muted">UMKM Jejak Rasa Kopi</h5>
                <p class="mb-0 small">Dicetak pada: <?= date('d F Y, H:i'); ?></p>
            </div>

            <div class="row mb-5 text-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="border rounded-4 p-4" style="background-color: #FDFBF9; border-color: #EAE0D5 !important;">
                        <h6 class="text-muted fw-bold mb-2">Total Pendapatan (Omzet)</h6>
                        <h2 class="fw-bold" style="color: #D25345;">Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-4 p-4" style="background-color: #FDFBF9; border-color: #EAE0D5 !important;">
                        <h6 class="text-muted fw-bold mb-2">Total Transaksi Selesai</h6>
                        <h2 class="fw-bold" style="color: #6F4E37;"><?= count($laporan); ?> Pesanan</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-3 d-print-none">
                <a href="<?= site_url('Admin/reset_laporan'); ?>" class="btn btn-outline-danger fw-bold" onclick="return confirm('PERINGATAN: Yakin ingin mereset/menghapus SEMUA data laporan ini secara permanen?')">
                    🗑️ Reset Semua Laporan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-coffee text-center">
                        <tr>
                            <th>No</th>
                            <th>Waktu Transaksi</th>
                            <th>No. Invoice</th>
                            <th>Tipe Pesanan</th>
                            <th>Metode Bayar</th>
                            <th>Total Belanja</th>
                            <th class="cetak-hilang">Aksi</th> </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($laporan as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center small text-muted"><?= date('d/m/Y H:i', strtotime($row['tgl_transaksi'])); ?></td>
                            <td class="fw-bold" style="color: #C08261;"><?= $row['id_transaksi']; ?></td>
                            <td class="text-center"><?= $row['tipe_pesanan']; ?></td>
                            <td class="text-center"><?= $row['metode_pembayaran']; ?></td>
                            <td class="text-end fw-bold" style="color: #D25345;">Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                            
                            <td class="text-center cetak-hilang">
                                <a href="<?= site_url('Admin/hapus_laporan/'.$row['id_transaksi']); ?>" class="btn btn-sm btn-danger py-0" onclick="return confirm('Hapus transaksi ini dari laporan?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($laporan)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada data penjualan yang selesai.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-5 d-print-none">
                <button onclick="window.print()" class="btn btn-lg fw-bold px-5 text-white" style="background-color: #4A2C2A;">🖨️ Cetak Laporan (Print)</button>
            </div>

        </div>
    </div>

</body>
</html>