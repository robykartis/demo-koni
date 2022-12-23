<aside class="col-lg-4">
    <div class="sidebar">
        <section class="widget widget_categories">
            <h2 class="widget-title mb-0">Ikuti Kami</h2>
            <br>
            <div class="fluid">
                <a class="btn btn-sm btn-social btn-fb" href="{{ $profil->fb }}" target="_blank" title="Share this post on Facebook">
                    <i class="fa fa-facebook-square"></i> Facebook
                </a>
                <a class="btn btn-sm btn-social btn-gp" href="{{ $profil->yt }}" target="_blank" title="Share this post on Google Plus">
                    <i class="fa fa-youtube-play" data-fa-transform="grow-2"></i> Youtube
                </a>
                <a class="btn btn-sm btn-social btn-hn" href="{{ $profil->ig }}" target="_blank" title="Share this post on Google Plus">
                    <i class="fa fa-instagram" data-fa-transform="grow-2"></i> Instagram
                </a>
            </div>
        </section><!-- .widget -->
        <hr class="mb-3 mt-3">


        <section class="widget widget_recent_entries">
            <h2 class="widget-title">Berita Populer</h2>
            @foreach($populer as $data)
            <div class="row d-flex px-0 mb-4">
                <div class="col-lg-4">
                    <div class="zoom-effect">
                        <a href="{{ url('berita/detail/'.$data->slug) }}" class="post-thumbnail">
                            <img style="height: 65;" src="{{ asset('berkas/berita/thumbnail/'.$data->foto) }}" alt="Image" class=" zoom-effect-in">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 px-0">
                    <a href="{{ url('berita/detail/'.$data->slug) }}">
                        <b class="mt-0">{{ $data->judul }}</b>
                    </a>
                    <br>
                    <small class="text-muted"> <i class="fa fa-calendar"></i>&nbsp; {{$data->tgl_berita_formatsatu()}}</small>
                </div>
            </div>
            @endforeach



        </section><!-- .widget -->
        <hr>
        <section class="widget widget_recent_entries mt-3">
            <h2 class="widget-title">Agenda Kami</h2>
            @foreach($agenda as $data)
            <div class="row d-flex px-0 mb-4">
                <div class="col-lg-4">
                    <div class="zoom-effect">
                        <a href="#" class="post-thumbnail">
                            <img style="height: 70; width:100%;" src="{{ asset('front/contoh/agenda.jpg') }}" alt="Image" class=" zoom-effect-in">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 px-0">
                    <a href="">
                        <b class="mt-0">{{ $data->judul }}</b>
                    </a>
                    <br>
                    <small class="text-muted"> <i class="fa fa-calendar"></i>&nbsp; {{$data->tgl_ag_formatsatu()}}</small>
                </div>
            </div>
            @endforeach



        </section><!-- .widget -->


        <!-- <section class="widget widget_categories">
            <br>
            <h2 class="widget-title mt-10">Kategori Berita</h2>
            <ul>
                <li><a href="#">Constructions</a></li>
                <li><a href="#">Building</a></li>
                <li><a href="#">Renovation</a></li>
                <li><a href="#">Video Post</a></li>
                <li><a href="#">Wood</a></li>
                <li><a href="#">Painting</a></li>
            </ul>
        </section> -->
        <!-- .widget -->



    </div>
</aside><!-- .col -->