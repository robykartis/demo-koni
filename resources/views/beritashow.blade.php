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
        background-color: green;
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
            <h1>Detail Berita</h1>
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Detail Berita</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start site-content -->
    <div class="site-content section">
        <div class="container">
            <div class="row">
                <main class="col-lg-8 site-main">
                    <article class="post post-details">
                        <header class="post style1 entry-header">
                            <div class="post-thumbnail">

                                <img src="{{ asset('berkas/berita/thumbnail/'.$detail->foto) }}" alt="Image">

                            </div>
                            <div class="post-details-wrap">

                                <div class="byline">
                                    <span class="author"><a href="#"><i class="fa fa-user"></i>Admin</a>
                                    </span>
                                    <span class="post-category"><a href="#"><i class="fa fa-bookmark"></i> {{ $detail->kategoriberita }}</a></span>

                                    <span class="posted-on"><a href="#"><i class="fa fa-calendar"></i>{{$detail->tgl_berita_formatsatu()}}</a></span>
                                    <span class="posted-on"><a href="#"><i class="fa fa-eye"></i>{{$detail->visitor}}</a></span>
                                    <span class="posted-on"><a href="#"><i class="fa fa-book"></i>waktu baca:
                                            <?php

                                            $kata = $detail->isi;
                                            $var_x = str_word_count(strip_tags($kata));
                                            $par_waktu = 90;
                                            $ht_mnt = floor($var_x / $par_waktu);
                                            $ht_dtk = floor($var_x % $par_waktu / ($par_waktu / 60));
                                            $ht_tmpl = $ht_mnt .  " menit";
                                            echo $ht_tmpl;

                                            ?>

                                        </a></span>

                                </div>


                                <h2 class="entry-title">{{ $detail->judul }}</h2>
                                <p>{!!html_entity_decode($detail->isi)!!} </p>
                            </div><!-- .post-details-wrap -->
                        </header>
                        <div class="entry-content">


                            <hr>
                            <br>
                            <h6>Tags:</h6>
                            <div class="tagcloud">
                                @if ($detail->tag != "")
                                @foreach(explode(',', $detail->tag) as $info)
                                <option></option>
                                <a href="#">#{{$info}}</a>
                                @endforeach
                                @endif



                            </div>

                        </div><!-- .entry-content -->
                    </article>

                    <div class="comments-area">
                        <div class="card">
                            <div class="card-body">
                                <h6>share:</h6>
                                <div class="fluid">
                                    <div class="fb-share-button" data-href="http://127.0.0.1:8000/berita/detail/{{ $detail->slug }}" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Bagikan </a></div>


                                    <a class="btn btn-sm btn-social btn-fb" href="{{ $profil->fb }}" target="_blank" title="Share this post on Facebook">
                                        <i class="fa fa-facebook-square"></i> Bagikan
                                    </a>

                                    <a class="btn btn-sm btn-social btn-gp" href="{{ $profil->yt }}" target="_blank" title="Share this post on Google Plus">
                                        <i class="fa fa-whatsapp" data-fa-transform="grow-2"></i> Whatsapp
                                    </a>
                                    <a class="btn btn-sm btn-social btn-tw" href="{{ $profil->ig }}" target="_blank" title="Share this post on Google Plus">
                                        <i class="fa fa-twitter" data-fa-transform="grow-2"></i> Twitter
                                    </a>


                                </div>

                            </div>
                        </div>


                    </div><!-- .comments-area -->
                </main><!-- .col -->

                @include('layouts.sidebarkanan')
            </div>
        </div>
    </div>


    <!-- Start site-content -->
</div><!-- .main-content -->

<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

@endsection