@extends('layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Tambah Data Club/Binaan</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('club.index') }}" type="button" class="btn btn-secondary">Back</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <hr>
        </div>
        @if(session()->has('error'))

        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div>{{ session()->get('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="main-body">
                <form action="{{ route('club.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Pilih Cabang Olahraga</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="id_cabor" required aria-label="Default select example">
                                                <option selected disabled value="">--pilih--</option>
                                                @foreach ($data as $p)
                                                <option value="{{$p->id}}">
                                                    {{ $p->cabor }}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Club </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="club" required class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat Club </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="alamat" required class="form-control" />
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nomor SK Club </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="sk" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Terbit SK Club </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_terbit" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Berakhir SK Club </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_berakhir" required class="form-control" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Ketua Club </h6>
                                        </div>
                                        <div class="col-sm-6 text-secondary">
                                            <input type="text" name="nama_ketua" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Sekretaris Club </h6>
                                        </div>
                                        <div class="col-sm-6 text-secondary">
                                            <input type="text" name="nama_sekretaris" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Bendahara Club </h6>
                                        </div>
                                        <div class="col-sm-6 text-secondary">
                                            <input type="text" name="nama_bendahara" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Jumlah Pengurus </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="number" name="jml_pengurus" required class="form-control" />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Logo Club</h6><br>
                                            <span class="text-small text-info">(500x500) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('assets/images/nologo.jpg') }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Titik Cordinat Lokasi Club</h6><br>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div id="map" class="gmaps"></div>
                                            <input type="hidden" id="Latitude" placeholder="Latitude" name="lat" />
                                            <input type="hidden" id="Longitude" placeholder="Longitude" name="lng" />

                                        </div>
                                    </div>
                                    <br>



                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary ">SIMPAN DATA</button>
                                    </div>
                                </div>
                            </div>


                        </div>




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
    var lati = 0.480536;
    var long = 101.4419763;
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