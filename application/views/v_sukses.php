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
            --success-green: #3b593f;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--espresso); 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* --- KARTU UTAMA --- */
        .card-custom { 
            background-color: var(--white); 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(44, 24, 16, 0.08);
            padding: 50px 40px;
            max-width: 650px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Sudut Kartu */
        .card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--espresso), var(--caramel), var(--espresso));
        }

        /* --- TIPOGRAFI --- */
        .title-success {
            font-family: 'Playfair Display', serif;
            color: var(--success-green);
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 5px;
        }

        .invoice-box {
            background-color: rgba(44, 24, 16, 0.03);
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
            display: inline-block;
        }

        .invoice-number {
            font-family: 'Playfair Display', serif;
            color: var(--caramel);
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        /* --- BOX PEMBAYARAN KHUSUS --- */
        .payment-box {
            background-color: rgba(192, 130, 97, 0.05);
            border: 1px dashed rgba(192, 130, 97, 0.5);
            border-radius: 15px;
            padding: 25px 20px;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .payment-title {
            font-family: 'Playfair Display', serif;
            color: var(--espresso);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        /* Gambar QRIS */
        .qris-img {
            max-width: 250px;
            border-radius: 15px;
            border: 2px solid rgba(192, 130, 97, 0.3);
            padding: 10px;
            background: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .qris-img:hover {
            transform: scale(1.05);
        }

        /* --- BUTTONS --- */
        .btn-kopi-primary {
            background-color: var(--espresso);
            color: var(--white);
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }
        .btn-kopi-primary:hover {
            background-color: var(--caramel);
            color: var(--white);
            box-shadow: 0 5px 15px rgba(192, 130, 97, 0.3);
        }

        .btn-kopi-outline {
            background-color: transparent;
            color: var(--espresso);
            border: 1px solid var(--espresso);
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-kopi-outline:hover {
            background-color: var(--espresso);
            color: var(--white);
        }

        .icon-success {
            font-size: 4rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card-custom">
    
    <div class="icon-success">✨☕</div>
    <h2 class="title-success">Pesanan Berhasil!</h2>
    <p class="text-muted">Terima kasih telah mempercayakan cerita hari ini pada racikan kami.</p>
    
    <div class="invoice-box">
        <span class="text-muted small d-block mb-1">Nomor Invoice Anda</span>
        <p class="invoice-number">#<?= $id_transaksi; ?></p>
    </div>
    
    <hr style="border-color: rgba(44, 24, 16, 0.1); margin: 30px 0;">
    
    <?php if($transaksi['metode_pembayaran'] == 'QRIS'): ?>
        <h4 class="payment-title">Silakan Scan QRIS Berikut</h4>
        <p class="text-muted fw-medium">Total: <span style="color: var(--caramel); font-size: 1.2rem; font-weight: bold;">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></span></p>
        
        <div class="my-4">
            <img src="<?= base_url('assets/uploads/qris.jpg'); ?>" alt="QRIS Jejak Rasa" class="qris-img">
        </div>
        
        <p class="mt-3 text-muted small fst-italic">*Harap simpan tangkapan layar (screenshot) sebagai bukti pembayaran Anda.</p>

    <?php elseif($transaksi['metode_pembayaran'] == 'Transfer Bank'): ?>
        <div class="payment-box">
            <h4 class="payment-title">Detail Transfer Bank</h4>
            <p class="text-muted small mb-4">Silakan selesaikan pembayaran ke rekening di bawah ini:</p>
            
            <div class="text-start d-inline-block">
                <p class="mb-1 text-muted">Bank Tujuan:</p>
                <h5 class="fw-bold mb-3" style="color: var(--espresso);">BCA (Bank Central Asia)</h5>
                
                <p class="mb-1 text-muted">Nomor Rekening:</p>
                <h4 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--caramel); letter-spacing: 2px;">1234 5678 910</h4>
                
                <p class="mb-1 text-muted">Atas Nama:</p>
                <h5 class="fw-bold mb-4" style="color: var(--espresso);">Iqbal</h5>
                
                <hr style="border-style: dashed; opacity: 0.2;">
                
                <p class="mb-1 text-muted">Total Pembayaran:</p>
                <h4 class="fw-bold" style="color: var(--success-green);">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></h4>
            </div>
        </div>
        <p class="text-muted small fst-italic">*Harap simpan struk atau bukti mutasi Anda.</p>

    <?php elseif($transaksi['metode_pembayaran'] == 'Bayar di Tempat'): ?>
        <div class="payment-box" style="background-color: rgba(59, 89, 63, 0.05); border-color: rgba(59, 89, 63, 0.3);">
            <h4 class="payment-title" style="color: var(--success-green);">Pesanan Anda Segera Disiapkan!</h4>
            <p class="text-muted mb-4">Anda memilih untuk mengambil dan membayar langsung di lokasi kami.</p>
            
            <div class="text-start d-inline-block">
                <p class="mb-1 fw-bold" style="color: var(--espresso);">📍 Alamat Pengambilan:</p>
                <p class="text-muted mb-0">JL Thalib 3 Dalam<br>Jakarta Barat</p>
            </div>
        </div>
        <p class="text-muted small">Tunjukkan nomor invoice <strong style="color: var(--caramel);">#<?= $id_transaksi; ?></strong> kepada barista kami saat Anda tiba.</p>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-5">
        <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-kopi-outline">Cek Riwayat Pesanan</a>
        <a href="<?= site_url('Home/menu'); ?>" class="btn btn-kopi-primary">Kembali ke Menu</a>
    </div>
</div>

</body>
</html>