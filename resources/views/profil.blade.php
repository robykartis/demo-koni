@extends('layouts.front')
<style>
    .btn-social,
    .btn-social:visited,
    .btn-social:focus,
    .btn-social:hover,
    .btn-social:active {
        color: #ffffff;
        text-decoration: none;
        transition: opacity .15s ease-in-out;
    }

    .btn-social:hover,
    .btn-social:active {
        opacity: .75;
    }

    .btn-fb {
        background-color: #3b5998;
    }

    .btn-tw {
        background-color: #1da1f2;
    }

    .btn-in {
        background-color: #0077b5;
    }

    .btn-gp {
        background-color: #db4437;
    }

    .btn-rd {
        background-color: #ff4500;
    }

    .btn-hn {
        background-color: #ff4000;
    }

    /* Outline Social Share Buttons */

    .btn-social-outline {
        background-color: transparent;
        background-image: none;
        text-decoration: none;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
    }

    .btn-fb-outline {
        color: #3b5998;
        border-color: #3b5998;
    }

    .btn-fb-outline:hover,
    .btn-fb-outline:active {
        color: #ffffff;
        background-color: #3b5998;
    }

    .btn-tw-outline {
        color: #1da1f2;
        border-color: #1da1f2;
    }

    .btn-tw-outline:hover,
    .btn-tw-outline:active {
        color: #ffffff;
        background-color: #1da1f2;
    }

    .btn-in-outline {
        color: #0077b5;
        border-color: #0077b5;
    }

    .btn-in-outline:hover,
    .btn-in-outline:active {
        color: #ffffff;
        background-color: #0077b5;
    }

    .btn-gp-outline {
        color: #db4437;
        border-color: #db4437;
    }

    .btn-gp-outline:hover,
    .btn-gp-outline:active {
        color: #ffffff;
        background-color: #db4437;
    }

    .btn-rd-outline {
        color: #ff4500;
        border-color: #ff4500;
    }

    .btn-rd-outline:hover,
    .btn-rd-outline:active {
        color: #ffffff;
        background-color: #ff4500;
    }

    .btn-hn-outline {
        color: #ff4000;
        border-color: #ff4000;
    }

    .btn-hn-outline:hover,
    .btn-hn-outline:active {
        color: #ffffff;
        background-color: #ff4000;
    }

    /* Fluid Styles */

    .fluid {
        display: flex;
    }

    .fluid a {
        flex-grow: 1;
        margin-right: 0.25rem;
    }

    .fluid a:last-child {
        margin-right: 0rem;
    }
</style>
@section('content')

<div class="main-content">
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="{{ asset('front/contoh/bgbaner.jpg') }}">
        <div class="container other-hero-text">
            <h1>Profil</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Profil</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Profil {{ $profil->nama }}</h4>
                <img src="{{ asset('berkas/profil/thumbnail/'.$profil->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>
            </div>

            <div class="row">
                <div class="col-xl-7">
                    <h4>Sejarah Organisasi</h4>
                    <p>{!! $profil->deskripsi !!}</p>


                </div><!-- .col -->
                <div class="col-xl-5">
                    <h4>Kontak Kami</h4>
                    <div class="contact-info-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-contact-info">
                                    <i class="icon-basic_geolocalize-01"></i>
                                    <div class="single-info-details">
                                        <h3>Alamat</h3>
                                        <span>{{ $profil->alamat }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-contact-info">
                                    <i class="icon-device_iphone"></i>
                                    <div class="single-info-details">
                                        <h3>No Telpone</h3>
                                        <span>{{ $profil->telp }}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-contact-info">
                                    <i class="icon-mail_envelope"></i>
                                    <div class="single-info-details">
                                        <h3>Alamat E-mail</h3>
                                        <span>{{ $profil->email }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- .contact-info-wrap -->

                </div><!-- .col -->
            </div>
        </div>
    </section>


    <!-- Start site-content -->
</div><!-- .main-content -->



@endsection