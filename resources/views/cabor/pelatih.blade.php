@extends('layouts.caborlay')




@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="mb-0 ps-2 text-uppercase"> Data Pelatih <span class="text-primary"></span> </h5>


                <div class="ms-auto">
                    <div class="btn-group">
                        <A href="{{ route('cpelatih.create') }}" type="button" class="btn btn-primary">Tambah Data</A>

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
                <div class="card-body">
                    <div class="row col-12 mx-auto">
                        <div class="row col-12 ">
                            <select hidden name="country-ddd" id="country-ddd" class="form-control">
                                <option value="{{ $detail->idcabor }}"></option>

                            </select>
                            <div class="mb-3 col-4">
                                <label class="form-label">Club / Binaan</label>
                                <select name="state-ddd" id="state-ddd" class="form-control">
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
                                <button type="text" id="btnFiterSubmitSearch" class="btn btn-warning">Filter</button>
                            </div>
                        </div>



                    </div>
                    <hr>



                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="laravel_datatable_pel">

                            <thead>

                                <tr>
                                    <th>Foto Pelatih</th>
                                    <th>Nama Pealtih</th>
                                    <th>Nomor Handphone</th>


                                    <th>Club / Binaan</th>
                                    <th class="text-center">Aksi</th>

                                </tr>

                            </thead>



                        </table>

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

        $('#laravel_datatable_pel').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('cabor/jsonpelatih') }}",
                type: 'GET',
                data: function(dp) {
                    dp.search = $('input[type="search"]').val()
                    dp.status_cabor = $('#country-ddd').val();
                    dp.status_club = $('#state-ddd').val();

                }
            },
            columns: [


                {
                    data: 'foto',
                    name: 'foto',
                    sClass: 'text-center'


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
                    data: 'namaclub',
                    name: 'namaclub',
                    sClass: 'align-middle',

                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    sClass: 'text-center'


                },

            ]
        });

    });


    $('#btnFiterSubmitSearch').click(function() {
        $('#laravel_datatable_pel').DataTable().draw(true);

    });
</script>


@endsection