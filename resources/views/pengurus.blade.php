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
            <h1>Pengurus</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Pengurus</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header type1">
                <h4>Pengurus {{ $profil->nama }}</h4>
                <img src="{{ asset('berkas/profil/thumbnail/'.$profil->logo) }}" style="width:10%" alt="">
                <div class="section-divider"><span></span></div>
            </div>

            <div class="row">
                @foreach($pengurus as $data)
                <div class="col-md-3">
                    <div class="team-member">
                        <div class="team-member-img">
                            <img src="{{ asset('berkas/pengurus/thumbnail/'.$data->foto) }}" alt="Image">
                        </div>
                        <div class="team-member-text text-center">
                            <h3>{{ $data->nama }}</h3>
                            <span>{{ $data->jabatan }}</span>


                        </div>
                        <!-- <p class="text-small">{{ $data->jenispengurus }}</p> -->

                    </div><!-- .team-member -->
                </div><!-- .col -->


                @endforeach


            </div>
        </div>
    </section>


    <!-- Start site-content -->
</div><!-- .main-content -->



@endsection