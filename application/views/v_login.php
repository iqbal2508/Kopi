<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jejak Rasa Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Mengubah warna background menjadi krem lembut khas cafe */
        body {
            background-color: #f8f5f2;
        }
        /* Membuat warna tombol cokelat kopi */
        .btn-coffee {
            background-color: #6F4E37; 
            border-color: #6F4E37;
            color: white;
            transition: 0.3s;
        }
        .btn-coffee:hover {
            background-color: #5a3f2c;
            border-color: #5a3f2c;
            color: white;
        }
        .text-coffee {
            color: #6F4E37;
        }
        /* Memperhalus lengkungan kotak */
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body class="d-flex align-items-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        
                        <div class="text-center mb-4">
                            <h1 class="display-4 mb-2">☕</h1>
                            <h4 class="fw-bold text-dark">Jejak Rasa Kopi</h4>
                            <p class="text-muted small">Silakan masuk ke akun Anda</p>
                        </div>
                        
                        <?= $this->session->flashdata('pesan'); ?>

                        <form action="<?= site_url('Auth/proses_login'); ?>" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Alamat Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            
                            <button type="submit" class="btn btn-coffee w-100 fw-bold py-2 mb-4">Masuk</button>
                        </form>
                        
                        <div class="text-center border-top pt-3">
                            <p class="text-muted small mb-0">Belum punya akun? 
                                <a href="<?= site_url('Auth/registrasi'); ?>" class="text-decoration-none fw-bold text-coffee">Daftar di sini</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>