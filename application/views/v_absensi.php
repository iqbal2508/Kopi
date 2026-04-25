<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; padding-top: 80px;}
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; border-bottom: 1px solid #4A2C2A;}
        
        .streak-card {
            background: linear-gradient(135deg, #4A2C2A, #33211D);
            border-radius: 20px; padding: 40px; border: 2px dashed #C08261;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4); max-width: 700px; margin: 0 auto;
        }

        .day-circle {
            width: 70px; height: 70px; border-radius: 50%;
            background-color: #1e1311; border: 3px solid #6F4E37;
            display: flex; align-items: center; justify-content: center; flex-direction: column;
            transition: 0.3s; position: relative;
        }

        .day-circle span { font-size: 0.7rem; font-weight: bold; position: absolute; bottom: -25px; color: #C08261;}
        .day-circle i { font-size: 1.5rem; }

        .streak-active { background-color: #C08261; border-color: #F8F5F2; box-shadow: 0 0 15px rgba(192, 130, 97, 0.5); }
        .streak-reward { border-color: #FFD700; background-color: #4A2C2A;}
        .streak-reward.streak-active { background-color: #FFD700; color: #000; box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);}
        
        .btn-checkin { background-color: #28a745; border: none; font-weight: bold; font-size: 1.2rem; border-radius: 50px; }
        .btn-checkin:disabled { background-color: #6c757d; cursor: not-allowed; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa</a>
            <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm">Ke Menu Utama</a>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h2 class="fw-bold mb-2" style="color: #C08261;">📅 Absensi Ngopi</h2>
        <p class="text-light opacity-75 mb-5">Check-in setiap hari tanpa terputus untuk mendapatkan hadiah menarik!</p>

        <div class="streak-card">
            <?php 
                $streak = $user['login_streak'];
                $today = date('Y-m-d');
                $sudah_checkin_hari_ini = ($user['last_checkin'] == $today);
            ?>

            <?php if($streak >= 7): ?>
                <div class="py-4">
                    <h1 class="display-1 mb-3">🎉</h1>
                    <h2 class="fw-bold text-warning">Selamat!</h2>
                    <h4 class="text-light">Kamu sudah check-in semuanya dengan selamat!</h4>
                    <p class="text-light opacity-75 mt-3">Cek halaman voucher untuk menggunakan hadiah utamamu.</p>
                </div>
            <?php else: ?>
               <div class="d-flex justify-content-center flex-wrap gap-4 mb-5">
    <?php for($i = 1; $i <= 7; $i++): ?>
        <?php 
            $is_active = ($i <= $streak) ? 'streak-active' : '';
            $is_reward = ($i == 1 || $i == 4 || $i == 7) ? 'streak-reward' : '';
            
            // Logika Konten (Tulisan vs Ikon)
            if ($i == 1) {
                $content = "5%";
            } elseif ($i == 4) {
                $content = "10%";
            } elseif ($i == 7) {
                $content = "GRATIS";
            } else {
                $content = ($i <= $streak) ? '✔️' : '📅';
            }
        ?>
        <div class="day-circle <?= $is_active ?> <?= $is_reward ?>">
            <b style="font-size: <?= ($i == 7) ? '0.75rem' : '1.1rem' ?>;"><?= $content ?></b>
            <span>Hari <?= $i ?></span>
        </div>
    <?php endfor; ?>
</div>

                <h5 class="fw-bold text-warning mb-4">Streak Saat Ini: <?= $streak; ?> Hari</h5>

                <button id="btnCheckin" class="btn btn-success btn-checkin py-3 px-5 w-100 shadow" <?= $sudah_checkin_hari_ini ? 'disabled' : '' ?>>
                    <?= $sudah_checkin_hari_ini ? '✅ Sudah Check-in Hari Ini' : '👇 Check-in Sekarang' ?>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.getElementById('btnCheckin')?.addEventListener('click', function() {
            let btn = this;
            btn.innerHTML = 'Memproses...';
            btn.disabled = true;

            fetch("<?= site_url('Home/proses_checkin') ?>")
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    if(data.hadiah) {
                        Swal.fire({
                            title: 'MANTAP! 🥳',
                            text: `Kamu mencapai Hari ke-${data.streak} dan mendapatkan: ${data.hadiah}!`,
                            icon: 'success',
                            confirmButtonText: 'Ambil Hadiah'
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Absen hari ini tercatat. Jangan lupa kembali besok!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    }
                } else if(data.status === 'completed') {
                    Swal.fire({
                        title: 'Selamat!',
                        text: 'Kamu sudah check-in semuanya dengan selamat!',
                        icon: 'info'
                    }).then(() => location.reload());
                } else if(data.status === 'already') {
                    // Alert jika murni sudah checkin hari ini
                    Swal.fire('Oops!', 'Kamu sudah check-in hari ini kok. Kembali lagi besok ya!', 'info')
                    .then(() => location.reload());
                } else {
                    // Menangkap ERROR SISTEM (seperti sesi habis)
                    Swal.fire('Gagal Memproses', data.message, 'error')
                    .then(() => location.reload());
                }
            });
        });
    </script>
</body>
</html>