@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <h5 class="mb-0 text-uppercase">Dashboard <span class="text-primary"></span> </h5>
        <hr>
        <div class="ps-3">
            <nav aria-label="breadcrumb">

            </nav>
        </div>

        <div class="mx-auto">
            <div class="card border-top border-0 border-4 border-warning">
                <div class="card-header bg-white">
                    <h6>Rekapitulasi Organisasi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card radius-5 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h3 class="mb-2">{{ $tinduk }}</h3>
                                            <h6 class="mb-0">INDUK ORGANISASI</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div id="bounce-rate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card radius-5 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h3 class="mb-2">{{ $tcabor }}</h3>
                                            <h6 class="mb-0">TOTAL CABOR</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div id="bounce-rate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card radius-5 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h3 class="mb-2">{{ $tclub }}</h3>
                                            <h6 class="mb-0">TOTAL CLUB</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div id="bounce-rate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card radius-5 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h3 class="mb-2">{{ $twasit }}</h3>
                                            <h6 class="mb-0">TOTAL WASIT</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div id="bounce-rate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card radius-5 bg-white">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4 class="mb-2 text-center text-dark">{{ $tpelatih }}</h4>
                                        <div class="ms-auto">
                                            <h5 class="mb-0 text-center">TOTAL PELATIH</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card radius-5 bg-white">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4 class="mb-2 text-center text-dark">{{ $tatlit }}</h4>
                                        <div class="ms-auto">
                                            <h5 class="mb-0 text-center">TOTAL ATLET</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="card border-top border-0 border-4 border-warning">
                <div class="card-header bg-white">
                    <h6>Rekapitulasi Prestasi Atlet</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card radius-5 bg-white">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4 class="mb-2 text-center text-dark">{{ $tp }}</h4>
                                        <div class="ms-auto">
                                            <i class="bx bx-trophy bx-lg"></i>
                                            <h6 class="mb-0 text-center">TOTAL PRESTASI ATLET</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        @foreach($pres as $p)
                        <div class="col-md-3">
                            <div class="card radius-5 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h3 class="mb-2">{{ $p->units }}</h3>
                                            <h6 class="mb-0">{{ $p->date }}</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div id="bounce-rate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>

                </div>
            </div>

            <div class="card border-top border-0 border-4 border-warning">
                <div class="card-header bg-white">
                    <h6>Maps Sebaran Data Cabor</h6>
                </div>
                <div class="card-body">
                    <div id="mapcabor"></div>

                </div>
            </div>

            <div class="card border-top border-0 border-4 border-warning">
                <div class="card-header bg-white">
                    <h6>Maps Sebaran Data Club</h6>
                </div>
                <div class="card-body">
                    <div id="map"></div>

                </div>
            </div>

        </div>








    </div>
</div>

<style>
    #map {
        min-height: 50vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
<style>
    #mapcabor {
        min-height: 50vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script>
    var infras = <?= json_encode($mapcabor); ?>;


    var mapcabor = L.map('mapcabor').setView([0.510440, 101.438309], 12);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mapcabor);


    for (var i = 0; i < infras.length; i++) {


        var marker = L.marker([infras[i][1], infras[i][2]], {

        }).addTo(mapcabor).bindPopup('<div class="text-center"><b>' + infras[i][3] + '</b><br><img height="80px" width="90px" src="../../../public/berkas/cabor/thumbnail/' + infras[i][4] + '"> <br><br><a href="cabor/' + infras[i][0] + '" class="text-white btn btn-info btn-sm">detail cabor</a> </div> <hr><a href="https://maps.google.com/?q= ' + infras[i][1] + ', ' + infras[i][2] + '" target="_blank" class="text-info">klik rute lokasi</a>');
    }
</script>


<script>
    var infras = <?= json_encode($mapclub); ?>;


    var map = L.map('map').setView([0.510440, 101.438309], 12);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


    for (var i = 0; i < infras.length; i++) {


        var marker = L.marker([infras[i][1], infras[i][2]], {

        }).addTo(map).bindPopup('<div class="text-center"><b>' + infras[i][3] + '</b><br><img height="80px" width="90px" src="../../../public/berkas/club/thumbnail/' + infras[i][4] + '"> <br><br><a href="club/' + infras[i][0] + '" class="text-white btn btn-info btn-sm">detail club</a> </div> <hr><a href="https://maps.google.com/?q= ' + infras[i][1] + ', ' + infras[i][2] + '" target="_blank" class="text-info">klik rute lokasi</a>');
    }
</script>

@endsection