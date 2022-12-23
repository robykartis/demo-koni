@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Pengaturan Akun</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url('admin/home') }}" type="button" class="btn btn-secondary">Back to Dashboard</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <hr>
        </div>
        @if(session()->has('error'))

        <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show">
            <div>{{ session()->get('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div> {{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif
        @if (session('message'))
        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div> {{ session('message') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif


        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="main-body">
                <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Foto</h6><br>
                                            <span class="text-small text-info">(500x500) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <label class="card-title cursor-pointer">
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="image" />
                                                <img id="blah" src="{{ asset('berkas/akun/thumbnail/'.$detail->foto) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $detail->name }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $detail->email }}" class="form-control" id="inputFirstName">
                                        </div>
                                    </div>
                                    <br>



                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary ">SIMPAN PERUBAHAN</button>
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

                <div class="card">
                    <div class="card-header">Form Ganti Password</div>
                    <div class="card-body">
                        <div class="panel-body">

                            <form autocomplete=’off’ class="form-horizontal" method="POST" action="{{ url('admin/akun/changePassword') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="inputFirstName" class="form-label">Password Lama</label>

                                    <div class="col-md-6 mb-3">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>


                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label for="inputFirstName" class="form-label">Password Baru</label>

                                    <div class="col-md-6 mb-3">
                                        <input id="new-password" autocomplete="off" type="password" class="form-control" name="new-password" required>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputFirstName" class="form-label">Konfirmasi Password Baru</label>

                                    <div class="col-md-6 mb-3">
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Ganti Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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



<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>



@endsection