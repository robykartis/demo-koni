@extends('layouts.caborlay')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="mb-0 ps-2 text-uppercase"> Edit Data Cabang Olahraga <span class="text-primary"></span> </h5>


                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url('cabor/home') }}" type="button" class="btn btn-secondary">Back to Dashboard</a>

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

        @if(session()->has('message'))

        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div>{{ session()->get('message') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="main-body">
                <form action="{{ url('cabor/updatecabor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <input type="hidden" name="id_induk" value="{{ $detail->idinduk }}">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="cabor" value="{{ $data->cabor }}" required class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="alamat" value="{{ $data->alamat }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nomor SK Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="sk" value="{{ $data->sk }}" required class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Terbit SK </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_terbit" value="{{ $data->tgl_terbit }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Berakhir SK </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_berakhir" value="{{ $data->tgl_berakhir }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">No Surat Rekomendasi dari KONI </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="no_surat_koni" value="{{ $data->no_surat_koni }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Surat Dari Koni </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_surat_koni" value="{{ $data->tgl_surat_koni }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Ketua Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama_ketua" value="{{ $data->nama_ketua }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Sekretaris Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama_sekretaris" value="{{ $data->nama_sekretaris }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Bendahara Cabor </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama_bendahara" value="{{ $data->nama_bendahara }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Jumlah Pengurus </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="number" name="jml_pengurus" value="{{ $data->jml_pengurus }}" required class="form-control" />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Logo Cabor</h6><br>
                                            <span class="text-small text-info">(500x500) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('berkas/cabor/thumbnail/'.$data->logo) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Titik Cordinat Lokasi Cabor</h6><br>
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