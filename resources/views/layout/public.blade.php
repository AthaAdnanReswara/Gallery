<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>WokaGallery - @yield('title','Home')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href={{asset('index/assets/img/logo-woka.png')}} rel="icon">
    <link href="index/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Cardo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ asset('index/assets/vendor/bootstrap/css/bootstrap.min.css')}} rel="stylesheet">
    <link href={{ asset('index/assets/vendor/bootstrap-icons/bootstrap-icons.css')}} rel="stylesheet">
    <link href={{ asset('index/assets/vendor/aos/aos.css')}} rel="stylesheet">
    <link href={{ asset('index/assets/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">
    <link href={{ asset('index/assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('index/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: PhotoFolio
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        /* Floating Action Button */
        .fab-add {
            position: fixed;
            bottom: 80px;
            right: 10px;
            width: 60px;
            height: 60px;
            background-color: #0d6efd;
            /* bootstrap primary */
            color: #fff;
            border-radius: 50%;
            font-size: 26px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            z-index: 9999;
            transition: all 0.3s ease;
        }

        .fab-add:hover {
            background-color: #084298;
            transform: scale(1.08);
            color: #fff;
        }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between" style="margin: 0px 70px;">
            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="index/assets/img/logo.png" alt=""> -->
                <img src="{{ asset('index/assets/img/logo-woka.png') }}" alt="">
                <h1 class="sitename">WokaGallery</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('public.index') }}" class="{{ request()->routeIs('public.index') ? 'active' : '' }}">Home<br></a></li>
                    <li><a href="{{ route('public.about') }}" class="{{ request()->routeIs('public.about') ? 'active' : '' }}">About</a></li>
                    <li class="dropdown">
                        <a href="#">
                            <span>Gallery</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('public.index') }}">All</a>
                            </li>

                            @foreach($albums as $album)
                            <li>
                                <a href="{{ route('album.show', $album->slug) }}">
                                    {{ $album->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <div class="header-social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </header>
    <main class="main">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed"
            style="bottom:20px; right:20px; z-index:9999">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">WokaGallery</strong> <span>2025</span></p>
            </div>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="#">Atha Adnan Reswara</a>
            </div>
        </div>
    </footer>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="line"></div>
    </div>

    <!-- Floating Add Button -->
    <button
        class="fab-add d-flex align-items-center justify-content-center"
        title="Tambah Foto"
        data-bs-toggle="modal"
        data-bs-target="#uploadPhotoModal">
        <i class="bi bi-plus-lg"></i>
    </button>

    <!-- Modal Upload Foto Publik -->
    <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form
                action="{{ route('photo.upload.public') }}"
                method="POST"
                enctype="multipart/form-data"
                class="modal-content">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Upload Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- VALIDASI ERROR --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Pilih Album</label>
                        <select name="album_id" class="form-select" required>
                            <option value="">-- Pilih Album --</option>
                            @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="photo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Caption</label>
                        <textarea name="caption" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama (opsional)">
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email (opsional)">
                    </div>

                    <small class="text-muted">
                        Foto akan tampil setelah disetujui admin
                    </small>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Vendor JS Files -->
    <script src={{ asset('index/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('index/assets/vendor/php-email-form/validate.js') }}></script>
    <script src={{ asset('index/assets/vendor/aos/aos.js') }}></script>
    <script src={{ asset('index/assets/vendor/glightbox/js/glightbox.min.js') }}></script>
    <script src={{ asset('index/assets/vendor/swiper/swiper-bundle.min.js') }}></script>

    <!-- Main JS File -->
    <script src={{ asset('index/assets/js/main.js') }}></script>
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let modal = new bootstrap.Modal(
                document.getElementById('uploadPhotoModal')
            );
            modal.show();
        });
    </script>
    @endif

</body>

</html>