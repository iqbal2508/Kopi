<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --espresso: #2C1810;
            --mocha: #5d4037;
            --caramel: #C08261;
            --cream: #F8F5F2;
            --white: #ffffff;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--espresso); 
        }

        /* --- NAVBAR TEMA KOPI --- */
        .navbar-coffee { 
            background: var(--espresso) !important; 
            border-bottom: 3px solid var(--caramel);
        }

        /* --- TYPOGRAPHY --- */
        .invoice-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--espresso);
        }

        /* --- KARTU STRUK / INVOICE ELEGAN --- */
        .card-invoice { 
            background-color: var(--white); 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(44, 24, 16, 0.05);
        }

        .card-header-custom {
            background-color: transparent;
            border-bottom: 2px dashed rgba(44, 24, 16, 0.15);
            padding: 25px;
        }

        /* --- TABEL MENU --- */
        .table-coffee {
            margin-bottom: 0;
        }
        
        .table-coffee thead {
            background-color: var(--espresso) !important;
            color: var(--white) !important;
        }

        .table-coffee th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table-coffee th, .table-coffee td {
            padding: 14px 20px;
            border-color: rgba(44, 24, 16, 0.08);
            vertical-align: middle;
        }

        /* --- BADGE STATUS --- */
        .badge-coffee {
            background-color: var(--caramel);
            color: var(--white);
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 30px;
        }

        /* --- BUTTONS TEMA KOPI --- */
        .btn-coffee-secondary {
            background-color: var(--mocha);
            color: var(--white);
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-coffee-secondary:hover {
            background-color: var(--espresso);
            color: var(--white);
        }

        .btn-coffee-print {
            background-color: var(--caramel);
            color: var(--white);
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(192, 130, 97, 0.3);
        }

        .btn-coffee-print:hover {
            background-color: var(--espresso);
            color: var(--white);
            box-shadow: none;
        }

        /* --- MODIFIKASI KETIKA CETAK / PRINT STRUK --- */
        @media print {
            .no-print { 
                display: none !important; 
            }
            body { 
                background-color: #ffffff !important; 
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .card-invoice {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
            }
            .card-header-custom {
                border-bottom: 2px dashed #000000 !important;
                padding: 15px 0 !important;
            }
            .table-coffee thead {
                background-color: #2C1810 !important;
                color: #ffffff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="pb-5">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee shadow-sm no-print mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Admin'); ?>">
                <span>💻</span> POS Kasir - Jejak Rasa Coffee
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 no-print px-2">
            <h4 class="invoice-title mb-0">📄 Lembar Rincian Pesanan</h4>
            <a href="<?= site_url('Admin'); ?>" class="btn btn-coffee-secondary d-flex align-items-center gap-2">
                ↩️ Kembali ke Dashboard
            </a>
        </div>

        <div class="card card-invoice">
            <div class="card-header-custom">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-muted small d-block">NOMOR INVOICE</span>
                        <h3 class="fw-bold m-0" style="color: var(--caramel); font-family: 'Playfair Display', serif;">#<?= $transaksi['id_transaksi']; ?></h3>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span class="badge badge-coffee shadow-sm"><?= $transaksi['status_pesanan']; ?></span>
                    </div>
                </div>

                <div class="row g-3 border-bottom pb-4 text-center text-md-start">
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Waktu Pembuatan</small>
                        <strong class="text-espresso"><?= date('d M Y • H:i', strtotime($transaksi['tgl_transaksi'])); ?> WIB</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Tipe Distribusi</small>
                        <strong class="text-espresso">🛵 <?= $transaksi['tipe_pesanan']; ?></strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Sistem Pembayaran</small>
                        <strong class="text-espresso">💳 <?= $transaksi['metode_pembayaran']; ?></strong>
                    </div>
                </div>

                <div class="row pt-4 text-center text-md-start">
                    <div class="col-md-12">
                        <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Tujuan Pengiriman & Pelanggan</small>
                        <?php if($transaksi['id_user'] == 0): ?>
                            <strong class="fs-6 text-espresso">Pesanan POS (Kasir Offline) — Dine In / Take Away</strong>
                        <?php else: ?>
                            <strong class="fs-5 d-block text-espresso" style="font-family: 'Playfair Display', serif;"><?= isset($transaksi['nama_lengkap']) ? $transaksi['nama_lengkap'] : 'Pelanggan Terdaftar'; ?></strong>
                            <span class="text-muted d-block mt-1" style="font-size: 0.95rem;">
                                📍 Lokasi Pengiriman: <strong class="text-dark"><?= (!empty($transaksi['kota']) || !empty($transaksi['provinsi'])) ? $transaksi['kota'] . ', ' . $transaksi['provinsi'] : 'Tidak mencantumkan lokasi spesifik'; ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0 table-responsive">
                <table class="table table-coffee table-hover">
                    <thead>
                        <tr>
                            <th class="ps-4">Menu Racikan Kopi</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Kuantitas</th>
                            <th class="text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $item): ?>
                        <tr>
                            <td class="fw-semibold ps-4 text-espresso">☕ <?= $item['nama_produk']; ?></td>
                            <td class="text-center">Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                            <td class="text-center fw-bold" style="color: var(--caramel);"><?= $item['qty']; ?> Cup</td>
                            <td class="text-end fw-semibold pe-4 text-espresso">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot style="background-color: rgba(44, 24, 16, 0.02);">
                        <tr>
                            <th colspan="3" class="text-end fs-6 text-espresso ps-4" style="border: none;">TOTAL KESELURUHAN NOMINAL:</th>
                            <th class="text-end pe-4 fs-5" style="color: #8c2b2b; border: none; font-family: 'Playfair Display', serif; font-weight: 700;">
                                Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="text-end mt-4 no-print px-2">
            <button onclick="window.print()" class="btn btn-coffee-print px-4 py-2 d-inline-flex align-items-center gap-2">
                🖨️ Cetak Struk Nota (Dapur)
            </button>
        </div>
    </div>

</body>
</html>