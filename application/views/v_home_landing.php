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
            --mocha: #5d4037;
            --latte: #8d6e63;
            --caramel: #C08261;
            --cream: #F8F5F2;
            --gold: #D4AF37;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); /* Diubah ke cream agar cerah dan bisa di-scroll enak */
            color: var(--espresso);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Navbar Glassmorphism */
        .navbar-coffee { 
            background: rgba(44, 24, 16, 0.85) !important; 
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(192, 130, 97, 0.2);
            padding: 15px 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: var(--cream) !important;
        }

        .nav-link {
            font-weight: 400;
            font-size: 0.95rem;
            margin: 0 10px;
            transition: 0.3s;
            color: rgba(248, 245, 242, 0.8) !important;
        }

        .nav-link:hover { color: var(--caramel) !important; }

        /* Dropdown Styling */
        .dropdown-menu {
            background: var(--espresso);
            border: 1px solid rgba(192, 130, 97, 0.3);
            border-radius: 0;
            margin-top: 15px;
        }
        .dropdown-item { color: var(--cream); padding: 10px 25px; font-size: 0.9rem; }
        .dropdown-item:hover { background: var(--caramel); color: white; }

        /* Tombol Premium */
        .btn-gold {
            background-color: var(--caramel);
            color: white;
            border: none;
            border-radius: 5px;
        }
        .btn-gold:hover {
            background-color: white;
            color: var(--espresso);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 7% 50px;
            position: relative;
        }
        
        .bg-circle {
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--latte);
            opacity: 0.1;
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: 1;
        }

        .hero-content { flex: 1; padding-right: 50px; z-index: 2; }
        .hero-visual { flex: 1; display: flex; justify-content: center; align-items: center; z-index: 2;}

        .heading-playfair {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            line-height: 1.15;
            color: var(--espresso);
            margin-bottom: 20px;
        }

        .text-mocha { color: var(--mocha); font-size: 1.1rem; line-height: 1.8; }

        .btn-coffee {
            background-color: var(--espresso);
            color: var(--cream);
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
            background-color: var(--caramel);
            transform: translateY(-3px);
            color: var(--cream);
        }

        /* --- BINGKAI ALIRAN AIR KOPI (LIQUID BLOB FRAME) --- */
        .liquid-border-wrapper {
            position: relative;
            width: 100%;
            max-width: 450px;
            padding: 12px;
            /* Gradient warna-warni kopi yang bergerak */
            background: linear-gradient(45deg, #2C1810, #C08261, #5d4037, #D4AF37);
            background-size: 300% 300%;
            border-radius: 40% 60% 65% 35% / 40% 45% 55% 60%;
            /* Animasi aliran (blob) dan pergerakan gradient */
            animation: liquidFlow 5s ease-in-out infinite alternate, gradientShift 4s ease infinite;
            box-shadow: 0 20px 40px rgba(44, 24, 16, 0.25);
            transition: transform 0.4s ease;
        }
        
        .liquid-border-wrapper:hover {
            transform: scale(1.02);
        }

        .liquid-border-wrapper video {
            width: 100%;
            border-radius: 38% 62% 63% 37% / 38% 43% 57% 62%;
            animation: liquidFlowInner 5s ease-in-out infinite alternate;
            display: block;
            object-fit: cover;
            background-color: var(--espresso); /* Fallback saat loading */
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes liquidFlow {
            0% { border-radius: 40% 60% 65% 35% / 40% 45% 55% 60%; }
            100% { border-radius: 55% 45% 40% 60% / 55% 60% 40% 45%; }
        }
        
        @keyframes liquidFlowInner {
            0% { border-radius: 38% 62% 63% 37% / 38% 43% 57% 62%; }
            100% { border-radius: 53% 47% 38% 62% / 53% 58% 42% 47%; }
        }

        /* Layout Sections */
        .section-padding { padding: 100px 7%; }
        .bg-soft-mocha { background-color: rgba(93, 64, 55, 0.05); }

        .img-custom-rounded {
            border-radius: 30px 100px 30px 100px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 500px;
            object-fit: cover;
        }

        @media (max-width: 992px) {
            .hero-container { flex-direction: column; text-align: center; padding-top: 130px; }
            .hero-content { padding-right: 0; margin-bottom: 50px; }
            .heading-playfair { font-size: 2.8rem; }
            .text-mocha { margin: 0 auto 30px; }
            .section-row { flex-direction: column !important; text-align: center; }
            .section-text { padding-top: 40px; padding-left: 0 !important; padding-right: 0 !important;}
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">
                ☕ JEJAK RASA
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
                        <a href="<?= site_url('Home/keranjang'); ?>" class="btn btn-gold btn-sm px-3 shadow-sm">
                            🛒 (<?= $total_keranjang; ?>)
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <div class="d-flex align-items-center">
                            <?php if($this->session->userdata('id_user')): ?>
                                <a href="<?= site_url('Auth/logout'); ?>" class="btn btn-danger btn-sm fw-bold w-100">Logout</a>
                            <?php else: ?>
                                <a href="<?= site_url('Auth'); ?>" class="btn btn-primary btn-sm fw-bold shadow-sm w-100">Login</a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-container">
        <div class="bg-circle"></div>
        <div class="hero-content">
            <h1 class="heading-playfair">Jejak Rasa,<br>Cerita Dalam Secangkir.</h1>
            <p class="text-mocha">Nikmati harmoni rasa kopi pilihan yang diproses dengan sepenuh hati. Setiap tetesnya adalah perjalanan rasa yang tak terlupakan, membangunkan semangat di setiap pagi.</p>
            <a href="<?= site_url('Home/menu'); ?>" class="btn-coffee">Jelajahi Menu</a>
        </div>
        <div class="hero-visual">
            <div class="liquid-border-wrapper">
                <video autoplay loop muted playsinline>
                    <source src="<?= base_url('assets/uploads/kopigif.mp4'); ?>" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
        </div>
    </header>

    <section class="section-padding bg-soft-mocha">
        <div class="container">
            <div class="row align-items-center section-row">
                <div class="col-lg-6 text-center">
                    <img src="<?= base_url('assets/uploads/kopitangan.jpeg'); ?>" alt="Kopi di tangan" class="img-fluid img-custom-rounded">
                </div>
                <div class="col-lg-6 section-text ps-lg-5">
                    <h2 class="heading-playfair fs-1">Kualitas Dalam <span style="color: var(--caramel);">Genggaman</span></h2>
                    <p class="text-mocha mb-4">
                        Dari pemilihan biji kopi *single origin* terbaik hingga proses *roasting* yang dijaga presisi suhunya, semuanya kami lakukan agar kehangatan meresap ke telapak tangan Anda.
                    </p>
                    <p class="text-mocha fw-bold">
                        "Sentuh teksturnya, rasakan aromanya yang memikat, dan biarkan tegukan pertama menjelaskan semuanya tanpa kata-kata."
                    </p>
                    <a href="<?= site_url('Home/menu'); ?>" class="text-decoration-none fw-bold" style="color: var(--espresso); border-bottom: 2px solid var(--caramel);">Cari Kopi Favoritmu &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center section-row flex-row-reverse">
                <div class="col-lg-6 text-center pb-4 pb-lg-0">
                    <div class="liquid-border-wrapper">
                        <video autoplay loop muted playsinline>
                            <source src="<?= base_url('assets/uploads/testimoni.mp4'); ?>" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>
                </div>
                <div class="col-lg-6 section-text pe-lg-5">
                    <h2 class="heading-playfair fs-1">Mereka yang Telah <span style="color: var(--caramel);">Mencicipi</span></h2>
                    <p class="text-mocha">
                        Bukan sekadar kafein pembangun mata, ini adalah ruang bagi inspirasi. Dengarkan langsung cerita manis (dan sedikit pahit yang dirindukan) dari mereka yang telah menjadikan Jejak Rasa teman setianya.
                    </p>
                    <div class="mt-4 p-4 rounded-4" style="background-color: var(--white); border-left: 4px solid var(--caramel); box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <p class="mb-0 fst-italic text-muted">"Setiap seduhannya selalu konsisten. Bikin *mood* kerja naik drastis. Nggak pernah nyesel langganan di sini!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 text-center" style="background-color: var(--espresso); color: rgba(248, 245, 242, 0.7);">
        <div class="container">
            <p class="mb-0 small">&copy; <?= date('Y'); ?> Jejak Rasa Kopi. Diracik dengan sepenuh hati oleh Iqbal.</p>
        </div>
    </footer>

</body>
</html>