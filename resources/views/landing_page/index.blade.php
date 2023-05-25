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
                            @foreach ($saranas as $item)
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
                                                <p class="mb-0 text-500">Status</p>
                                            </div>
                                            <h3 class="fw-normal fs-lg-1 fs-xxl-2 lh-sm mt-3">
                                                {{ $item->nama_sarana_prasarana }}</h3><a
                                                class="text-secondary stretched-link">Pinjam</a>
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




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('landing_page/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('landing_page/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ 'landing_page/js/theme.js' }}"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&amp;family=Rubik:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
</body>

</html>
