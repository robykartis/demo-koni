@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Detail Data Cabor</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('cabor.index') }}" type="button" class="btn btn-secondary">Back</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <hr>
        </div>

        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-3 border-end">
                        <img src="{{ asset('berkas/cabor/thumbnail/'.$data->logo) }}" width="100%" alt="">

                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4 class="card-title">Cabor : {{ $data->cabor }}</h4>

                            <hr>


                            <dl class="row">
                                <dt class="col-sm-4">Induk Organisasi</dt>
                                <dd class="col-sm-8">: {{ $data->indukpan }} - {{ $data->indukpen }}</dd>




                                <dt class="col-sm-4">SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $data->sk }}</dd>

                                <dt class="col-sm-4">Tgl Terbit SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $data->tgl_terbit }}</dd>

                                <dt class="col-sm-4">Tgl Berakhir SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $data->tgl_berakhir }}</dd>

                                <dt class="col-sm-4">Surat Rekomendasi Koni </dt>
                                <dd class="col-sm-8">: {{ $data->no_surat_koni }}</dd>

                                <dt class="col-sm-4">Tgl Surat Rekomendasi Koni </dt>
                                <dd class="col-sm-8">: {{ $data->tgl_surat_koni }}</dd>







                            </dl>








                        </div>
                    </div>
                    <hr>
                </div>



            </div>
            <div class="row ">
                <div class="col-lg-3">
                    <div class="card radius-5 bg-white">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="mb-3 text-center text-dark">{{ $hitungclub }}</h4>
                                <div class="ms-auto">
                                    <h5 class="mb-0 text-center">TOTAL CLUB</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card radius-5 bg-white">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="mb-3 text-center text-dark">{{ $hitungpelatih }}</h4>
                                <div class="ms-auto">
                                    <h5 class="mb-0 text-center">TOTAL PELATIH</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card radius-5 bg-white">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="mb-3 text-center text-dark">{{ $hitungatlet }}</h4>
                                <div class="ms-auto">
                                    <h5 class="mb-0 text-center">TOTAL ATLET</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card radius-5 bg-white">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="mb-3 text-center text-dark">{{ $hitungwasit }}</h4>
                                <div class="ms-auto">
                                    <h5 class="mb-0 text-center">TOTAL WASIT</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Pengurus Cabor</h5>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-6">Nama Ketua</dt>
                                <dd class="col-sm-6">: {{ $data->nama_ketua }} </dd>

                                <dt class="col-sm-6">Nama Sekretaris</dt>
                                <dd class="col-sm-6">: {{ $data->nama_sekretaris }}</dd>

                                <dt class="col-sm-6">Nama Bendahara</dt>
                                <dd class="col-sm-6">: {{ $data->nama_bendahara }}</dd>

                                <dt class="col-sm-6">Jumlah Pengurus</dt>
                                <dd class="col-sm-6">: {{ $data->jml_pengurus }}</dd>

                                <dt class="col-sm-6">Alamat Cabor </dt>
                                <dd class="col-sm-6">: {{ $data->alamat }}</dd>

                            </dl>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="card-body">
                            <h5 class="card-title">Map Lokasi Cabor</h5>
                            <hr>
                            <div id="mapc"></div>



                        </div>
                    </div>
                    <hr>
                </div>



            </div>

            <div class="card">
                <div class="card-header bg white">
                    <h5>Data Club</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 mx-auto">
                        <div class="row col-12 ">
                            <select hidden name="status_kaduan" class="form-control" id="status_induk">
                                <option value="{{ $data->id }}"></option>
                            </select>


                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="laravel_datatable_cl">

                            <thead>

                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Club</th>
                                    <th>SK Club</th>
                                    <th class="text-center">Action</th>

                                </tr>

                            </thead>



                        </table>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg white">
                    <h5>Data Pelatih</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 mx-auto">
                        <div class="row col-12 ">
                            <select hidden name="country-ddd" id="country-ddd" class="form-control">
                                <option value="{{ $data->id }}"></option>

                            </select>
                            <div class="mb-3 col-4">
                                <label class="form-label">Club / Binaan</label>
                                <select name="state-ddd" id="state-ddd" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach ($club as $p)
                                    <option value="{{$p->id}}">
                                        {{ $p->club }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-1">
                                <label class="form-label">.</label><br>
                                <button id="btnFiterSubmitSearch" class="btn btn-warning">Filter</button>
                            </div>





                        </div>



                    </div>




                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="laravel_datatable_pel">

                            <thead>

                                <tr>
                                    <th>Foto Pelatih</th>
                                    <th>Nama Pealtih</th>
                                    <th>Nomor Handphone</th>


                                    <th>Club / Binaan</th>
                                    <th class="text-center">Aksi</th>

                                </tr>

                            </thead>



                        </table>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg white">
                    <h5>Data Atlet</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 mx-auto">
                        <div class="row col-12 ">
                            <select hidden name="country-ddda" id="country-ddda" class="form-control">
                                <option value="{{ $data->id }}"></option>

                            </select>

                            <div class="mb-3 col-4">
                                <label class="form-label">Club / Binaan</label>
                                <select name="state-ddda" id="state-ddda" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach ($club as $p)
                                    <option value="{{$p->id}}">
                                        {{ $p->club }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3 col-1">
                                <label class="form-label">.</label><br>
                                <button id="btnFiterSubmitSearch_at" class="btn btn-warning">Filter</button>
                            </div>




                        </div>



                    </div>




                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="laravel_datatable_at">

                            <thead>

                                <tr>
                                    <th>Foto Atlit</th>
                                    <th>NIA</th>
                                    <th>Nama</th>
                                    <th>No Handphone</th>
                                    <th>Club / Binaan</th>
                                    <th class="text-center">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg white">
                    <h5>Data Wasit</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 mx-auto">




                    </div>




                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <br>
                            <thead>

                                <tr>
                                    <th class="text-center">Foto Wasit</th>
                                    <th>Nama Wasit</th>

                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No Handphone</th>






                                    <th class="text-center">Aksi</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wasit as $p)
                                <tr>
                                    <td class="text-center"> <img src="{{ asset('berkas/wasit/thumbnail/'.$p->foto) }}" style="width: 40px;"> </td>
                                    <td>{{ $p->nama }}</td>

                                    <td>{{ $p->tempat_lahir }}</td>
                                    <td>{{ $p->tgl_lahir }}</td>
                                    <td>{{ $p->nohp }}</td>






                                    <td class="text-center">

                                        <div class="col">
                                            <form action="{{ route('wasit.destroy', $p->id) }}" method="POST">
                                                <a class="btn btn-warning btn-sm" href="{{ route('wasit.show',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>

                                                <a class="btn btn-info btn-sm" href="{{ route('wasit.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a>


                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class='bx bx-trash me-0'></i></button>

                                            </form>
                                        </div>

                                    </td>



                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<style>
    #mapc {
        min-height: 40vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
<script>
    var lati = <?= $data->lat ?>;
    var long = <?= $data->lng ?>;
    var lo = <?= json_encode($data->logo) ?>;


    var map = L.map('mapc').setView([lati, long], 14);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var iconMap = L.icon({


        iconSize: [28, 35], // size of the icon
        shadowSize: [40, 60], // size of the shadow
        popupAnchor: [-3, -23], // point from which the popup should open relative to the iconAnchor
        iconUrl: '../../../berkas/club/thumbnail/' + lo + ''
    });
    var marker = L.marker([lati, long], {

        }).addTo(map)
        .bindPopup('<div><img height="80px" width="90px" src="../../../berkas/cabor/thumbnail/' + lo + '"> </div> <hr><a href="https://maps.google.com/?q= ' + lati + ', ' + long + '" target="_blank" class="text-info">klik rute lokasi</a>').openPopup();

    map.on('click', onMapClick);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable_cl').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/jsonclub') }}",
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
        $('#laravel_datatable_cl').DataTable().draw(true);

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
                url: "{{ url('admin/jsonpelatih') }}",
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
                    data: 'nohp',
                    name: 'nohp',
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
                    sClass: 'text-center'


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
                url: "{{ url('admin/jsonatlit') }}",
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
                    data: 'nia',
                    name: 'nia',
                    sClass: 'align-middle',

                },
                {
                    data: 'nama',
                    name: 'nama',
                    sClass: 'align-middle',

                },

                {
                    data: 'nohp',
                    name: 'nohp',
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