<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Manajemen Penjualan</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --tosca: #2ab7a9;
            --tosca-dark: #229e92;
            --light-bg: #e6f7f5;
            --white: #ffffff;
            --text-dark: #2c3e50;
            --gray: #6c757d;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .navbar {
            background-color: var(--tosca);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: var(--white);
            font-weight: 600;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-nav .nav-link {
            color: var(--white);
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link:focus {
            color: #d9f5f2;
        }

        .navbar-toggler {
            border-color: var(--white);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-nav .nav-item.dropdown > .nav-link {
            cursor: pointer;
            user-select: none;
        }

        .dropdown-menu {
            background-color: var(--white);
            min-width: 180px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
        }

        .dropdown-item:hover, 
        .dropdown-item:focus {
            background-color: var(--tosca);
            color: var(--white);
        }

        .navbar-nav {
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .nav-link.dropdown-toggle::after {
            margin-left: 0.3em;
            vertical-align: 0.1em;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-left: 0.3em solid transparent;
            content: "";
            display: inline-block;
        }

        @media (max-width: 992px) {
            .dropdown-menu {
                position: static;
                float: none;
                box-shadow: none;
                background-color: transparent;
                border: none;
                padding-left: 1rem;
            }

            .dropdown-item:hover, 
            .dropdown-item:focus {
                background-color: var(--light-bg);
                color: var(--text-dark);
            }
        }

        main.container.my-4 {
            color: var(--text-dark);
        }

        footer {
            margin-top: auto;
            background-color: var(--white);
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
            color: var(--gray);
            box-shadow: 0 -2px 5px rgba(0,0,0,0.05);
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .text-muted {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-store"></i> MLXVII
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Data Utama -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="masterDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Utama
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                            <li><a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a></li>
                            <li><a class="dropdown-item" href="{{ route('barang.index') }}">Barang</a></li>
                            <li><a class="dropdown-item" href="{{ route('pembeli.index') }}">Pembeli</a></li>
                            <li><a class="dropdown-item" href="{{ route('supplier.index') }}">Supplier</a></li>
                        </ul>
                    </li>

                    <!-- Transaksi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="transaksiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transaksi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="transaksiDropdown">
                            <li><a class="dropdown-item" href="{{ route('pembelian.index') }}">Pembelian</a></li>
                            <li><a class="dropdown-item" href="{{ route('penjualan.index') }}">Penjualan</a></li>
                        </ul>
                    </li>
                </ul>

                @auth
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">👤 {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer>
        &copy; 2025 MLXVII. Semua hak dilindungi.
    </footer>

    <!-- Toast Notification -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            @if (session('success'))
                <div class="toast align-items-center text-white bg-success border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="toast align-items-center text-white bg-danger border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- jQuery (WAJIB untuk semua script dengan $) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS + Toast Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl, { delay: 3000 });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>

    @stack('scripts')
</body>
</html>
