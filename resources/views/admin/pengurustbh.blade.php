@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Tambah Data Pengurus</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('pengurus.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Pengurus </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kategori Pengurus</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="id_kat_peng" required aria-label="Default select example">
                                                <option selected disabled value="">--pilih--</option>
                                                @foreach ($data as $p)
                                                <option value="{{$p->id}}">
                                                    {{$p->nama_kat}}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Jabatan </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="jabatan" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">No Handphone </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nohp" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Jenis Kelamin </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="jk" required aria-label="Default select example">
                                                <option selected disabled value="">--pilih--</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>

                                            </select>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Upload Foto Pengurus</h6><br>
                                            <span class="text-small text-info">(500x500) file format: (jpg,png)</span>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('assets/images/avat.jpg') }}" class="card-img-top" />
                                            </label>
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

@endsection