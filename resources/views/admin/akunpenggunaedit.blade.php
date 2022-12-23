@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Edit Data Akun Pengguna</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('akunpengguna.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                <form action="{{ url('admin/updateakunp') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <br>


                                    <hr class="text-primary">
                                    <div class="row g-3 mb-3">

                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $data->name }}" class="form-control" id="inputFirstName">
                                        </div>


                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $data->email }}" class="form-control" id="inputFirstName">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Password</label>
                                            <input type="text" name="password" value="" class="form-control" id="inputFirstName">
                                        </div>

                                    </div>




                                    <hr>

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


<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>




@endsection