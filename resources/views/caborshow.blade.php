@extends('layouts.front')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap3.min.js"></script>

<style>
    #mapc {
        min-height: 50vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
@section('content')

<div class="main-content">
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="{{ asset('front/contoh/bgbaner.jpg') }}">
        <div class="container other-hero-text">
            <h1>Detail Data Cabor</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Detail Data Cabor</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>{{ $detail->cabor }}</h4>
                <img src="{{ asset('berkas/cabor/thumbnail/'.$detail->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>

            </div>

            <div class="row flex">
                <div class="col-xl-6">
                    <div class="card">
                        <!-- <div class="card-header bg-warning">Profil Cabor</div> -->
                        <div class="card-body">
                            <div class="single-info-details mb-3">
                                <span>Induk Organisasi</span>
                                <h3>{{ $detail->indukp }} - {{ $detail->indukpendek }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Nama Cabang Olahraga</span>
                                <h3>{{ $detail->cabor }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>SK Cabang Olahraga</span>
                                <h3>{{ $detail->sk }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Tanggal Terbit SK</span>
                                <h3>{{ $detail->tgl_terbit }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Tanggal Berakhir SK</span>
                                <h3>{{ $detail->tgl_berakhir }}</h3>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-xl-6">
                    <div class="card">
                        <!-- <div class="card-header bg-warning">Profil Cabor</div> -->
                        <div class="card-body">
                            <div class="single-info-details mb-3">
                                <span>Nama Ketua</span>
                                <h3>{{ $detail->nama_ketua }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Nama Bendahara</span>
                                <h3>{{ $detail->nama_bendahara }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Nama Sekretaris</span>
                                <h3>{{ $detail->nama_sekretaris }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Jumlah Pengurus</span>
                                <h3>{{ $detail->jml_pengurus }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Alamat Sekretariat</span>
                                <h3>{{ $detail->alamat }}</h3>
                            </div>

                        </div>
                    </div>
                </div><!-- .col -->

                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header text-center">Map Cabang Olahraga</div>
                        <div id="mapc"></div>
                    </div>
                </div><!-- .col -->

                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header text-center">Rekapitulasi Data</div>
                        <div class="row col-lg-12 flex">
                            <div class="col-lg-4 mb-3 mt-3">
                                <div class="card">
                                    <div class="card-body text-white text-center bg-info">
                                        <h4 class="text-white"><b>{{ $tclub }}</b> </h4>
                                        <h5> CLUB</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 mt-3">
                                <div class="card">
                                    <div class="card-body text-white text-center bg-info">
                                        <h4 class="text-white"><b>{{ $tpelatih }}</b> </h4>
                                        <h5> PELATIH</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3 mt-3">
                                <div class="card">
                                    <div class="card-body text-white text-center bg-info">
                                        <h4 class="text-white"><b>{{ $tatlit }} </b> </h4>
                                        <h5>ATLIT</h5>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div><!-- .col -->



                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Tabel Data Club</h6>
                        </div>


                        <div class="card-body">
                            <div class="col-lg-4">

                                <select hidden name="status_kaduan" class="form-control" id="status_induk">
                                    <option value="{{ $detail->id }}"></option>
                                </select>

                            </div>
                            <table class="table table-bordered data-table" id="laravel_datatable">

                                <thead>

                                    <tr>
                                        <th>Logo</th>
                                        <th>Nama Club</th>
                                        <th>SK Club</th>
                                        <th class="text-center">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div><!-- .col -->

                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Tabel Data Pelatih</h6>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-start  col-12">
                                <div class="col-lg-3">
                                    <label for="inputFirstName" class="form-label">Club / Binaan</label>
                                    <select name="state-ddd" id="state-ddd" class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($club as $p)
                                        <option value="{{$p->id}}">
                                            {{ $p->club }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <label class="form-label">.</label>

                                    <button id="btnFiterSubmitSearch" class="btn btn-warning w-100 text-white ">Filter</button>
                                </div>
                                <div class="col-lg-3">

                                    <select hidden name="country-ddd" id="country-ddd" class="form-control">
                                        <option value="{{ $detail->id }}"></option>

                                    </select>

                                </div>

                            </div>



                            <table class="table table-bordered data-table" id="laravel_datatable_pel">

                                <thead>

                                    <tr>
                                        <th>Foto Pelatih</th>
                                        <th>Nama Pealtih</th>
                                        <th>Level</th>

                                        <th>Club / Binaan</th>
                                        <th class="text-center">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div><!-- .col -->

                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Tabel Data Atlit</h6>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-start  col-12">
                                <div class="col-lg-3">
                                    <label for="inputFirstName" class="form-label">Club / Binaan</label>
                                    <select name="state-ddda" id="state-ddda" class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($club as $p)
                                        <option value="{{$p->id}}">
                                            {{ $p->club }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <label class="form-label">.</label>

                                    <button id="btnFiterSubmitSearch_at" class="btn btn-warning w-100 text-white ">Filter</button>
                                </div>
                                <div class="col-lg-3">

                                    <select hidden name="country-ddda" id="country-ddda" class="form-control">
                                        <option value="{{ $detail->id }}"></option>

                                    </select>

                                </div>

                            </div>



                            <table class="table table-bordered data-table" id="laravel_datatable_at">

                                <thead>

                                    <tr>
                                        <th>Foto Atlit</th>
                                        <th>Nama</th>

                                        <th>Club / Binaan</th>

                                        <th class="text-center">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div><!-- .col -->


            </div>
        </div>
    </section>


    <!-- Start site-content -->
</div><!-- .main-content -->

<script>
    var lati = <?= $detail->lat ?>;
    var long = <?= $detail->lng ?>;
    var lo = <?= json_encode($detail->logo) ?>;


    var map = L.map('mapc').setView([lati, long], 14);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var iconMap = L.icon({


        iconSize: [28, 35], // size of the icon
        shadowSize: [40, 60], // size of the shadow
        popupAnchor: [-3, -23], // point from which the popup should open relative to the iconAnchor
        iconUrl: '../../../public/berkas/cabor/thumbnail/' + lo + ''
    });
    var marker = L.marker([lati, long], {

        }).addTo(map)
        .bindPopup('<div><img height="80px" width="90px" src="../../../public/berkas/cabor/thumbnail/' + lo + '"> </div> <hr><a href="https://maps.google.com/?q= ' + lati + ', ' + long + '" target="_blank" class="text-info">klik rute lokasi</a>').openPopup();

    map.on('click', onMapClick);
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonclub') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_induk = $('#status_induk').val();
                }
            },
            columns: [


                {
                    data: 'logo',
                    name: 'logo',
                    sClass: 'text-center'

                },
                {
                    data: 'club',
                    name: 'club',
                    sClass: 'align-middle',
                },

                {
                    data: 'sk',
                    name: 'sk',
                    sClass: 'align-middle',
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true,
                    sClass: 'text-center align-middle'
                },

            ]
        });



    });


    $('#btnFiterSubmitSearch').click(function() {
        $('#laravel_datatable').DataTable().draw(true);

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable_pel').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonpelatih') }}",
                type: 'GET',
                data: function(dp) {
                    dp.search = $('input[type="search"]').val()
                    dp.status_cabor = $('#country-ddd').val();
                    dp.status_club = $('#state-ddd').val();

                }
            },
            columns: [


                {
                    data: 'foto',
                    name: 'foto',
                    sClass: 'text-center'

                },
                {
                    data: 'nama',
                    name: 'nama',
                    sClass: 'align-middle',

                },


                {
                    data: 'level',
                    name: 'leve',
                    sClass: 'align-middle',
                },
                {
                    data: 'namaclub',
                    name: 'namaclub',
                    sClass: 'align-middle',
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    sClass: 'text-center align-middle'
                },

            ]
        });

    });


    $('#btnFiterSubmitSearch').click(function() {
        $('#laravel_datatable_pel').DataTable().draw(true);

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable_at').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonatlit') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_cabor = $('#country-ddda').val();
                    d.status_club = $('#state-ddda').val();


                }
            },
            columns: [


                {
                    data: 'foto',
                    name: 'foto',
                    sClass: 'text-center'

                },
                {
                    data: 'nama',
                    name: 'nama',
                    sClass: 'align-middle',

                },



                {
                    data: 'club',
                    name: 'club',
                    sClass: 'align-middle',
                },



                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true,
                    sClass: 'text-center align-middle'
                },

            ]
        });

    });


    $('#btnFiterSubmitSearch_at').click(function() {
        $('#laravel_datatable_at').DataTable().draw(true);

    });
</script>

@endsection