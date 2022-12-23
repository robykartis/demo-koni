@extends('layouts.caborlay')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="mb-0 ps-2 text-uppercase"> Data Club/Binaan <span class="text-primary"></span> </h5>


                <div class="ms-auto">
                    <div class="btn-group">
                        <A href="{{ route('cclub.create') }}" type="button" class="btn btn-primary">Tambah Data</A>

                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <hr>
        </div>
        @if(session()->has('message'))

        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div>{{ session()->get('message') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="main-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <br>
                                <thead>

                                    <tr>
                                        <th class="text-center">Logo Club</th>

                                        <th>Nama Club</th>
                                        <th>SK Club</th>
                                        <th>Alamat Club</th>



                                        <th class="text-center">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $p)
                                    <tr>
                                        <td class="text-center"> <img src="{{ asset('berkas/club/thumbnail/'.$p->logo) }}" height="30px"> </td>


                                        <td>{{ $p->club }}</td>
                                        <td>{{ $p->sk }}</td>
                                        <td>{{ $p->alamat }}</td>



                                        <td class="text-center">

                                            <div class="col">
                                                <form action="{{ route('cclub.destroy', $p->id) }}" method="POST">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('cclub.show',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>

                                                    <a class="btn btn-info btn-sm" href="{{ route('cclub.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a>


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
                <div class="card">
                    <div class="card-header bg-white">
                        <h6 class="card-title">Sebaran Data Map Club</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-md-12">




                                <div id="map"></div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #map {
        min-height: 60vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

<script>
    var infras = <?= json_encode($mapclub); ?>;


    var map = L.map('map').setView([0.510440, 101.438309], 12);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


    for (var i = 0; i < infras.length; i++) {


        var marker = L.marker([infras[i][1], infras[i][2]], {

        }).addTo(map).bindPopup('<div class="text-center"><b>' + infras[i][3] + '</b><br><img height="80px" width="90px" src="../../../public/berkas/club/thumbnail/' + infras[i][4] + '"> <br><br><a href="cclub/' + infras[i][0] + '" class="text-white btn btn-info btn-sm">detail club</a> </div> <hr><a href="https://maps.google.com/?q= ' + infras[i][1] + ', ' + infras[i][2] + '" target="_blank" class="text-info">klik rute lokasi</a>');
    }
</script>

@endsection