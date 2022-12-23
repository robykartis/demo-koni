@extends('layouts.front')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap3.min.js"></script>

<style>
    #mapc {
        min-height: 50vh;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-bottom: 0px;
        z-index: 1;
    }
</style>
@section('content')

<div class="main-content">
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="{{ asset('front/contoh/bgbaner.jpg') }}">
        <div class="container other-hero-text">
            <h1>Detail Data Pelatih</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Detail Data Pelatih</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Detail Data Pelatih</h4>
                <img src="{{ asset('berkas/profil/thumbnail/'.$profil->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>

            </div>

            <div class="row flex">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row flex">
                                <div class="col-lg-4">
                                    <div class="team-member-img">
                                        <img src="{{ asset('berkas/pelatih/thumbnail/'.$detail->foto) }}" alt="Image">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="single-info-details mb-3">
                                        <span>Nama Lengkap</span>
                                        <h3>{{ $detail->nama }}</h3>
                                    </div>

                                    <div class="single-info-details mb-3">
                                        <span>Usia</span>
                                        <h3>{{ $usia }} Tahun</h3>
                                    </div>
                                    <div class="single-info-details mb-3">
                                        <span>Level</span>
                                        <h3>{{ $detail->level }}</h3>
                                    </div>

                                    <div class="single-info-details mb-3">
                                        <span>Alamat</span>
                                        <h3>{{ $detail->alamat }}</h3>
                                    </div>

                                </div>

                            </div>
                        </div>





                    </div>
                </div><!-- .col -->

                <div class="col-xl-4">
                    <div class="card">
                        <!-- <div class="card-header bg-warning">Profil Cabor</div> -->
                        <div class="card-body">

                            <div class="single-info-details mb-3">
                                <span>Cabang Olahraga</span>
                                <h3>{{ $detail->namacabor }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Club yang Dilatih</span>
                                <h3>{{ $detail->namaclub }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Nomor Sertifikat</span>
                                <h3>{{ $detail->no_sertifikat }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Tgl Terbit Sertifikat - Masa Sertifikat</span>
                                <h3>{{ $detail->tgl_sertifikat }} - {{ $detail->masa_sertifikat }}</h3>
                            </div>

                        </div>
                    </div>
                </div><!-- .col -->











                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Atlit yang Dilatih : {{ $tatlit }} orang </h6>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-start  col-12">
                                <div class="col-lg-3">

                                    <select hidden name="state-ddda" id="state-ddda" class="form-control">
                                        <option value="{{ $detail->idclub }}"></option>

                                    </select>
                                </div>

                                <div class="col-lg-3">

                                    <select hidden name="country-ddda" id="country-ddda" class="form-control">
                                        <option value="{{ $detail->idcabor }}"></option>

                                    </select>

                                </div>

                            </div>



                            <table class="table table-bordered data-table" id="laravel_datatable_at">

                                <thead>

                                    <tr>
                                        <th>Foto Atlit</th>
                                        <th>Nama</th>

                                        <th>Club / Binaan</th>

                                        <th class="text-center">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div><!-- .col -->


            </div>
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

        $('#laravel_datatable_at').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('jsonatlit') }}",
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
                    data: 'nama',
                    name: 'nama',
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