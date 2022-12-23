@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Akun Pengguna</h5>

                <div class="ms-auto">
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button> &nbsp;

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
        @if(session()->has('error'))

        <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show">
            <div>Gagal !!! {{ session()->get('error') }}</div>
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
                                        <th>Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role / Hak Akses</th>
                                        <th>Cabor</th>

                                        <th class="text-center">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $p)
                                    <tr>
                                        <td class="text-center"> <img src="{{ asset('berkas/akun/thumbnail/'.$p->foto) }}" height="30px"> </td>

                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->email }}</td>
                                        @if($p->is_admin == 0)
                                        <td> <span class="badge bg-secondary">Super Admin</span> </td>
                                        @elseif($p->is_admin == 1)
                                        <td> <span class="badge bg-success">Sekretariat</span> </td>
                                        @elseif($p->is_admin == 2)
                                        <td> <span class="badge bg-info">Cabor</span> </td>
                                        @else
                                        <td> <span class="badge bg-success">Humas</span> </td>
                                        @endif
                                        <td>{{ $p->cabor }}</td>

                                        <td class="text-center">

                                            <div class="col">
                                                <form action="{{ route('akunpengguna.destroy', $p->id) }}" method="POST">

                                                    <a class="btn btn-info btn-sm" href="{{ route('akunpengguna.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a>


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
        <form action="{{ route('akunpengguna.store') }}" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Buat Akun Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="mb-3 col-12">
                            <div class="mb-1">
                                <label class="form-check-label mb-2" for="flexRadioDefault1">Pilih Role / Hak Akses</label>
                                <select id="country-ddd" name="role" required class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="sekre">Sekretariat</option>
                                    <option value="humas">Humas</option>
                                    @foreach ($cabor as $p)
                                    <option value="{{$p->id}}">
                                        Cabor - {{ $p->cabor }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="mb-3 col-12">
                            <div class="mb-1">
                                <label class="form-check-label mb-2" for="flexRadioDefault1">Nama Lengkap</label>
                                <input type="text" name="name" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="mb-3 col-12">
                            <div class="mb-1">
                                <label class="form-check-label mb-2" for="flexRadioDefault1">Email </label>
                                <input type="email" name="email" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="mb-3 col-12">
                            <div class="mb-1">
                                <label class="form-check-label mb-2" for="flexRadioDefault1">Password </label>
                                <input type="password" name="password" required class="form-control">
                            </div>
                        </div>
                    </div>







                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection