@extends('layouts.caborlay')
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
@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="mb-0 ps-2 text-uppercase"> Dashboard <span class="text-primary"></span> </h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <!-- <a href="{{ route('atlit.create') }}" type="button" class="btn  btn-primary"> Edit Profil Cabor</a> -->

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="mx-auto">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-3 border-end">
                        <img src="{{ asset('berkas/cabor/thumbnail/'.$detail->logo) }}" width="100%" alt="">

                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4 class="card-title">{{ $detail->cabor }}</h4>

                            <hr>


                            <dl class="row">
                                <dt class="col-sm-4">Induk Organisasi</dt>
                                <dd class="col-sm-8">: {{ $detail->indukp }} - {{ $detail->indukpendek }}</dd>

                                <dt class="col-sm-4">Cabang Olahraga</dt>
                                <dd class="col-sm-8">: {{ $detail->cabor }}</dd>



                                <dt class="col-sm-4">SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $detail->sk }}</dd>

                                <dt class="col-sm-4">Tgl Terbit SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $detail->tgl_terbit }}</dd>

                                <dt class="col-sm-4">Tgl Berakhir SK Cabor </dt>
                                <dd class="col-sm-8">: {{ $detail->tgl_berakhir }}</dd>

                                <dt class="col-sm-4">No Surat Rekomendasi Koni</dt>
                                <dd class="col-sm-8">: {{ $detail->no_surat_koni }}</dd>

                                <dt class="col-sm-4">Tgl Surat Rekomendasi Koni</dt>
                                <dd class="col-sm-8">: {{ $detail->tgl_surat_koni }}</dd>




                            </dl>








                        </div>
                    </div>
                    <hr>
                </div>



            </div>
            <div class="row ">
                <div class="col-lg-3">
                    <a href="{{ route('cclub.index') }}">
                        <div class="card radius-5 bg-white">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="mb-3 text-center text-dark">{{ $tclub }}</h4>
                                    <div class="ms-auto">
                                        <h5 class="mb-0 text-center">TOTAL CLUB</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('cpelatih.index') }}">
                        <div class="card radius-5 bg-white">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="mb-3 text-center text-dark">{{ $tpelatih }}</h4>
                                    <div class="ms-auto">
                                        <h5 class="mb-0 text-center">TOTAL PELATIH</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('catlit.index') }}">
                        <div class="card radius-5 bg-white">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="mb-3 text-center text-dark">{{ $tatlit }}</h4>
                                    <div class="ms-auto">
                                        <h5 class="mb-0 text-center">TOTAL ATLET</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('cwasit.index') }}">
                        <div class="card radius-5 bg-white">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="mb-3 text-center text-dark">{{ $twasit }}</h4>
                                    <div class="ms-auto">
                                        <h5 class="mb-0 text-center">TOTAL WASIT</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
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
                            <dd class="col-sm-6">: {{ $detail->nama_ketua }} </dd>

                            <dt class="col-sm-6">Nama Sekretaris</dt>
                            <dd class="col-sm-6">: {{ $detail->nama_sekretaris }}</dd>

                            <dt class="col-sm-6">Nama Bendahara</dt>
                            <dd class="col-sm-6">: {{ $detail->nama_bendahara }}</dd>

                            <dt class="col-sm-6">Jumlah Pengurus</dt>
                            <dd class="col-sm-6">: {{ $detail->jml_pengurus }}</dd>

                            <hr>
                            <dt class="col-sm-6">Alamat Cabor</dt>
                            <dd class="col-sm-6">: {{ $detail->alamat }}</dd>






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

    </div>


</div>
</div>

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
        iconUrl: '../../../public/erkas/cabor/thumbnail/' + lo + ''
    });
    var marker = L.marker([lati, long], {

        }).addTo(map)
        .bindPopup('<div><img height="80px" width="90px" src="../../../public/berkas/cabor/thumbnail/' + lo + '"> </div> <hr><a href="https://maps.google.com/?q= ' + lati + ', ' + long + '" target="_blank" class="text-info">klik rute lokasi</a>').openPopup();

    map.on('click', onMapClick);
</script>


@endsection