<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce Otomotif</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- Kustomisasi Warna Sesuai Request --- */
        :root {
            --warna-hitam: #1a1a1a;        /* Dasar Navbar */
            --warna-kawasaki: #69BE28;     /* Hijau */
            --warna-honda: #DC002E;        /* Merah */
            --warna-suzuki: #003DA5;       /* Biru */
        }

        .bg-custom-black {
            background-color: var(--warna-hitam);
        }

        /* Warna teks menu normal */
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255, 0.8);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* Efek Hover dengan warna-warni motor */
        .nav-item:nth-child(1) .nav-link:hover { color: var(--warna-kawasaki); } /* Beranda jadi Hijau */
        .nav-item:nth-child(2) .nav-link:hover { color: var(--warna-honda); }    /* Sparepart jadi Merah */
        .nav-item:nth-child(3) .nav-link:hover { color: var(--warna-suzuki); }   /* Aksesoris jadi Biru */
        .nav-item:nth-child(4) .nav-link:hover { color: #ffffff; text-decoration: underline; } /* Jasa */

        /* Supaya Dropdown User ada di pojok kanan */
        .navbar-nav.ms-auto {
            margin-left: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-black py-3">
        <div class="container">
            
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-motorcycle text-white"></i> MOTO-SHOP
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sparepart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Aksesoris</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownJasa" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Jasa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownJasa">
                            <li><a class="dropdown-item" href="#">Service Motor</a></li>
                            <li><a class="dropdown-item" href="#">Cuci Motor</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Jasa Modifikasi Motor</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-light text-dark rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 30px; height: 30px;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            Halo, User
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>