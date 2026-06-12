<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            background-color: #F5EFE6 !important;
            color: #3e2723;
        }
        .navbar-kopi {
            background-color: #3e2723 !important;
        }
        .card-kopi {
            border: none;
            border-top: 5px solid #5D4037;
            border-radius: 8px;
        }
        .bg-espresso { background-color: #3e2723; color: #fff; }
        .bg-mocha { background-color: #5D4037; color: #fff; }
        .bg-latte { background-color: #8D6E63; color: #fff; }
        .navbar-kopi .navbar-brand {
            color: #F5EFE6 !important;
        }
        .navbar-kopi .navbar-brand:hover {
            color: #ffffff !important;
        }
        /* Style Tombol Reset Tema Kopi Muted */
        .btn-kopi-reset {
            background-color: #bcaaa4;
            border-color: #bcaaa4;
            color: #3e2723;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-kopi-reset:hover {
            background-color: #8D6E63;
            border-color: #8D6E63;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-kopi shadow-sm mb-4 p-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= site_url('Admin/laporan'); ?>">⬅️ Kembali ke Laporan</a>
            <span class="text-white">Statistik & Grafik Penjualan UMKM Kopi</span>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm bg-espresso rounded">
                    <h6>💰 Omset Bulan Ini</h6>
                    <h3 id="txt-omset">Rp 4.250.000</h3>
                    <small class="text-white-50">Meningkat 12% dari bulan lalu</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm bg-mocha rounded">
                    <h6>☕ Total Kopi Terjual</h6>
                    <h3 id="txt-terjual">185 Cup</h3>
                    <small class="text-white-50">Menu terlaris: Es Kopi Susu Latte</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm bg-latte rounded">
                    <h6>👥 Transaksi Pelanggan</h6>
                    <h3 id="txt-transaksi">42 Transaksi</h3>
                    <small class="text-white-50">Rata-rata rating kepuasan: 4.8/5</small>
                </div>
            </div>
        </div>

        <div class="card p-4 shadow-sm card-kopi mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0" style="color: #3e2723;">📈 Tren Grafik Penjualan Bulanan</h5>
                <button id="resetChartBtn" class="btn btn-sm btn-kopi-reset px-3 py-2 shadow-sm">🔄 Reset Grafik Jadi 0</button>
            </div>
            
            <div style="position: relative; height:40vh; width:100%">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi awal Grafik
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                    label: 'Pendapatan Penjualan (Rp)',
                    data: [1800000, 2400000, 2100000, 3500000, 3900000, 4250000],
                    backgroundColor: 'rgba(93, 64, 55, 0.2)',
                    borderColor: '#3e2723',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#5D4037',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#EFEBE9' },
                        ticks: { color: '#3e2723', font: { weight: 'bold' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#3e2723', font: { weight: 'bold' } }
                    }
                },
                plugins: {
                    legend: {
                        labels: { color: '#3e2723', font: { size: 13, weight: 'bold' } }
                    }
                }
            }
        });

        // Logika Aksi klik Tombol Reset
        document.getElementById('resetChartBtn').addEventListener('click', function() {
            // Menampilkan konfirmasi pop-up sebelum eksekusi reset
            if (confirm('Apakah Anda yakin ingin mereset semua data grafik menjadi 0?')) {
                
                // 1. Ubah array data Chart menjadi nol semua [0,0,0,0,0,0]
                salesChart.data.datasets[0].data = [0, 0, 0, 0, 0, 0];
                
                // 2. Update/refresh grafik secara halus dengan animasi bawaan Chart.js
                salesChart.update();

                // 3. Opsional: Mengubah angka ringkasan card di atas agar ikut menjadi 0
                document.getElementById('txt-omset').innerText = 'Rp 0';
                document.getElementById('txt-terjual').innerText = '0 Cup';
                document.getElementById('txt-transaksi').innerText = '0 Transaksi';
            }
        });
    </script>
</body>
</html>