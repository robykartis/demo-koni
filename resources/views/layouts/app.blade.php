<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />



    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">



    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <title>{{ $title }}</title>
</head>
<style>
    .form-control:focus {
        border-color: #ffd450;
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    .has-error .form-control:focus {
        box-shadow: none;
        -webkit-box-shadow: none;
    }
</style>

<body>
    <!--wrapper-->

    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('assets/images/koni.png')}}" height="25" class="logo-icon">
                </div>
                <div>
                    <h6 class="logo-text text-dark">
                        @if(auth()->user()->id_cabor == 'sekre')
                        <span class="text-danger">Sekretariat</span>
                        @elseif(auth()->user()->id_cabor == 'su')
                        <span class="text-danger">Super Admin</span>
                        @else
                        <span class="text-danger">Humas</span>
                        @endif
                    </h6>
                </div>
                <div class="toggle-icon ms-auto"><i class='text-dark bx bx-arrow-to-left'></i>
                </div>
            </div>
            <!--navigation-->

            @if(auth()->user()->id_cabor == 'su')
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ url('admin/home') }}">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="menu-label">Data Master Induk</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Tentang Koni</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('profil.index') }}"><i class="bx bx-right-arrow-alt"></i>Profil Koni</a>
                        </li>
                        <li> <a href="{{ route('proker.index') }}"><i class="bx bx-right-arrow-alt"></i>Program Kerja</a>
                        </li>
                        <li> <a href="{{ route('visimisi.index') }}"><i class="bx bx-right-arrow-alt"></i>Visi dan Misi</a>
                        </li>
                        <li> <a href="{{ route('struktur.index') }}"><i class="bx bx-right-arrow-alt"></i>Struktur Organisasi</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Induk Kepengurusan</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('katpeng.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Pengurus</a>
                        </li>

                        <li> <a href="{{ route('pengurus.index') }}"><i class="bx bx-right-arrow-alt"></i>Pengurus</a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Induk Organisasi</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('indukorganisasi.index') }}"><i class="bx bx-right-arrow-alt"></i>Induk Organisasi</a>
                        </li>
                        <li> <a href="{{ route('cabor.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Cabor</a>
                        </li>
                        <li> <a href="{{ route('club.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Club</a>
                        </li>
                        <li> <a href="{{ route('pelatih.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Pelatih</a>
                        </li>
                        <li> <a href="{{ route('atlit.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Atlet</a>
                        </li>

                        <li> <a href="{{ route('wasit.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Wasit</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('akunpengguna.index') }}">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Akun Pengguna</div>
                    </a>
                </li>



                <li class="menu-label">Data Master Informasi</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Berita</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('beritakat.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Berita</a>
                        </li>
                        <li> <a href="{{ route('berita.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Berita</a>
                        </li>
                        <li> <a href="{{ url('admin/draftberita') }}"><i class="bx bx-right-arrow-alt"></i>Draft Berita</a>
                        </li>


                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Galeri</div>
                    </a>

                    <ul>

                        <li> <a href="{{ route('galerifoto.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Galeri Foto</a>
                        </li>
                        <li> <a href="{{ route('video.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Galeri Video</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Agenda</div>
                    </a>

                    <ul>
                        <li> <a href="{{ route('katagenda.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Agenda</a>
                        </li>
                        <li> <a href="{{ route('agenda.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Agenda</a>
                        </li>

                    </ul>
                </li>



                <li class="menu-label mt-0 mb-0">Data Master Pengaturan</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Pengaturan Website</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('slider.index') }}"><i class="bx bx-right-arrow-alt"></i>Slider</a>
                        </li>
                        <li> <a href="{{ route('sambutan.index') }}"><i class="bx bx-right-arrow-alt"></i>Kata Sambutan</a>
                        </li>

                    </ul>
                </li>




            </ul>
            @elseif(auth()->user()->id_cabor == 'sekre')
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ url('admin/home') }}">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="menu-label">Data Master Induk</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Tentang Koni</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('profil.index') }}"><i class="bx bx-right-arrow-alt"></i>Profil Koni</a>
                        </li>
                        <li> <a href="{{ route('proker.index') }}"><i class="bx bx-right-arrow-alt"></i>Program Kerja</a>
                        </li>
                        <li> <a href="{{ route('visimisi.index') }}"><i class="bx bx-right-arrow-alt"></i>Visi dan Misi</a>
                        </li>
                        <li> <a href="{{ route('struktur.index') }}"><i class="bx bx-right-arrow-alt"></i>Struktur Organisasi</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Induk Kepengurusan</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('katpeng.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Pengurus</a>
                        </li>

                        <li> <a href="{{ route('pengurus.index') }}"><i class="bx bx-right-arrow-alt"></i>Pengurus</a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Induk Organisasi</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('indukorganisasi.index') }}"><i class="bx bx-right-arrow-alt"></i>Induk Organisasi</a>
                        </li>
                        <li> <a href="{{ route('cabor.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Cabor</a>
                        </li>

                    </ul>
                </li>


                <li class="menu-label mt-0 mb-0">Data Master Pengaturan</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Pengaturan Website</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('slider.index') }}"><i class="bx bx-right-arrow-alt"></i>Slider</a>
                        </li>
                        <li> <a href="{{ route('sambutan.index') }}"><i class="bx bx-right-arrow-alt"></i>Kata Sambutan</a>
                        </li>

                    </ul>
                </li>




            </ul>
            @else
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ url('admin/home') }}">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>



                <li class="menu-label">Data Master Informasi</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Berita</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('beritakat.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Berita</a>
                        </li>
                        <li> <a href="{{ route('berita.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Berita</a>
                        </li>
                        <li> <a href="{{ url('admin/draftberita') }}"><i class="bx bx-right-arrow-alt"></i>Draft Berita</a>
                        </li>


                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Galeri</div>
                    </a>

                    <ul>

                        <li> <a href="{{ route('galerifoto.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Galeri Foto</a>
                        </li>
                        <li> <a href="{{ route('video.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Galeri Video</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Agenda</div>
                    </a>

                    <ul>
                        <li> <a href="{{ route('katagenda.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Agenda</a>
                        </li>
                        <li> <a href="{{ route('agenda.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Agenda</a>
                        </li>

                    </ul>
                </li>








            </ul>
            @endif


            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">


                            <li class="nav-item dropdown dropdown-large">

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Notifications</p>
                                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">

                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center msg-footer">View All Notifications</div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Messages</p>
                                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                                        </div>
                                    </a>
                                    <div class="header-message-list">
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">

                                            </div>
                                        </a>

                                    </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('berkas/akun/thumbnail/'.auth()->user()->foto) }}" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                                <p class="designattion mb-0">{{ auth()->user()->email }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('akun.index') }}"><i class="bx bx-user"></i><span>Pengaturan Akun</span></a>
                            </li>


                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i>
                                    {{ __('Logout') }}
                                    <span></span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        @yield('content')
        <!--end page wrapper -->
        <!--start overlay-->

        <footer class="page-footer">
            <p class="mb-0">Copyright © 2020-2022. All right reserved.</p>
        </footer>
    </div>

    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}">
    </script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src=" {{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
    <script>
        $('.datepicker').pickadate({
                selectMonths: true,
                selectYears: true
            }),
            $('.timepicker').pickatime()
    </script>
</body>

</html>