@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Pelatih</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <A href="{{ route('pelatih.create') }}" type="button" class="btn btn-primary">Tambah Data</A>

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

                                <div class="mb-3 col-4">
                                    <label class="form-label">Cabang Olahraga</label>
                                    <select name="country-ddd" id="country-ddd" class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($cabor as $p)
                                        <option value="{{$p->id}}">
                                            {{ $p->cabor }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="inputFirstName" class="form-label">Club / Binaan</label>
                                    <select id="state-ddd" name="id_club" class="form-control">
                                    </select>
                                </div>

                                <div class="mb-3 col-1">
                                    <label class="form-label">.</label><br>
                                    <button id="btnFiterSubmitSearch" class="btn btn-warning">Filter</button>
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

                                        <th>Cabang Olahraga</th>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#country-ddd').on('change', function() {
            var idCountry = this.value;
            $("#state-ddd").html('');
            $.ajax({
                url: "{{url('api-club')}}",
                type: "POST",
                data: {
                    kec_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-ddd').html('<option value="">Semua</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-ddd").append('<option value="' + value
                            .id + '">' + value.club + '</option>');
                    });

                }
            });
        });


    });
</script>

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
                url: "{{ url('admin/jsonpelatih') }}",
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
                    data: 'namacabor',
                    name: 'namacabor',
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