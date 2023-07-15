<!DOCTYPE html>
<!-- saved from url=(0033)https://www.shop.semicolon.my.id/ -->
<html lang="en" data-bs-theme="auto">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
<link type="text/css" rel="stylesheet" id="dark-mode-general-link">
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>E-Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="{{ asset('landing_page/css2') }}" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">
    <link rel="icon" href="https://www.shop.semicolon.my.id/assets/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('landing_page/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">
    <link rel="stylesheet" href="{{ asset('landing_page/app.css') }}">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-isi">

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light fixed-top bg-header">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">E-Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('dashboard.') }}"
                                    class="nav-link text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)"
                                    onclick="event.preventDefault();document.getElementById('form-logout').submit();"
                                    class="nav-link text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                                <form action="{{ route('logout') }}" method="post" id="form-logout">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalLogin"
                                    class="nav-link text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                            </li>
                        @endauth
                    @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav> <!-- End Navbar -->

    <!-- Content -->
    <main class="container">

        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                Kategori:
                                <strong>
                                    @if (!$queryKategori)
                                        Semua Kategori
                                    @else
                                        {{ $queryKategori }}
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($bukus->count() > 0)
                        @foreach ($bukus as $item)
                            <!-- Card Komponen -->
                            <div class="col-md-6 card-group">
                                <div class="card mb-3">
                                    @if ($item->sampul_buku !== null)
                                        <img src="{{ url('storage/img/sampul_buku/' . $item->sampul_buku . '') }}"
                                            alt="gambar" height="200px" class="card-img-top mt-2">
                                    @else
                                        <img src="{{ url('images/buku.webp') }}" alt="gambar" height="200px"
                                            class="card-img-top mt-2">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $item->nama_buku }}</h5>
                                        <br />
                                        <p class="badge bg-primary"><i class="fas fa-tags"></i>
                                            {{ $item->kategori->nama_kategori }}</p>
                                        @if ($item->status_tersedia == 1)
                                            <p class="card-text badge bg-success"> Tersedia</p>
                                        @else
                                            <p class="card-text badge bg-danger"> Dipinjam</p>
                                            <h6 class="card-text">Tanggal Berakhir Peminjaman
                                                {{ $item->peminjaman->tanggal_pengembalian }}</h6>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        @if (Route::has('login'))
                                            @auth
                                                <button type="button" class="btn btn-sm btn-rounded btn-info"
                                                    onclick="document.getElementById('buku_id').value ='{{ $item->id }}';document.getElementById('nama_buku').value ='{{ $item->nama_buku }}'"
                                                    data-bs-toggle="modal" data-bs-target="#modalPinjam">Pinjam</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-rounded btn-info"
                                                    data-bs-toggle="modal" data-bs-target="#modalLogin">Pinjam</button>
                                            @endauth
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- End Card Komponen -->
                        @endforeach
                    @else
                        <strong>Buku Tidak Ditemukan</strong>
                    @endif
                </div>
                <hr/>
                <nav aria-label="Page navigation example" class="justify-content-center">
                    <ul class="pagination justify-content-center">
                    {{ $bukus->links() }}
                    </ul>
                </nav>
                <hr/>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">Pencarian</div>
                            <div class="card-body">
                                <form action="{{ route('landing') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" value="{{ $queryKeyword }}" class="form-control"
                                            name="keyword" placeholder="Cari">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary mx-1" type="submit"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">Kategori</div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="{{ route('landing') }}">Semua Kategori</a>
                                </li>
                                <form action="" method="get">
                                    @foreach ($kategoris as $kategori)
                                        <li class="list-group-item">
                                            <input type="submit" name="kategori"
                                                value="{{ $kategori->nama_kategori }}">
                                        </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> <!-- End Content -->

    <script>
        // Cek apakah elemen dengan ID 'autoCloseAlert' ada sebelum mengakses properti classList
        var alertElement = document.getElementById('autoCloseAlert');
        if (alertElement !== null) {
            // Auto close the alert after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                alertElement.classList.remove('show');
                alertElement.classList.add('hide');
                setTimeout(function() {
                    alertElement.remove();
                }, 500);
            }, 5000);
        }
    </script>
    <script>
        function validasiQty(input) {
            if (input.value < 0) {
                input.value = 0; // Mengatur nilai input menjadi 0 jika nilainya kurang dari 0
            }
        }
    </script>

    <script src="{{ asset('landing_page/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('landing_page/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/app.js') }}"></script>

    @include('layouts.scripts.sweetalert')
    @include('landing_page.modal_login')
    @include('landing_page.modal_pinjam')
</body>

</html>
