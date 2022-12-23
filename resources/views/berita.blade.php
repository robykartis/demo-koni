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
            <h1>Berita</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Semua Berita</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <div class="site-content section">
        <div class="container">
            <div class="row">
                <main class="col-lg-12 site-main">
                    <div class="portfolio sp-project style1 home-blog" id="portfolio">
                        <div class="grid-sizer"></div>


                        @foreach($berita as $data)
                        <div class="portfolio-item">
                            <div class="post style1">
                                <div class="zoom-effect">
                                    <a href="{{ url('berita/detail/'.$data->slug) }}" class="post-thumbnail">
                                        <img src="{{ asset('berkas/berita/thumbnail/'.$data->foto) }}" alt="Image" class=" zoom-effect-in">
                                    </a>
                                </div>
                                <div class="post-details-wrap">
                                    <div class="byline">
                                        <div class="d-flex justify-content-between">
                                            <span class="author"><a href="#"><i class="fa fa-user"></i> by Admin</a></span>
                                            <span class="comment"><i class="fa fa-calendar"></i> {{$data->tgl_berita_formatsatu()}}</span>
                                        </div>


                                        <span class="posted-on"><a href="#"><i class="fa fa-bookmark"></i> {{ $data->kategoriberita }}</a></span>
                                    </div>

                                    <h2 class="entry-title"><a href="{{ url('berita/detail/'.$data->slug) }}">{{ $data->judul }}</a></h2>

                                </div>
                            </div>
                        </div>
                        @endforeach




                    </div>

                    <nav class="post-navigation">

                        <div class="nav-all-post">
                            <button type="submit" class="t-btn text-white"> Load More <i class="fa fa-refresh"></i></button>

                        </div>

                    </nav><!-- .post-navigation -->
                </main><!-- .col -->
            </div>
        </div>
    </div>


    <!-- Start site-content -->
</div><!-- .main-content -->



@endsection