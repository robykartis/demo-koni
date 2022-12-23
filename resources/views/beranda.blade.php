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

    <div id="home"></div>
    <section class="owl-carousel hero-slider hero-slider-v1" id="hero-slider-v1">
        @foreach($slider as $p)
        <div class="single-slid">
            <div class="bg-img lazy" data-src="{{ asset('berkas/slider/'.$p->slider) }}"></div>
            <div class="slider-overlay"></div>
            <div class="container">
                <div class="hero-text">
                    <h1>{{ $p->judul }}</h1>
                </div>
            </div>
        </div><!-- .single-slid -->
        @endforeach

    </section>
    <section class="feature">
        <div class="container">
            <div class="flex">
                <div class="col-lg-3 single-feature text-center">
                    <div class="single-feature-icon">
                        <i class="fa fa-briefcase"></i>
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <h3 class="feature-text">{{ $kcabor }} Cabor</h3>
                </div>
                <div class="col-lg-3 single-feature text-center">
                    <div class="single-feature-icon">
                        <i class="fa fa-bank"></i>
                        <i class="fa fa-bank"></i>

                    </div>
                    <h3 class="feature-text">{{ $kclub }} Club</h3>
                </div>
                <div class="col-lg-3 single-feature text-center">
                    <div class="single-feature-icon">
                        <i class="fa fa-user"></i>
                        <i class="fa fa-user"></i>
                    </div>
                    <h3 class="feature-text">{{ $kpelatih }} Pelatih</h3>
                </div>
                <div class="col-lg-3 single-feature text-center">
                    <div class="single-feature-icon">
                        <i class="fa fa-users"></i>
                        <i class="fa fa-users"></i>
                    </div>
                    <h3 class="feature-text">{{ $katlit }} Atlit</h3>
                </div>
            </div><!-- .row -->
        </div>
    </section>
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="col-lg-12 col-md-6">
                        <div class="team-member">
                            <div class="team-member-img">
                                <img src="{{ asset('berkas/pengurus/'.$sambutan->fotop) }}" alt="Image">
                            </div>
                            <div class="team-member-text text-center">
                                <h3>{{ $sambutan->namap }}</h3>
                                <span>{{ $sambutan->jabatanp }}</span>

                            </div>
                        </div><!-- .team-member -->
                    </div><!-- .col -->

                </div><!-- .col -->

                <div class="col-lg-8">
                    <h3 class="text-center">Kata Sambutan</h3>
                    <div class="section-divider"><span></span></div>
                    <p>{!! $sambutan->katasambutan !!}</p>
                    <br>

                    <br>
                    <h3 class="text-center">Visi dan Misi</h3>
                    <div class="section-divider"><span></span></div>
                    <div class="accordian-wrapper">
                        <div class="single-accordian">
                            <h3 class="accordian-head">
                                <i class="fa fa-bookmark"></i>
                                Visi
                            </h3>
                            <div class="accordian-body"> {{ $visimisi->visi }}
                            </div>
                        </div><!-- .single-accordian -->
                        <div class="single-accordian">
                            <h3 class="accordian-head">
                                <i class="fa fa-bookmark"></i>
                                Misi
                            </h3>
                            <div class="accordian-body">
                                {!! $visimisi->misi !!}
                            </div>
                        </div><!-- .single-accordian -->

                    </div>
                </div><!-- .col -->
            </div>
        </div>
    </section>

    <hr>

    <div class="site-content section gray-bg ">
        <div class="container">
            <div class="row">
                <main class="col-lg-8 site-main">
                    <div class="portfolio sp-project style2 home-blog" id="portfolio">
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






                    </div><!-- .portfolio -->

                    <nav class="post-navigation mt-0 mb-0">
                        <div class="nav-next"><a href="{{ url('/berita') }}" class="active">Selengkapnya</a></div>
                    </nav>
                </main><!-- .col -->
                @include('layouts.sidebarkanan')

            </div>
        </div>
    </div>

    <section class="home-blog section" id="blog">
        <div class="container">
            <div class="section-header">
                <h2>Galeri Foto</h2>
                <h3>galeri foto kami</h3>
            </div>
            <div class="row flex">
                @foreach($hasilgal as $data)
                <div class="col-lg-4">
                    <article class="post">
                        <div class="zoom-effect">

                            <a href="{{ url('galeri-foto/detail/'.$data->slug) }}" class="post-thumbnail zoom-effect-in"><img style="height:250px" src="{{ asset('berkas/galerifoto/thumbnail/'.$data->fotogal) }}" alt="Image"></a>
                        </div>
                        <div class="post-details-wrap">
                            <div class="byline">
                                <div class="d-flex justify-content-between">
                                    <span class="author"><a href="#"><i class="fa fa-user"></i> by Admin</a></span>
                                    <span class=""><i class="fa fa-calendar"></i> {{ $data->tgl }}</span>
                                </div>
                                <span class="posted-on"><i class="fa fa-image"></i></span>

                            </div>
                            <h2 class="entry-title"><a href="{{ url('galeri-foto/detail/'.$data->slug) }}">{{ $data->judul }}</a></h2>
                        </div>
                    </article>
                </div><!-- .col -->

                @endforeach



            </div>
            <nav class="post-navigation mt-0 mb-0">
                <div class="nav-next"><a href="{{ url('/galeri-foto') }}" class="active">Selengkapnya</a></div>
            </nav>
        </div>
    </section>
    <hr>

    <section class="home-blog section gray-bg" id="blog">
        <div class="container">
            <div class="section-header">
                <h2>Galeri Video</h2>
                <h3>galeri video kami</h3>
            </div>
            <div class="row flex">
                @foreach($galvideo as $data)
                <div class="col-lg-4">
                    <article class="post">
                        <div class="zoom-effect">

                            <a href="{{ url('galeri-video/detail/'.$data->slug) }}" class="post-thumbnail zoom-effect-in">
                                <iframe width="100%" height="220" src="https://youtube.com/embed/{{ substr($data->video, -11) }}?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0" allowfullscreen></iframe>
                            </a>
                        </div>
                        <div class="post-details-wrap">
                            <div class="byline">
                                <div class="d-flex justify-content-between">
                                    <span class="author"><a href="#"><i class="fa fa-user"></i> by Admin</a></span>
                                    <span class=""><i class="fa fa-calendar"></i> {{$data->tgl_video_formatsatu()}}</span>
                                </div>
                                <span class="posted-on"><i class="fa fa-video-camera"></i></span>

                            </div>
                            <h2 class="entry-title d-flex"><a href="{{ url('galeri-video/detail/'.$data->slug) }}">{{ $data->judul }}</a></h2>
                        </div>
                    </article>
                </div><!-- .col -->

                @endforeach



            </div>
            <nav class="post-navigation mt-0 mb-0">
                <div class="nav-next"><a href="{{ url('/galeri-video') }}" class="active">Selengkapnya</a></div>
            </nav>
        </div>
    </section>



    <!-- Start CTA section -->
    <section class="cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-8">
                    <h2 class="cta-quote">Ada Pertanyaan Lebih Lanjut, Anda Bisa Menghubungi Kami Melalui Email</h2>
                </div><!-- .col -->
                <div class="col-lg-5 col-md-4 text-right">
                    <a href="mailto:{{ $profil->email }}?subject=subject&cc=" target="_blank" class="t-btn cta-btn"> <i class="fa fa-paper-plane"></i> Kirim Email</a>
                </div><!-- .col -->
            </div>
        </div>
    </section>
    <!-- End CTA section -->
</div><!-- .main-content -->
@endsection