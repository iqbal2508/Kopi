<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; padding-top: 80px;}
        .navbar-coffee { background-color: rgba(74, 44, 42, 0.95) !important; border-bottom: 1px solid #4A2C2A;}
        
        /* Area Game */
        .game-container { text-align: center; margin-top: 20px; }
        .wheel-wrapper { position: relative; width: 320px; height: 320px; margin: 0 auto; }
        
        /* Kanvas Roda */
        canvas { border-radius: 50%; box-shadow: 0 0 20px rgba(192, 130, 97, 0.4); border: 8px solid #4A2C2A; }
        
        /* Jarum Penunjuk */
        .pointer {
            position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
            width: 0; height: 0;
            border-left: 20px solid transparent; border-right: 20px solid transparent; border-top: 35px solid #F8F5F2;
            z-index: 10; filter: drop-shadow(0 4px 4px rgba(0,0,0,0.5));
        }

        .btn-spin { background-color: #C08261; color: white; font-weight: 700; border-radius: 50px; padding: 12px 40px; font-size: 1.2rem; border: none; margin-top: 30px; transition: 0.3s; box-shadow: 0 6px 15px rgba(192, 130, 97, 0.4); }
        .btn-spin:hover { background-color: #A0694A; transform: translateY(-3px); }
        .btn-spin:disabled { background-color: #666; cursor: not-allowed; box-shadow: none; transform: none; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-coffee fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa</a>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light btn-sm">Kembali ke Katalog</a>
            </div>
        </div>
    </nav>

    <div class="container game-container">
        <h2 class="fw-bold mb-2" style="color: #C08261;">Roda Keberuntungan</h2>
        
        <?php if($user['jatah_spin'] > 0): ?>
            <p class="mb-4">Kamu memiliki <strong>1 Kesempatan</strong> memutar roda. Putar sekarang dan menangkan kejutan spesial!</p>
            
            <div class="wheel-wrapper">
                <div class="pointer"></div>
                <canvas id="wheel" width="300" height="300"></canvas>
            </div>
            
            <button id="spinBtn" class="btn-spin">🎯 Putar Roda</button>
            <p id="pesanLoading" class="mt-3 text-warning fw-bold d-none">Sedang mengundi nasibmu...</p>

        <?php else: ?>
            <div class="alert mt-5 py-5" style="background-color: #4A2C2A; border-radius: 20px;">
                <h1 class="display-1 mb-3">🎁</h1>
                <h4>Kesempatanmu sudah habis!</h4>
                <p class="text-muted">Hadiah yang kamu dapatkan sebelumnya:</p>
                <h3 class="fw-bold text-warning"><?= $user['hadiah_game']; ?></h3>
                <a href="<?= site_url('Home/menu'); ?>" class="btn btn-outline-light mt-4">Lanjut Belanja</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if($user['jatah_spin'] > 0): ?>
    <script>
        const canvas = document.getElementById("wheel");
        const ctx = canvas.getContext("2d");
        const spinBtn = document.getElementById("spinBtn");
        const pesanLoading = document.getElementById("pesanLoading");

        // Data Hadiah & Warna Tema Kopi
        const segments = ["Diskon 10%", "Zonk!", "Kopi Gratis", "Diskon 20%", "Zonk!", "Voucher 10rb"];
        const colors = ["#C08261", "#4A2C2A", "#6F4E37", "#C08261", "#4A2C2A", "#6F4E37"];
        
        let currentAngle = 0;
        let isSpinning = false;
        
        // Fungsi Menggambar Roda
        function drawWheel() {
            const numSegments = segments.length;
            const anglePerSegment = (Math.PI * 2) / numSegments;
            const centerX = canvas.width / 2;
            const centerY = canvas.height / 2;
            const radius = centerX;

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < numSegments; i++) {
                const angle = currentAngle + i * anglePerSegment;
                
                // Gambar Potongan Kue (Segmen)
                ctx.beginPath();
                ctx.moveTo(centerX, centerY);
                ctx.arc(centerX, centerY, radius, angle, angle + anglePerSegment);
                ctx.fillStyle = colors[i];
                ctx.fill();
                ctx.stroke();

                // Tulis Teks Hadiah
                ctx.save();
                ctx.translate(centerX, centerY);
                ctx.rotate(angle + anglePerSegment / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = "#fff";
                ctx.font = "bold 16px Poppins";
                ctx.fillText(segments[i], radius - 20, 5);
                ctx.restore();
            }
        }

        drawWheel(); // Gambar roda pertama kali

        // Fungsi Memutar Roda
        spinBtn.addEventListener("click", () => {
            if (isSpinning) return;
            isSpinning = true;
            spinBtn.disabled = true;
            pesanLoading.classList.remove('d-none');

            // Logika Putaran (Acak kecepatan dan durasi)
            let spinAngleStart = Math.random() * 10 + 20; 
            let spinTime = 0;
            let spinTimeTotal = Math.random() * 3 + 4 * 1000; // Putar 4 detik

            function rotateWheel() {
                spinTime += 30;
                if (spinTime >= spinTimeTotal) {
                    stopRotateWheel();
                    return;
                }
                // Perlambatan halus
                let spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
                currentAngle += (spinAngle * Math.PI / 180);
                drawWheel();
                requestAnimationFrame(rotateWheel);
            }

            function easeOut(t, b, c, d) {
                let ts = (t /= d) * t;
                let tc = ts * t;
                return b + c * (tc + -3 * ts + 3 * t);
            }

            rotateWheel();
        });

        // Saat Roda Berhenti
        function stopRotateWheel() {
            pesanLoading.innerText = "Menyimpan hadiahmu...";
            
            const numSegments = segments.length;
            const anglePerSegment = (Math.PI * 2) / numSegments;
            
            // Hitung posisi jarum (Jarum ada di atas / 270 derajat)
            let degrees = currentAngle * 180 / Math.PI + 90; 
            let arcd = anglePerSegment * 180 / Math.PI;
            let index = Math.floor((360 - degrees % 360) / arcd);
            
            let hadiahDidapat = segments[index];

            // Kirim data secara diam-diam ke PHP (AJAX Fetch API)
            fetch("<?= site_url('Home/klaim_hadiah') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "hadiah=" + encodeURIComponent(hadiahDidapat)
            })
            .then(response => response.json())
            .then(data => {
                alert("Roda Berhenti! Kamu mendapatkan: " + hadiahDidapat);
                window.location.reload(); // Refresh halaman agar tampilkan blok "Kesempatan Habis"
            });
        }
    </script>
    <?php endif; ?>

</body>
</html>