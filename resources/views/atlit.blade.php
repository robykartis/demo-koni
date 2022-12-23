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
            <h1>Atlit</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Atlit</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->



    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Atlit {{ $profil->nama }}</h4>
                <img src="{{ asset('berkas/profil/thumbnail/'.$profil->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>
            </div>

            <div class="row justify-content-start  col-12">
                <div class="col-lg-3">
                    <label class="form-label">Cabang Olahraga :</label>
                    <select id="country-ddd" name="id_cabor" class="form-control">
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
                <!-- <div class="col-lg-3">
                    <label for="inputFirstName" class="form-label">Pelatih</label>
                    <select id="city-ddd" name="id_pelatih" class="form-control">
                    </select>
                </div> -->
                <div class="col-lg-1">
                    <label class="form-label">.</label>

                    <button id="btnFiterSubmitSearch" class="btn btn-warning w-100 text-white ">Filter</button>
                </div>


            </div>
            <hr class="mb-3">
            <div class="col-12">
                <table class="table table-bordered data-table" id="laravel_datatable">

                    <thead>

                        <tr>
                            <th>Foto Atlit</th>
                            <th>Nama</th>
                            <th>Cabang Olahraga</th>
                            <th>Club / Binaan</th>

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
        $('#state-ddd').on('change', function() {
            var idState = this.value;
            $("#city-ddd").html('');
            $.ajax({
                url: "{{url('api-atlit')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-ddd').html('<option value="">Semua</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-ddd").append('<option value="' + value
                            .id + '">' + value.nama + '</option>');
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

        $('#laravel_datatable').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonatlit') }}",
                type: 'GET',
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                    d.status_cabor = $('#country-ddd').val();
                    d.status_club = $('#state-ddd').val();
                    d.status_pelatih = $('#city-ddd').val();

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
                    data: 'cabor',
                    name: 'cabor',
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


    $('#btnFiterSubmitSearch').click(function() {
        $('#laravel_datatable').DataTable().draw(true);

    });
</script>

@endsection