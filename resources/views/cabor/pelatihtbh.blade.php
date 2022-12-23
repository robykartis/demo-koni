@extends('layouts.caborlay')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Tambah Data Pelatih</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('cpelatih.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                <form action="{{ route('cpelatih.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-primary">1. Data Club</h6>
                                    <hr class="text-primary">
                                    <input type="hidden" name="id_cabor" value="{{ $detail->idcabor }}">

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Club / Binaan</label>
                                            <select id="country-ddd" name="id_club" class="form-control">
                                                <option value="">Pilih Club / Binaan</option>
                                                @foreach ($data as $p)
                                                <option value="{{$p->id}}">
                                                    {{ $p->club }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <br>

                                    <h6 class="text-primary">2. Data Personal</h6>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">No Handphone</label>
                                            <input type="text" name="nohp" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>


                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">Alamat Lengkap</label>
                                            <input type="text" name="alamat" class="form-control" id="inputFirstName">
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
                                                <img id="blah" src="{{ asset('berkas/pelatih/avat.jpg') }}" class="card-img-top" />
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
                                                <img id="blahdua" src="{{ asset('berkas/pelatih/nologo.jpg') }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nomor Sertifikat Pelatih</label>
                                            <input type="text" name="no_sertifikat" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tanggal terbit sertifikat</label>
                                            <input type="date" name="tgl_sertifikat" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Masa berlaku sertifikat</label>
                                            <input type="text" name="masa_sertifikat" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Level Pelatih</label>
                                            <select name="level" class="form-control">
                                                <option value="">Pilih Level Pelatih</option>

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


@endsection