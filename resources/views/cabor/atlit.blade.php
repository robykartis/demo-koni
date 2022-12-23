@extends('layouts.caborlay')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Atlet</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <A href="{{ route('catlit.create') }}" type="button" class="btn btn-primary">Tambah Data</A>

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
                        <div class="row col-12 mx-auto">
                            <div class="row col-12 ">

                                <select hidden name="country-ddda" id="country-ddda" class="form-control">
                                    <option value="{{ $detail->idcabor }}"></option>

                                </select>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Club / Binaan</label>
                                    <select name="state-ddda" id="state-ddda" class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($club as $p)
                                        <option value="{{$p->id}}">
                                            {{ $p->club }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3 col-1">
                                    <label class="form-label">.</label><br>
                                    <button id="btnFiterSubmitSearch_at" class="btn btn-warning">Filter</button>
                                </div>
                            </div>



                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="laravel_datatable_at">

                                <thead>

                                    <tr>
                                        <th>Foto Atlit</th>
                                        <th>NIA</th>
                                        <th>Nama</th>
                                        <th>No Handphone</th>
                                        <th>Club / Binaan</th>
                                        <th class="text-center">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <!-- <div class="table-responsive">

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
                                    @foreach($data as $p)
                                    <tr>
                                        <td class="text-center"> <img src="{{ asset('berkas/atlet/thumbnail/'.$p->foto) }}" height="30px"> </td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->nohp }}</td>

                                        <td>{{ $p->cabor }}</td>
                                        <td>{{ $p->club }}</td>




                                        <td class="text-center">

                                            <div class="col">
                                                <form action="{{ route('atlit.destroy', $p->id) }}" method="POST">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('atlit.show',$p->id) }}"><i class='bx bx-info-square me-0'></i></a>

                                                    <a class="btn btn-info btn-sm" href="{{ route('atlit.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a>


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
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable_at').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('cabor/jsonatlit') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_cabor = $('#country-ddda').val();
                    d.status_club = $('#state-ddda').val();


                }
            },
            columns: [


                {
                    data: 'foto',
                    name: 'foto',
                    sClass: 'text-center'

                },
                {
                    data: 'nia',
                    name: 'nia',
                    sClass: 'align-middle',

                },
                {
                    data: 'nama',
                    name: 'nama',
                    sClass: 'align-middle',

                },

                {
                    data: 'nohp',
                    name: 'nohp',
                    sClass: 'align-middle',

                },



                {
                    data: 'club',
                    name: 'club',
                    sClass: 'align-middle',
                },



                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true,
                    sClass: 'text-center align-middle'
                },

            ]
        });

    });


    $('#btnFiterSubmitSearch_at').click(function() {
        $('#laravel_datatable_at').DataTable().draw(true);

    });
</script>

@endsection