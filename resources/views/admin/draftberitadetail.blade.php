@extends('layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }} " rel="stylesheet" />

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mx-auto">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="pe-6">Detail Draft Berita</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        @if($data->aktif == 0)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Verifikasi</button> &nbsp;
                        @elseif($data->aktif == 1)
                        @else
                        @endif
                        &nbsp<a href="{{ url('admin/draftberita') }}" type="button" class="btn btn-secondary">Back</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <hr>
        </div>
        @if(session()->has('error'))

        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show">
            <div>{{ session()->get('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <!--end breadcrumb-->
        <div class="mx-auto">
            <div class="card ">
                <div class="card-header bg-white">
                    <h6>Status Draft Berita
                    </h6>
                </div>
                <div class="card-body">



                    <dl class="row">
                        <dt class="col-sm-3">Status Berita</dt>
                        <dd class="col-sm-9">: @if($data->aktif == 0)
                            <span class="badge bg-warning">perlu verifikasi</span>
                            @elseif($data->aktif == 1)
                            <span class="badge bg-success">sudah tayang</span>
                            @else
                            <span class="badge bg-info">sedang perbaikan</span>
                            @endif
                        </dd>
                        <dt class="col-sm-3">Cabor Penulis</dt>
                        <dd class="col-sm-9">: {{ $data->cabor }}
                        </dd>



                    </dl>
                </div>
            </div>
        </div>

        @if($cekulas == 0)
        @else
        <div class="mx-auto">
            <div class="card ">
                <div class="card-header bg-white">
                    <h6>Catatan:
                    </h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        @foreach($ulasan as $p)
                        <div class="chat-content-leftside mb-3">
                            <div class="d-flex">

                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 chat-time mb-2"><b>{{ $p->editor }}</b>, {{ $p->tgl }}</p>
                                    <p class="chat-left-msg">{{ $p->balasan }}</p>
                                </div>
                            </div>
                        </div>

                        @endforeach


                    </dl>
                </div>
            </div>
        </div>
        @endif
        <div class="mx-auto">
            <div class="main-body">
                <form action="{{ url('admin/updateberita') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">


                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h6>Data Draft Berita
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Judul Berita </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" readonly name="judul" value="{{ $data->judul }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kategori Berita</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="id_katberita" required aria-label="Default select example">
                                                <option selected disabled value="{{ $data->idkat }}">{{ $data->kategoriberita }}</option>


                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Berita </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" readonly name="tgl_berita" value="{{ $data->tgl_berita }}" required class="form-control" />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Foto Berita</h6><br>
                                            <span class="text-small text-info">(1200x800) file format .jpg,png</span>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <label class="card-title cursor-pointer">

                                                <img src="{{ asset('berkas/berita/thumbnail/'.$data->foto) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Isi Berita</h6><br>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea id="summernote" readonly name="isi">{{ $data->isi }}</textarea>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tags Berita</h6><br>

                                        </div>

                                        <div class="col-sm-9 text-secondary">
                                            <div class="tagcloud">
                                                @if ($data->tag != "")
                                                @foreach(explode(',', $data->tag) as $info)

                                                <a href="#" class="btn btn-primary btn-sm">{{$info}}</a>
                                                @endforeach
                                                @endif



                                            </div>
                                            <!-- <input type="text" readonly name="tag" value="{{ $data->tag }}" class="form-control" data-role="tagsinput"> -->


                                        </div>
                                    </div>


                                    <br>




                                </div>
                            </div>


                        </div>




                    </div>

                    <div class="col-lg-8">
                        <br>
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('admin/draftberita/acc') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Verifikasi Draft Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row col-12">
                        <div class="mb-3 col-6">
                            <div class="form-check">
                                <input class="form-check-input" value="true" type="radio" name="status_user" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">Terima Berita</label>
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                            <div class="form-check">
                                <input class="form-check-input" value="false" type="radio" name="status_user" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">Tolak Berita</label>
                            </div>
                        </div>
                    </div>
                    <div id="false" class="desc">
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan :</label>
                            <textarea class="form-control" name="alasan" placeholder="Tulis alasan penolakan..." rows="3"></textarea>
                        </div>
                    </div>





                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Proses Verifikasi</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("div.desc").hide();
        $("input[name$='status_user']").click(function() {
            var test = $(this).val();
            $("div.desc").hide();
            $("#" + test).show();
        });
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $('#summernote').summernote('disable', {

        tabsize: 2,
        height: 300
    });
</script>

@endsection