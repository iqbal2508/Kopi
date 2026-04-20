<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* TEMA KOPI PREMIUM (UI/UX Custom) */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F5F2; /* Warna dasar krem latte */
            color: #33211D;
        }
        
        /* Navbar Espresso */
        .navbar-coffee {
            background-color: #4A2C2A !important; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        /* Card & Layout */
        .card-custom {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 24px rgba(74, 44, 42, 0.08);
        }
        
        /* Modifikasi Tabel */
        .table-coffee thead th {
            background-color: #6F4E37 !important; /* Warna mocha */
            color: #ffffff !important;
            font-weight: 500;
            border-bottom: none;
            padding: 12px;
        }
        .table-hover tbody tr:hover {
            background-color: #FDFBF9;
        }
        .table td {
            vertical-align: middle;
            border-color: #EAE0D5;
        }

        /* Tombol Aksi Kustom */
        .btn-caramel {
            background-color: #C08261;
            color: white;
            border: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-caramel:hover {
            background-color: #A0694A;
            color: white;
            transform: translateY(-1px);
        }
        .btn-add-pos {
            background-color: #79ac78;
            color: white;
            border-radius: 8px;
            border: none;
        }
        .btn-add-pos:hover {
            background-color: #618a60;
            color: white;
        }

        /* Badge Kustom */
        .badge-status {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
        }
        .badge-offline {
            background-color: #EAE0D5;
            color: #6F4E37;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee py-3 mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span style="font-size: 1.5rem;">☕</span> POS Kasir - Jejak Rasa
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= site_url('Admin/users'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">👥 Kelola User</a>
                <a href="<?= site_url('Admin/produk'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">📦 Kelola Menu</a>
                <a href="<?= site_url('Admin/laporan'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">📊 Laporan</a>
                <a href="<?= site_url('Admin/pendapatan'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">Pendapatan</a>
                
                <div class="border-start border-secondary mx-2" style="height: 24px;"></div>
                
                <span class="text-white opacity-75 small">Halo, Admin</span>
                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold shadow-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 pb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-1">Daftar Pesanan Masuk</h3>
                <p class="text-muted small mb-0">Pantau dan kelola pesanan pelanggan dari web maupun offline.</p>
            </div>
            <a href="<?= site_url('Admin/pos'); ?>" class="btn btn-add-pos fw-bold px-4 py-2 shadow-sm">
                🛒 + Input Pesanan Kasir
            </a>
        </div>

        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0 table-responsive">
                <table class="table table-coffee table-hover align-middle mb-0 text-center">
                    <thead>
                        <tr>
                            <th>Waktu Pesanan</th>
                            <th>No. Invoice</th>
                            <th>Nama Pemesan</th>
                            <th>Tipe Pesanan</th>
                            <th>Total Tagihan</th>
                            <th>Metode Bayar</th>
                            <th>Status</th>
                            <th>Aksi Kasir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($transaksi)): ?>
                            <tr><td colspan="8" class="text-center py-5 text-muted">Belum ada pesanan yang masuk saat ini.</td></tr>
                        <?php else: ?>
                            <?php foreach($transaksi as $trx): ?>
                            <tr>
                                <td class="text-muted small"><?= date('d M Y, H:i', strtotime($trx['tgl_transaksi'])); ?></td>
                                
                                <td class="fw-bold">
                                    <a href="<?= site_url('Admin/detail/'.$trx['id_transaksi']); ?>" style="color: #C08261; text-decoration: none;">
                                        <?= $trx['id_transaksi']; ?>
                                    </a>
                                </td>
                                
                                <td>
                                    <?php if($trx['id_user'] == 0): ?>
                                        <span class="badge badge-status badge-offline">Pelanggan Kasir</span>
                                    <?php else: ?>
                                        <span class="fw-bold" style="color: #4A2C2A;"><?= $trx['nama_lengkap']; ?></span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border badge-status"><?= $trx['tipe_pesanan']; ?></span>
                                </td>
                                
                                <td class="fw-bold" style="color: #D25345;">Rp <?= number_format($trx['total_bayar'], 0, ',', '.'); ?></td>
                                
                                <td class="small"><?= $trx['metode_pembayaran']; ?></td>
                                
                                <td>
                                    <?php 
                                        $warna = 'bg-warning text-dark';
                                        if($trx['status_pesanan'] == 'Diproses') $warna = 'bg-info text-dark';
                                        if($trx['status_pesanan'] == 'Selesai') $warna = 'bg-success';
                                    ?>
                                    <span class="badge badge-status <?= $warna; ?> shadow-sm"><?= $trx['status_pesanan']; ?></span>
                                </td>
                                
                                <td>
                                    <?php if($trx['status_pesanan'] == 'Menunggu Pembayaran'): ?>
                                        <a href="<?= site_url('Admin/ubah_status/'.$trx['id_transaksi'].'/Diproses'); ?>" class="btn btn-sm btn-caramel w-100 mb-1">Terima Pesanan</a>
                                    <?php elseif($trx['status_pesanan'] == 'Diproses'): ?>
                                        <a href="<?= site_url('Admin/ubah_status/'.$trx['id_transaksi'].'/Selesai'); ?>" class="btn btn-sm btn-success w-100 shadow-sm">Tandai Selesai</a>
                                    <?php else: ?>
                                        <a href="<?= site_url('Admin/hapus_transaksi/'.$trx['id_transaksi']); ?>" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus riwayat pesanan ini secara permanen?')">Hapus</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>