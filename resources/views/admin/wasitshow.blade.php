@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Detail Data Wasit/Juri</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('wasit.index') }}" type="button" class="btn btn-secondary">Back</a>

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
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <img src="{{ asset('berkas/wasit/thumbnail/'.$data->foto) }}" height="400px" width="100%" alt="">

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $data->nama }}</h4>
                            <div class="mb-3">
                                <span class="price h6">Usia {{ $usia }} Tahun</span>
                                <span class="text-muted"> </span>
                            </div>
                            <hr>


                            <dl class="row">
                                <dt class="col-sm-3">Nama Lengkap</dt>
                                <dd class="col-sm-9">: {{ $data->nama }}</dd>

                                <dt class="col-sm-3">Cabang Olahraga</dt>
                                <dd class="col-sm-9">: {{ $data->namacabor }}</dd>

                                <dt class="col-sm-3">Tempat Lahir</dt>
                                <dd class="col-sm-9">: {{ $data->tempat_lahir }}. </dd>

                                <dt class="col-sm-3">Tanggal Lahir</dt>
                                <dd class="col-sm-9">: {{ $data->tgl_lahir }}</dd>


                                <dt class="col-sm-3">No Handphone</dt>
                                <dd class="col-sm-9">: {{ $data->nohp }}</dd>



                            </dl>

                            <hr>


                            <dl class="row">
                                <dt class="col-sm-3">Nomor Sertifikat</dt>
                                <dd class="col-sm-9">: {{ $data->no_sertifikat }}</dd>

                                <dt class="col-sm-3">Tanggal Terbit</dt>
                                <dd class="col-sm-9">: {{ $data->tgl_terbit }}</dd>
                                <dt class="col-sm-3">Masa Berlaku</dt>
                                <dd class="col-sm-9">: {{ $data->masa_sertifikat }}</dd>
                                <dt class="col-sm-3">Level Wasit</dt>
                                <dd class="col-sm-9">: {{ $data->level }}</dd>



                            </dl>



                        </div>
                    </div>
                    <hr>
                </div>



            </div>

        </div>
    </div>
</div>



@endsection