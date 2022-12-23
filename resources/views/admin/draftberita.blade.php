@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Draft Berita</h5>


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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <br>
                                <thead>

                                    <tr>
                                        <th>Foto Berita</th>
                                        <th>Judul Berita</th>
                                        <th>Cabor Penulis</th>
                                        <th>Status Berita</th>
                                        <th>Tgl Berita</th>




                                        <th class="text-center">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $p)
                                    <tr>
                                        <td class="text-center"> <img src="{{ asset('berkas/berita/thumbnail/'.$p->foto) }}" height="30px"> </td>

                                        <td>{{ $p->judul }}</td>
                                        <td>{{ $p->cabor }}</td>
                                        @if($p->aktif == 0)
                                        <td> <span class="badge bg-warning">perlu verifikasi</span> </td>
                                        @elseif($p->aktif == 1)
                                        <td> <span class="badge bg-success">sudah tayang</span> </td>
                                        @else
                                        <td> <span class="badge bg-info">sedang perbaikan</span> </td>
                                        @endif
                                        <td>{{ $p->tgl_berita }}</td>

                                        <td class="text-center">
                                            <div class="col">

                                                <a class="btn btn-success btn-sm" href="{{ url('admin/draftberita/detail',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>





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


@endsection