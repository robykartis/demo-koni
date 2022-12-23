@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Tambah Data Atlet</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('atlit.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                <form action="{{ route('atlit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-primary">1. Data Organisasi</h6>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Cabang Olahraga</label>
                                            <select id="country-ddd" name="id_cabor" class="form-control">
                                                <option value="">Pilih Cabang Olahraga</option>
                                                @foreach ($data as $p)
                                                <option value="{{$p->id}}">
                                                    {{ $p->cabor }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Club/Binaan</label>
                                            <select id="state-ddd" required name="id_club" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <br>


                                    <h6 class="text-primary">2. Data Personal</h6>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-4">
                                            <label for="inputFirstName" class="form-label">Nomor Induk Atlet (NIA)</label>
                                            <input type="number" name="nia" class="form-control" required id="inputFirstName">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputFirstName" class="form-label">NIK</label>
                                            <input type="number" name="nik" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputFirstName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" id="inputFirstName">
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
                                        <div class="col-md-3">
                                            <label for="inputFirstName" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select mb-3" name="jk" required aria-label="Default select example">
                                                <option selected disabled value="">--pilih--</option>

                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputFirstName" class="form-label">Agama</label>
                                            <select class="form-select mb-3" name="agama" required aria-label="Default select example">
                                                <option selected disabled value="">--pilih--</option>

                                                <option value="ISLAM">ISLAM</option>
                                                <option value="PROTESTAN">PROTESTAN</option>
                                                <option value="KATOLIK">KATOLIK</option>
                                                <option value="HINDU">HINDU</option>
                                                <option value="BUDDHA">BUDDHA</option>
                                                <option value="KHONGHUCU">KHONGHUCU</option>

                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="inputFirstName" class="form-label">Tinggi Badan</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="tinggi_badan" aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">cm</span>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputFirstName" class="form-label">Berat Badan</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="berat_badan" aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Kecamatan</label>
                                            <select id="country-dd" name="kecamatan" class="form-control">
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($kec as $p)
                                                <option value="{{$p->id}}">
                                                    {{$p->kecamatan}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Kelurahan</label>
                                            <select id="state-dd" required name="kelurahan" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">Alamat Lengkap</label>
                                            <input type="text" name="alamat" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Ayah</label>
                                            <input type="text" name="ayah" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Ibu</label>
                                            <input type="text" name="ibu" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>



                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Foto Atlit</h6><br>
                                            <span class="text-small text-info">(500x500) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('berkas/atlet/avat.jpg') }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="text-primary">3. Data Prestasi</h6>
                                    <hr class="text-primary">

                                    <table class="table table-responsive" id="dynamicTable">

                                        <tr>

                                            <th>Kejuaraan Olahraga</th>
                                            <th>Tahun</th>
                                            <th>Tempat Pelaksanaan</th>
                                            <th>Medali</th>
                                            <th></th>

                                        </tr>

                                        <tr>

                                            <td>
                                                <select name="addmore[0][kejuaraan]" class="form-control">
                                                    <option value="">--pilih--</option>
                                                    @foreach ($kejur as $p)
                                                    <option value="{{$p->id}}">
                                                        {{$p->nama}}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td><input type="number" name="addmore[0][tahun]" class="form-control" /></td>
                                            <td><input type="text" name="addmore[0][tempat]" class="form-control" /></td>
                                            <td>
                                                <select name="addmore[0][medali]" class="form-control">
                                                    <option value="">--pilih--</option>
                                                    @foreach ($medal as $p)
                                                    <option value="{{$p->id}}">
                                                        {{$p->medali}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="bx bx-plus"></i>Prestasi</button></td>

                                        </tr>

                                    </table>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true //to close picker once year is selected
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

// add prestasi
<script type="text/javascript">
    var i = 0;
    $("#add").click(function() {
        ++i;

        $("#dynamicTable").append('<tr><td><select name="addmore[' + i + '][kejuaraan]" class="form-control"><option value="">--pilih--</option><?php foreach ($kejur as $p) : ?><option value="<?php echo $p->id ?>"><?php echo $p->nama ?></option><?php endforeach; ?></select></td> <td><input type="number" name="addmore[' + i + '][tahun]"  class="form-control" /></td><td><input type="text" name="addmore[' + i + '][tempat]"  class="form-control" /></td><td><select name="addmore[' + i + '][medali]" class="form-control"><option value="">--pilih--</option><?php foreach ($medal as $p) : ?><option value="<?php echo $p->id ?>"><?php echo $p->medali ?></option><?php endforeach; ?></select></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
@endsection