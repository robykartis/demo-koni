@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Detail Data Pelatih</h5>

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
                        <img src="{{ asset('berkas/pelatih/thumbnail/'.$data->foto) }}" height="400px" width="100%" alt="">

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

                                <dt class="col-sm-3">Tanggal Lahir</dt>
                                <dd class="col-sm-9">: {{ $data->tgl_lahir }}</dd>



                                <dt class="col-sm-3">No Handphone</dt>
                                <dd class="col-sm-9">: {{ $data->nohp }}</dd>
                                <dt class="col-sm-3">Alamat Lengkap</dt>
                                <dd class="col-sm-9">: {{ $data->alamat }}. </dd>


                            </dl>

                            <hr>


                            <dl class="row">
                                <dt class="col-sm-3">Cabang Olahraga</dt>
                                <dd class="col-sm-9">: {{ $data->namacabor }}</dd>

                                <dt class="col-sm-3">Club yg Dilatih</dt>
                                <dd class="col-sm-9">: {{ $data->namaclub }}</dd>
                                <dt class="col-sm-3">Alamat Club</dt>
                                <dd class="col-sm-9">: {{ $data->alamatclub }}</dd>



                            </dl>



                        </div>
                    </div>
                    <hr>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-warning" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#warninghome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-book-alt font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Sertifikat License</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#warningprofile" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Atlit Yang Dilatih</div>
                                </div>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="warninghome" role="tabpanel">
                            <br>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Nomor Sertifikat Pelatih</label>
                                    <input type="text" readonly value="{{ $data->no_sertifikat }}" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Tanggal terbit sertifikat</label>
                                    <input type="date" readonly value="{{ $data->tgl_sertifikat }}" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Masa berlaku sertifikat</label>
                                    <input type="text" readonly value="{{ $data->masa_sertifikat }}" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Level Pelatih</label>

                                    <input type="text" readonly value="{{ $data->level }}" class="form-control" id="inputFirstName">

                                </div>
                            </div>
                            <hr>
                            <h6>File Sertifikat/License Pelatih :</h6>
                            <p> <img src="{{ asset('berkas/license/thumbnail/'.$data->file) }}" height="600px" width="100%" alt="">
                            </p>
                        </div>
                        <div class="tab-pane fade" id="warningprofile" role="tabpanel">

                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <br>
                                    <thead>

                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>No Handphone</th>
                                            <th>Cabor</th>
                                            <th>Club</th>





                                            <th class="text-center">Aksi</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($atlit as $p)
                                        <tr>
                                            <td class="text-center"> <img src="{{ asset('berkas/atlet/thumbnail/'.$p->foto) }}" height="30px"> </td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->nohp }}</td>

                                            <td>{{ $p->cabor }}</td>
                                            <td>{{ $p->club }}</td>




                                            <td class="text-center">

                                                <div class="col">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('atlit.show',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>



                                                    </form>
                                                </div>

                                            </td>



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