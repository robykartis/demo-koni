@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Edit Data Pelatih</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('pelatih.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                <form action="{{ url('admin/updatepelatih') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-primary">1. Data Organisasi</h6>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Cabang Olahraga</label>
                                            <select id="country-ddd" name="id_cabor" class="form-control">
                                                <option selected value="{{ $data->idkatcabor }}">{{ $data->namacabor }}</option>
                                                @foreach ($kat as $p)
                                                <option value="{{$p->id}}">
                                                    {{ $p->cabor }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Club yg Dilatih</label>
                                            <select id="state-ddd" required name="id_club" class="form-control">
                                                <option selected value="{{ $data->idkatclub }}">{{ $data->namaclub }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                    <h6 class="text-primary">2. Data Personal</h6>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" value="{{ $data->tempat_lahir }}" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">No Handphone</label>
                                            <input type="text" name="nohp" value="{{ $data->nohp }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" value="{{ $data->tgl_lahir }}" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>


                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">Alamat Lengkap</label>
                                            <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>




                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Foto Pelatih</h6><br>
                                            <span class="text-small text-info">(500x500) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('berkas/pelatih/thumbnail/'.$data->foto) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sertifikat License </h6><br>
                                            <span class="text-small text-info">(1000x1000) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURLdua(this);" hidden accept="image/png, image/gif, image/jpeg" name="file" />
                                                <img id="blahdua" src="{{ asset('berkas/license/thumbnail/'.$data->file) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nomor Sertifikat Pelatih</label>
                                            <input type="text" name="no_sertifikat" value="{{ $data->no_sertifikat }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tanggal terbit sertifikat</label>
                                            <input type="date" name="tgl_sertifikat" value="{{ $data->tgl_sertifikat }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Masa berlaku sertifikat</label>
                                            <input type="text" name="masa_sertifikat" value="{{ $data->masa_sertifikat }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Level Pelatih</label>
                                            <select name="level" class="form-control">
                                                <option value="{{ $data->level }}">{{ $data->level }}</option>

                                                <option value="NASIONAL">NASIONAL</option>
                                                <option value="DAERAH">DAERAH</option>
                                                <option value="TANPA SERTIFIKAT">TANPA SERTIFIKAT</option>

                                            </select>
                                        </div>
                                    </div>

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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


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
    function readURLdua(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blahdua')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#country-dd').on('change', function() {
            var idCountry = this.value;
            $("#state-dd").html('');
            $.ajax({
                url: "{{url('admin/api/fetch-cities')}}",
                type: "POST",
                data: {
                    kec_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dd').html('<option value="">Select Kelurahan</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.kelurahan + '</option>');
                    });

                }
            });
        });


    });
</script>

// club

<script>
    $(document).ready(function() {
        $('#country-ddd').on('change', function() {
            var idCountry = this.value;
            $("#state-ddd").html('');
            $.ajax({
                url: "{{url('admin/api/fetch-club')}}",
                type: "POST",
                data: {
                    kec_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-ddd').html('<option value="">Select Club</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-ddd").append('<option value="' + value
                            .id + '">' + value.club + '</option>');
                    });

                }
            });
        });


    });
</script>

@endsection