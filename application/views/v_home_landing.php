<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --espresso: #2C1810;
            --caramel: #C08261;
            --cream: #F8F5F2;
            --gold: #D4AF37;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--espresso); 
            color: var(--cream);
            overflow-x: hidden;
        }

        /* Navbar Glassmorphism - Terlihat Mahal */
        .navbar-coffee { 
            background: rgba(44, 24, 16, 0.8) !important; 
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(192, 130, 97, 0.2);
            padding: 15px 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            letter-spacing: 1px;
        }

        .nav-link {
            font-weight: 400;
            font-size: 0.95rem;
            margin: 0 10px;
            transition: 0.3s;
            color: rgba(248, 245, 242, 0.8) !important;
        }

        .nav-link:hover { color: var(--caramel) !important; }

        /* Hero Section */
        .hero-section { 
            min-height: 100vh; 
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top right, rgba(192, 130, 97, 0.1), transparent);
        }

        .hero-text-accent { 
            font-weight: 600; 
            letter-spacing: 3px; 
            text-transform: uppercase;
            color: var(--caramel); 
            font-size: 0.85rem;
        }

        .hero-title { 
            font-family: 'Playfair Display', serif;
            font-weight: 700; 
            font-size: 4rem; 
            line-height: 1.1; 
            margin-bottom: 25px; 
        }

        .hero-description { 
            font-weight: 300; 
            font-size: 1.15rem; 
            line-height: 1.8;
            color: rgba(234, 224, 213, 0.8); 
            margin-bottom: 40px; 
            max-width: 500px;
        }

        /* Tombol Premium */
        .btn-premium {
            padding: 15px 35px;
            border-radius: 0; /* Kotak tegas terlihat lebih formal/mahal */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.4s;
        }

        .btn-gold {
            background-color: var(--caramel);
            color: white;
            border: none;
        }

        .btn-gold:hover {
            background-color: white;
            color: var(--espresso);
            transform: translateY(-5px);
        }

        .btn-outline-premium {
            border: 1px solid var(--cream);
            color: var(--cream);
        }

        .btn-outline-premium:hover {
            background-color: var(--cream);
            color: var(--espresso);
        }

        /* Frame Gambar Melingkar Mahal */
        .image-frame {
            position: relative;
            display: inline-block;
        }

        .image-frame::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: 20px;
            bottom: 20px;
            border: 2px solid var(--caramel);
            border-radius: 50%;
            z-index: -1;
        }

        .hero-img {
            width: 480px;
            height: 480px;
            object-fit: cover;
            border-radius: 50%;
            border: 10px solid var(--espresso);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        /* Dropdown Styling */
        .dropdown-menu {
            background: var(--espresso);
            border: 1px solid rgba(192, 130, 97, 0.3);
            border-radius: 0;
            margin-top: 15px;
        }

        .dropdown-item {
            color: var(--cream);
            padding: 10px 25px;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background: var(--caramel);
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">
                JEJAK RASA
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('Home/menu'); ?>">Katalog</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Rewards & Games
                        </a>
                        <ul class="dropdown-menu shadow">
    <li><a class="dropdown-item" href="<?= site_url('Home/game'); ?>">🎡 Spin the Wheel</a></li>
    <li><a class="dropdown-item" href="<?= site_url('Home/kupon'); ?>">🎟️ Kumpulkan Kupon</a></li>
    <li><a class="dropdown-item" href="<?= site_url('Home/challenge_10s'); ?>">⏱️ 10s Challenge</a></li>
    
    <li><hr class="dropdown-divider"></li> 
    
    <li><a class="dropdown-item" href="<?= site_url('Home/absensi'); ?>">📅 Absensi Ngopi</a></li>
</ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="<?= site_url('Home/riwayat'); ?>">Riwayat</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('Home/contact_us'); ?>">Kontak</a></li>
                    
                    <li class="nav-item ms-lg-3">
                        <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-gold btn-sm px-3">
                            🛒 (<?= $total_keranjang; ?>)
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                    <div class="d-flex align-items-center gap-3">
    <?php if($this->session->userdata('id_user')): ?>
        
        <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm fw-bold">Logout</a>
    <?php else: ?>
        
        <a href="<?= site_url('Auth'); ?>" class="btn btn-primary btn-sm fw-bold shadow-sm">Login</a>
    <?php endif; ?>
</div>
</li>
                </ul>
            </div>
        </div>
    </nav>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --espresso: #3e2723;
        --mocha: #5d4037;
        --latte: #8d6e63;
        --cream: #f5f0eb;
        --white: #ffffff;
    }

    body {
        background-color: var(--cream);
        font-family: 'Poppins', sans-serif;
        color: var(--espresso);
        margin: 0;
        padding: 0;
    }

    /* Hero Section */
    .hero-container {
        min-height: 90vh;
        display: flex;
        align-items: center;
        padding: 100px 7%;
        overflow: hidden;
    }

    .hero-content {
        flex: 1;
        padding-right: 50px;
        z-index: 2;
    }

    .hero-visual {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    /* Styling Judul */
    .hero-content h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        line-height: 1.1;
        margin-bottom: 20px;
        color: var(--espresso);
    }

    .hero-content p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--mocha);
        margin-bottom: 35px;
        max-width: 500px;
    }

    /* Video Container dengan efek Frame Elegan */
    .video-frame {
        position: relative;
        width: 100%;
        max-width: 550px;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(62, 39, 35, 0.15);
        border: 8px solid var(--white);
        transform: rotate(2deg); /* Sedikit rotasi agar dinamis */
        transition: transform 0.5s ease;
    }

    .video-frame:hover {
        transform: rotate(0deg) scale(1.02);
    }

    .video-frame video {
        width: 100%;
        display: block;
    }

    /* Button Custom */
    .btn-coffee {
        background-color: var(--espresso);
        color: var(--white);
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        display: inline-block;
        box-shadow: 0 10px 20px rgba(62, 39, 35, 0.2);
    }

    .btn-coffee:hover {
        background-color: var(--latte);
        transform: translateY(-3px);
        color: var(--white);
    }

    /* Dekorasi Latar Belakang */
    .bg-circle {
        position: absolute;
        width: 400px;
        height: 400px;
        background: var(--latte);
        opacity: 0.1;
        border-radius: 50%;
        top: -100px;
        right: -100px;
        z-index: 1;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-container {
            flex-direction: column;
            text-align: center;
            padding-top: 140px;
        }
        .hero-content {
            padding-right: 0;
            margin-bottom: 50px;
        }
        .hero-content h1 {
            font-size: 3rem;
        }
        .hero-content p {
            margin: 0 auto 30px;
        }
        .video-frame {
            transform: rotate(0deg);
        }
    }
</style>

<div class="hero-container">
    <div class="bg-circle"></div>
    
    <div class="hero-content">
        <h1>Jejak Rasa,<br>Cerita Dalam Secangkir.</h1>
        <p>Nikmati harmoni rasa kopi pilihan yang diproses dengan sepenuh hati. Setiap tetesnya adalah perjalanan rasa yang tak terlupakan.</p>
        <a href="<?= site_url('Home/menu'); ?>" class="btn-coffee">Jelajahi Menu</a>
    </div>

    <div class="hero-visual">
        <div class="video-frame">
            <video autoplay loop muted playsinline>
                <source src="<?= base_url('assets/uploads/kopigif.mp4'); ?>" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
        </div>
    </div>
</div>