<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Eduprix | Free Bootstrap 5 Responsive &amp; Business Templatee</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('landing_page/vendors/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing_page/css/user.css') }}" rel="stylesheet" />

    <link href="{{ asset('landing_page/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main>
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-0">

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-6">
                            <h1 class="header-title display-4 header text-center">RECENT BLOGPOST</h1>
                        </div>
                        <div class="row">
                            @foreach ($bukus as $item)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <div class="card border-100 h-100 shadow">
                                        <div class="card-body p-4 h-100">
                                            @if ($item->photo !== null)
                                                <img class="w-100"
                                                    src="{{ asset('storage/images/' . $item->tipe . '/' . $item->photo) }}"
                                                    alt="" />
                                            @else
                                                <img class="w-100"
                                                    src="{{ asset('landing_page/img/gallery/collectives.png') }}"
                                                    alt="" />
                                            @endif
                                            <div
                                                class="d-flex justify-content-between mt-3 border-bottom border-100 py-2">
                                                <span
                                                    class="badge bg-soft-info rounded-1 text-info fw-normal p-2">{{ $item->kategori->nama_kategori }}</span>
                                                <p class="mb-0 text-500">{!! $item->status_tersedia == 1 ? 'Tersedia' : 'Dipinjam'!!}</p>
                                            </div>
                                            <h3 class="fw-normal fs-lg-1 fs-xxl-2 lh-sm mt-3">
                                                {{ $item->nama_buku }}</h3>
                                            @if (Route::has('login'))
                                                @auth
                                                    <button type="button" class="btn-sm btn-rounded btn-primary text-dark"
                                                        onclick="document.getElementById('buku_id').value ='{{ $item->id }}'"
                                                        data-toggle="modal" data-target="#modalPinjam">Pinjam</button>
                                                @else
                                                    <button type="button" class="btn-sm btn-rounded btn-primary text-dark"
                                                        data-toggle="modal" data-target="#modalLogin">Pinjam</button>
                                                @endauth
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->


          
        </section>

        <!-- <section> close ============================-->
        <!-- ============================================-->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&amp;family=Rubik:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    @include('layouts.scripts.sweetalert')
    @include('landing_page.modal_login')
    @include('landing_page.modal_pinjam')
</body>

</html>
