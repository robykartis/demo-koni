@extends('layouts.caborlay')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Detail Data Atlit</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('catlit.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                        <img src="{{ asset('berkas/atlet/thumbnail/'.$data->foto) }}" width="100%" alt="">

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $data->nama }}</h4>
                            <div class="mb-3">
                                <span class="price h6">{{ $usia }} Tahun</span>
                                <span class="text-muted"> | Berat Badan : {{ $data->berat_badan }} kg | Tinggi Badan: {{ $data->tinggi_badan }} cm</span>
                            </div>
                            <hr>


                            <dl class="row">
                                <dt class="col-sm-4">Nomor Induk Atlet (NIA)</dt>
                                <dd class="col-sm-8">: {{ $data->nia }}</dd>
                                <dt class="col-sm-4">Nama Lengkap</dt>
                                <dd class="col-sm-8">: {{ $data->nama }}</dd>

                                <dt class="col-sm-4">Tanggal Lahir</dt>
                                <dd class="col-sm-8">: {{ $data->tgl_lahir }}</dd>

                                <dt class="col-sm-4">Jenis Kelamin</dt>
                                <dd class="col-sm-8">: {{ $data->jk }}</dd>

                                <dt class="col-sm-4">Agama</dt>
                                <dd class="col-sm-8">: {{ $data->agama }}</dd>


                                <dt class="col-sm-4">No Handphone</dt>
                                <dd class="col-sm-8">: {{ $data->nohp }}</dd>
                                <dt class="col-sm-4">Alamat Lengkap</dt>
                                <dd class="col-sm-8">: {{ $data->alamat }}, Kelurahan {{ $data->lurah }}, Kecamatan {{ $data->camat }} </dd>


                            </dl>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-4">Nama Ayah</dt>
                                <dd class="col-sm-8">: {{ $data->ayah }}</dd>

                                <dt class="col-sm-4">Nama Ibu</dt>
                                <dd class="col-sm-8">: {{ $data->ibu }}</dd>



                            </dl>



                        </div>
                    </div>

                </div>
                <hr />
                <div class="container">

                    <div class="row">
                        <dl class="row">
                            <dt class="col-sm-4">Cabang Olahraga</dt>
                            <dd class="col-sm-8">: {{ $data->cabor }}</dd>

                            <dt class="col-sm-4">Club / Binaan</dt>
                            <dd class="col-sm-8">: {{ $data->club }}</dd>



                        </dl>

                    </div>

                </div>


            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-warning" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#warninghome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Prestasi Atlet</div>
                                </div>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="warninghome" role="tabpanel">
                            <div class="card-body">
                                <table class="table mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kejuaraan</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Tempat Pelaksanaan</th>
                                            <th scope="col">Medali</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prestasi as $p)
                                        <tr>
                                            <th scope="row">{{ $p->kejur }}</th>
                                            <td>{{ $p->tahun }}</td>
                                            <td>{{ $p->tempat }}</td>
                                            <td>{{ $p->medal }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>



@endsection