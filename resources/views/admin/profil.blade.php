@extends('layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Profil Koni</h5>

                <!-- <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Simpan Perubahan</button>

                    </div>
                </div> -->
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
                <form action="{{ url('admin/updateprofil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Organisasi</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama" required class="form-control" value="{{ $data->nama }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" name="email" class="form-control" value="{{ $data->email }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Telp</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="number" name="telp" class="form-control" value="{{ $data->telp }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Facebook</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="fb" class="form-control" value="{{ $data->fb }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Instagram</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="ig" class="form-control" value="{{ $data->ig }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Youtube</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="yt" class="form-control" value="{{ $data->yt }}" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sejarah Organisasi</h6>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-0">

                                            <textarea id="summernote" name="deskripsi">{{ $data->deskripsi }}</textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <!-- <img src="{{ asset('assets/images/koni.png') }}" class="card-img-top" alt=""> -->

                                <h6 class="mb-0 mt-3">&nbsp;&nbsp;&nbsp;Logo</h6>
                                <hr>
                                <label class="card-title cursor-pointer">
                                    <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                    <img id="blah" src="{{ asset('berkas/profil/thumbnail/'.$data->logo) }}" class="card-img-top" />
                                </label>
                                <hr>
                                <h6 class="mb-0 ">&nbsp;&nbsp;&nbsp;Titik Lokasi Kantor</h6>
                                <div class="card-body">
                                    <div id="map" class="gmaps"></div>
                                    <input type="hidden" id="Latitude" placeholder="Latitude" name="lat" />
                                    <input type="hidden" id="Longitude" placeholder="Longitude" name="lng" />

                                </div>



                            </div>



                        </div>



                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary w-50">SIMPAN PERUBAHAN</button>
                    </div>
                    <div class="col-lg-8">
                        <br>
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $('#summernote').summernote({

        tabsize: 2,
        height: 300
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    var lati = <?= $data->lat ?>;
    var long = <?= $data->lng ?>;
    var map = L.map('map').setView([lati, long], 13);

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);



    var marker = L.marker([lati, long], {
        draggable: 'true'
    }).addTo(map);

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng).keyup();
    });

    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });

    map.addLayer(marker);
</script>
@endsection