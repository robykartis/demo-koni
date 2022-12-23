@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Induk Organisasi</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Tambah Data</button>

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
                                        <th>Induk Organisasi</th>
                                        <th>Kepanjangan</th>


                                        <th class="text-center">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $p)
                                    <tr>



                                        <td>{{ $p->pendek }}</td>
                                        <td>{{ $p->panjang }}</td>




                                        <td class="text-center">

                                            <div class="col">
                                                <form action="{{ route('indukorganisasi.destroy', $p->id) }}" method="POST">

                                                    <a class="btn btn-info btn-sm" href="{{ route('indukorganisasi.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a>


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
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('indukorganisasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header ">
                    <h6 class="modal-title " id="exampleModalLabel">Tambah Data Induk Organisasi</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Organisasi:</label>
                        <input type="text" name="pendek" placeholder="contoh: PSSI" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Panjang Organisasi:</label>
                        <input type="text" name="panjang" placeholder="contoh: Persatuan Sepakbolah ....." class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection