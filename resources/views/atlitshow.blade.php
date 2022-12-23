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
            <h1>Detail Data Atlit</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Detail Data Atlit</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Detail Data Atlit</h4>
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
                                        <img src="{{ asset('berkas/atlet/thumbnail/'.$detail->foto) }}" alt="Image">
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
                                        <span>Tinggi Badan</span>
                                        <h3>{{ $detail->tinggi_badan }} cm</h3>
                                    </div>
                                    <div class="single-info-details mb-3">
                                        <span>Berat Badan</span>
                                        <h3> {{ $detail->berat_badan }} kg</h3>
                                    </div>

                                    <div class="single-info-details mb-3">
                                        <span>Alamat</span>
                                        <h3>{{ $detail->alamat }} </h3>
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
                                <h3>{{ $detail->cabor }}</h3>
                            </div>
                            <div class="single-info-details mb-3">
                                <span>Club / Binaan</span>
                                <h3>{{ $detail->club }}</h3>
                            </div>


                        </div>
                    </div>
                </div><!-- .col -->











                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5>Prestasi Atlit </h5>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kejuaraan</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Tempat Pelaksanaan</th>
                                    <th scope="col">Medali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestasi as $p)
                                <tr>
                                    <th scope="row">{{ $p->kejur }}</th>
                                    <td>{{ $p->tahun }}</td>
                                    <td>{{ $p->tempat }}</td>
                                    <td>{{ $p->medal }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div><!-- .col -->


            </div>
        </div>
    </section>


    <!-- Start site-content -->
</div><!-- .main-content -->



@endsection