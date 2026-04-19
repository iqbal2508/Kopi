<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #33211D; color: #F8F5F2; padding-top: 80px;}
        .timer-display { font-family: 'Orbitron', sans-serif; font-size: 6rem; color: #C08261; text-shadow: 0 0 20px rgba(192, 130, 97, 0.5); margin: 40px 0; }
        .btn-stop { background-color: #D25345; color: white; font-weight: 700; border-radius: 50%; width: 150px; height: 150px; border: 8px solid #4A2C2A; font-size: 1.5rem; transition: 0.2s; }
        .btn-stop:active { transform: scale(0.9); }
        .btn-start { background-color: #28a745; color: white; padding: 15px 40px; border-radius: 50px; font-weight: bold; border: none; font-size: 1.2rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-4" style="background: rgba(74,44,42,0.9);">
        <a class="navbar-brand fw-bold" href="<?= site_url('Home'); ?>">☕ Jejak Rasa</a>
    </nav>

    <div class="container text-center mt-4">
        <h2 class="fw-bold">⏱️ 10-Second Pause Challenge</h2>
        <p class="opacity-75">Berhenti tepat di angka <strong>10:00</strong> untuk menang!</p>
        <p class="badge bg-warning text-dark px-3 py-2 fs-6">Sisa Kesempatan: <span id="sisaJatah"><?= $user['jatah_10detik']; ?></span></p>

        <div class="timer-display" id="timer">00:00</div>

        <div id="gameControl">
            <?php if($user['jatah_10detik'] > 0): ?>
                <button id="btnStart" class="btn-start shadow">MULAI GAME</button>
                <button id="btnStop" class="btn-stop shadow d-none">STOP!</button>
            <?php else: ?>
                <div class="alert alert-danger d-inline-block px-5 py-4 mt-4" style="border-radius: 20px; background: #4A2C2A;">
                    <h4 class="fw-bold">Jatah Kamu Habis!</h4>
                    <p class="mb-0">Coba keberuntunganmu di game lain atau kumpulkan kupon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let startTime, timerInterval;
        let running = false;
        const timerDisplay = document.getElementById('timer');
        const btnStart = document.getElementById('btnStart');
        const btnStop = document.getElementById('btnStop');
        const sisaJatahSpan = document.getElementById('sisaJatah');

        function updateTimer() {
            let currentTime = Date.now() - startTime;
            let seconds = Math.floor(currentTime / 1000);
            let milliseconds = Math.floor((currentTime % 1000) / 10);
            timerDisplay.innerText = 
                (seconds < 10 ? '0' + seconds : seconds) + ":" + 
                (milliseconds < 10 ? '0' + milliseconds : milliseconds);
        }

        btnStart.onclick = function() {
            fetch('<?= site_url('Home/gunakan_jatah_10s'); ?>') // Kurangi jatah di DB
            .then(res => res.json())
            .then(data => {
                sisaJatahSpan.innerText = parseInt(sisaJatahSpan.innerText) - 1;
                btnStart.classList.add('d-none');
                btnStop.classList.remove('d-none');
                startTime = Date.now();
                timerInterval = setInterval(updateTimer, 10);
            });
        };

        btnStop.onclick = function() {
            clearInterval(timerInterval);
            let finalTime = timerDisplay.innerText;
            
            if(finalTime === "10:00") {
                fetch('<?= site_url('Home/proses_menang_10s'); ?>')
                .then(() => {
                    Swal.fire({
                        title: 'JACKPOT! 🥳',
                        text: 'Selamat! Kamu mendapatkan 1 Kopi Gratis. Silakan gunakan saat Checkout.',
                        icon: 'success',
                        confirmButtonText: 'Ambil Hadiah'
                    }).then(() => location.reload());
                });
            } else {
                Swal.fire({
                    title: 'WADUH! 🙊',
                    text: 'Waktumu: ' + finalTime + '. Nyaris banget! Ayo coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'Ulangi'
                }).then(() => location.reload());
            }
        };
    </script>
</body>
</html>