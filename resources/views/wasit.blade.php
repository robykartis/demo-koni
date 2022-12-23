@extends('layouts.front')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap3.min.js"></script>

@section('content')

<div class="main-content">
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="{{ asset('front/contoh/bgbaner.jpg') }}">
        <div class="container other-hero-text">
            <h1>Wasit</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Wasit</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->



    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Wasit {{ $profil->nama }}</h4>
                <img src="{{ asset('berkas/profil/thumbnail/'.$profil->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>
            </div>

            <div class="row justify-content-start  col-12">



            </div>
            <hr class="mb-3">
            <div class="col-12">
                <table class="table table-bordered data-table" id="laravel_datatable">

                    <thead>

                        <tr>
                            <th>Foto </th>
                            <th>Nama Wasit</th>
                            <th>Nomor Sertifikat</th>
                            <th>Level Wasit</th>

                            <th class="text-center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
    </section>


    <!-- Start site-content -->
</div><!-- .main-content -->
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#laravel_datatable').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonwasit') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_induk = $('#status_induk').val();
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
                    data: 'no_sertifikat',
                    name: 'no_sertifikat',
                    sClass: 'align-middle',
                },
                {
                    data: 'level',
                    name: 'level',
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


    $('#btnFiterSubmitSearch').click(function() {
        $('#laravel_datatable').DataTable().draw(true);

    });
</script>

@endsection