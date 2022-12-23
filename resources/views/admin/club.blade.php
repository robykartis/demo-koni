@extends('layouts.app')



@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Data Club/Binaan</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <A href="{{ route('club.create') }}" type="button" class="btn btn-primary">Tambah Data</A>

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

                            <div class="mb-3 col-4">
                                <label class="form-label">Cabang Olahraga</label>
                                <select name="status_kaduan" class="form-control" id="status_induk">
                                    <option value="">Semua</option>
                                    @foreach ($cabor as $p)
                                    <option value="{{$p->id}}">
                                        {{ $p->cabor }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3 col-1">
                                <label class="form-label">.</label><br>
                                <button id="btnFiterSubmitSearch_cl" class="btn btn-warning">Filter</button>
                            </div>
                        </div>

                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="laravel_datatable_cl">

                                <thead>

                                    <tr>
                                        <th>Logo</th>
                                        <th>Nama Club</th>
                                        <th>Cabang Olahraga</th>
                                        <th>SK Club</th>
                                        <th class="text-center">Action</th>

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

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable_cl').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/jsonclub') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_induk = $('#status_induk').val();
                }
            },
            columns: [


                {
                    data: 'logo',
                    name: 'logo',
                    sClass: 'text-center'

                },
                {
                    data: 'club',
                    name: 'club',
                    sClass: 'align-middle',
                },
                {
                    data: 'namacabor',
                    name: 'namacabor',
                    sClass: 'align-middle',
                },

                {
                    data: 'sk',
                    name: 'sk',
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


    $('#btnFiterSubmitSearch_cl').click(function() {
        $('#laravel_datatable_cl').DataTable().draw(true);

    });
</script>



@endsection