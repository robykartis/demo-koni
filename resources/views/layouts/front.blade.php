<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeServices">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
    <title>{{ $title }}</title>
    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('berkas/profil/'.$profil->logo) }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontAwesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/lineIcons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owlCarousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>


</head>

<body class="home home-1">
    <!-- Start Preloader -->
    <div id="preloader">
        <div class="t-circle">
            <div class="t-circle1 t-child"></div>
            <div class="t-circle2 t-child"></div>
            <div class="t-circle3 t-child"></div>
            <div class="t-circle4 t-child"></div>
            <div class="t-circle5 t-child"></div>
            <div class="t-circle6 t-child"></div>
            <div class="t-circle7 t-child"></div>
            <div class="t-circle8 t-child"></div>
            <div class="t-circle9 t-child"></div>
            <div class="t-circle10 t-child"></div>
            <div class="t-circle11 t-child"></div>
            <div class="t-circle12 t-child"></div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Start Site Header -->
    <div class="height80"></div>
    <header class="site-header ">
        <div class="top-header style1">
            <div class="container">
                <div class="top-header-in">
                    <div class="top-header-right">
                        <ul class="header-social style1">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                        </ul>
                    </div>
                    <div class="top-header-left">
                        <div class="top-header-left">
                            <ul class="header-list style1">
                                <li><span class="list-title"><i class="fa fa-phone"></i></span><a href="#" class="info-title">{{ $profil->telp }}</a></li>
                            </ul>
                        </div>
                        <a href="#" class="t-btn"><i class="fa fa-envelope-o"></i> {{ $profil->email }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-wrap style1">
            <div class="container">
                <div class="header-in">
                    <div class="site-branding">
                        <!-- For Image Logo -->
                        <a href="{{ url('/') }}" class="custom-logo-link">
                            <img src="{{ asset('berkas/profil/'.$profil->logo) }}" alt="Image" class="custom-logo">
                        </a>
                        <!-- For Site Title -->
                        <span class="site-title">
                            <a href="{{ url('/') }}">{{ $profil->nama }}</a>
                        </span>
                    </div>
                    <nav class="primary-nav">
                        <div class="m-menu-btn" id="m-menu-btn"><span></span></div>
                        <ul class="primary-nav-list" id="primary-nav-list">

                            <li class="menu-item active"><a href="{{ url('/') }}">Home</a></li>
                            <li class="menu-item"><a href="{{ url('/berita') }}">Berita</a></li>
                            <li class="menu-item menu-item-has-children current-menu-ancestor current-menu-parent"><a href="#">Tentang Kami</a>
                                <ul>

                                    <li class="menu-item current-menu-item"><a href="{{ url('/tentang-kami/profil') }}">Profil</a></li>
                                    <li class="menu-item"><a href="{{ url('/tentang-kami/program-kerja') }}">Program Kerja</a></li>
                                    <li class="menu-item"><a href="{{ url('/tentang-kami/visi-misi') }}">Visi dan Misi</a></li>
                                    <li class="menu-item"><a href="{{ url('/tentang-kami/struktur-organisasi') }}">Struktur Organisasi</a></li>
                                    <li class="menu-item"><a href="{{ url('/tentang-kami/pengurus') }}">Pengurus</a></li>
                                    <li class="menu-item"><a href="{{ url('/tentang-kami/tupoksi') }}">Tupoksi Pengurus</a></li>

                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children current-menu-ancestor current-menu-parent"><a href="#">Induk Organisasi</a>
                                <ul>

                                    <li class="menu-item current-menu-item"><a href="{{ url('/induk-organisasi/cabang-olahraga') }}">Cabang Olahraga</a></li>
                                    <li class="menu-item"><a href="{{ url('/induk-organisasi/club') }}">Club/Binaan</a></li>
                                    <li class="menu-item"><a href="{{ url('/induk-organisasi/pelatih') }}">Pelatih</a></li>

                                    <li class="menu-item"><a href="{{ url('/induk-organisasi/atlit') }}">Atlit</a></li>
                                    <li class="menu-item"><a href="{{ url('/induk-organisasi/wasit') }}">Wasit</a></li>

                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children current-menu-ancestor current-menu-parent"><a href="#">Galeri</a>
                                <ul>

                                    <li class="menu-item current-menu-item"><a href="{{ url('/galeri-foto') }}">Galeri Foto</a></li>
                                    <li class="menu-item"><a href="{{ url('/galeri-video') }}">Galeri Video</a></li>


                                </ul>
                            </li>



                        </ul>
                    </nav>
                </div>
            </div><!-- .header-wrap -->
        </div>
    </header>
    <!-- End Site Header -->
    @yield('content')


    <!-- Start Footer Scetion -->
    <footer class="site-footer sticky-footer">
        <div class="site-footer-in">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2 class="footer-widget-title">Kontak Info</h2>
                            <div class="contact-info">
                                <span><i class="icon-basic_geolocalize-01"></i>{{ $profil->alamat }}</span>
                                <span><i class=" icon-device_iphone"></i>{{ $profil->telp }}</span>
                                <span><i class="icon-mail_envelope"></i><a href="#">{{ $profil->email }}</a></span>
                            </div>
                        </div>
                    </div><!-- .col -->
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2 class="footer-widget-title">Jam Operasional Kantor</h2>
                            <div class="business-hours">
                                <p>Operasional kantor kami tersedia untuk membantu Anda</p>
                                <ul>
                                    <li><span class="business-day">Senin - Jumat:</span><span class="business-time">08:00 - 16:00 Wib</span></li>
                                    <li><span class="business-day">Sabtu:</span><span class="business-time">Tutup</span></li>
                                    <li><span class="business-day">Minggu:</span><span class="business-time">Tutup</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2 class="footer-widget-title">Lokasi Kantor Kami</h2>
                        <div id="map" style="width: 100%; height: 200px;"></div>

                    </div><!-- .col -->
                </div><!-- .row -->
            </div>
        </div>
        <div class="container">
            <div class="copy-right-sectin">@ 2022 {{ $profil->nama }} - All Right Reserved</div>
        </div>
    </footer>
    <!-- End Footer Scetion -->

    <!-- Scroll Up Button -->
    <span class='scrollup' id="scrollup"></span>

    <!-- Scripts -->
    <script src="{{ asset('front/js/vendor/modernizr-3.6.0.min.js') }}"></script>

    @if($title == 'Cabor' || $title == 'Club' || $title == 'Pelatih' || $title == 'Atlit' || $title == 'Wasit' || $title == 'Cabor Detail' || $title == 'Club Detail' || $title == 'Pelatih Detail' || $title == 'Atlit Detail')

    @else
    <script src="{{ asset('front/js/vendor/jquery-1.12.4.min.js') }}"></script>
    @endif;

    <script src="{{ asset('front/js/owlCarousel.min.js') }}"></script>
    <script src="{{ asset('front/js/isotope.min.js') }}"></script>
    <script src="{{ asset('front/js/tamjidCounter.min.js') }}"></script>
    <script src="{{ asset('front/js/mailchimp.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>

    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 1,
            // items change number for slider display on desktop

            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 7000,
            // autoplayHoverPause: true
        });
    </script>



    <script>
        var lati = <?= $profil->lat ?>;
        var long = <?= $profil->lng ?>;
        var map = L.map('map').setView([lati, long], 14);

        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([lati, long]).addTo(map)
            .bindPopup('<b>Lokasi Kantor Kami').openPopup();
        map.on('click', onMapClick);
    </script>




</body>

</html>