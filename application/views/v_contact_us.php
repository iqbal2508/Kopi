<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; }
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .contact-section { padding-top: 120px; padding-bottom: 80px; }
        .card-coffee { background-color: #4A2C2A; color: #F8F5F2; border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .form-control { background-color: rgba(255,255,255,0.05); border: 1px solid #6F4E37; color: white; border-radius: 8px; padding: 12px; }
        .form-control:focus { background-color: rgba(255,255,255,0.1); border-color: #C08261; color: white; box-shadow: 0 0 0 0.25rem rgba(192, 130, 97, 0.25); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('Home'); ?>">
                <span style="font-size: 1.5rem;">☕</span> Jejak Rasa Kopi
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white opacity-75 small">Halo, <?= $this->session->userdata('nama'); ?></span>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm fw-bold">Katalog</a>
                <a href="<?= site_url('Home/riwayat'); ?>" class="btn btn-outline-light btn-sm">Riwayat</a>
                <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-warning btn-sm fw-bold">🛒 Keranjang (<?= $total_keranjang; ?>)</a>
            </div>
        </div>
    </nav>

    <style>
    /* Wrapper utama dengan jarak atas lebih luas agar tidak menempel navbar */
    .contact-coffee-wrapper {
        background-color: #fcfaf8; /* Warna latar yang lebih cerah & bersih */
        padding: 120px 20px 80px 20px; /* Jarak atas 120px untuk ruang dari navbar */
        font-family: 'Helvetica Neue', Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    /* Card dengan gaya minimalis dan bayangan lembut */
    .contact-coffee-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 50px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 15px 45px rgba(62, 39, 35, 0.05); /* Shadow tipis agar elegan */
        text-align: center;
        border: 1px solid #f1ede9;
    }

    /* Judul dengan aksen warna kopi */
    .contact-coffee-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 40px;
        color: #4e342e;
        letter-spacing: 2px;
        text-transform: uppercase;
        position: relative;
    }

    /* Garis dekoratif kecil di bawah judul */
    .contact-coffee-title::after {
        content: "";
        display: block;
        width: 40px;
        height: 2px;
        background: #8d6e63;
        margin: 15px auto 0;
    }

    /* List info kontak */
    .contact-info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-item {
        margin-bottom: 25px;
    }

    .contact-label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #a1887f;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .contact-value {
        font-size: 16px;
        color: #3e2723;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    /* Hover effect pada link */
    a.contact-value:hover {
        color: #8d6e63;
    }

    /* Responsive adjustment */
    @media (max-width: 480px) {
        .contact-coffee-wrapper {
            padding-top: 100px;
        }
        .contact-coffee-card {
            padding: 30px;
        }
    }
</style>

<div class="contact-coffee-wrapper">
    <div class="contact-coffee-card">
        <h2 class="contact-coffee-title">Jejak Rasa Kopi</h2>
        
        <div class="contact-info-list">
            <div class="contact-item">
                <span class="contact-label">Alamat</span>
                <span class="contact-value">Jl. Thalib 3 Dalam No 5</span>
            </div>

            <div class="contact-item">
                <span class="contact-label">Telepon</span>
                <a href="tel:08821401360" class="contact-value">08821401360</a>
            </div>

            <div class="contact-item">
                <span class="contact-label">Email</span>
                <a href="mailto:JejakRasa@gmail.com" class="contact-value">JejakRasa@gmail.com</a>
            </div>

            <div class="contact-item">
                <span class="contact-label">Instagram</span>
                <a href="https://instagram.com/jejak.rasa.kopi" target="_blank" class="contact-value">@jejak.rasa.kopi</a>
            </div>
        </div>
    </div>
</div>