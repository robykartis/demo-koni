@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Galeri Foto</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('galerifoto.create') }}" type="button" class="btn btn-primary">Tambah Data</a>

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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <br>
                                <thead>

                                    <tr>
                                        <th>Judul Galeri</th>
                                        <th>Tanggal Galeri</th>

                                        <th class="text-center">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $p)
                                    <tr>



                                        <td>{{ $p->judul }}</td>
                                        <td>{{ $p->tgl }}</td>
                                        <td class="text-center">

                                            <div class="col">
                                                <form action="{{ route('galerifoto.destroy', $p->id) }}" method="POST">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('galerifoto.show',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>

                                                    <a class="btn btn-info btn-sm" href="#"><i class='bx bx-edit me-0'></i></a>


                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class='bx bx-trash me-0'></i></button>

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


@endsection