@extends('layouts.caborlay')

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
                <h5 class="pe-6">Edit Data Berita</h5>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('cberita.index') }}" type="button" class="btn btn-secondary">Back</a>

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
                            <span class="badge bg-warning">belum tayang</span>
                            @elseif($data->aktif == 1)
                            <span class="badge bg-success">sudah tayang</span>
                            @else
                            <span class="badge bg-danger">perlu perbaikan</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        @if($cekulas == 0 || $data->aktif == 1)
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
                                    <p class="mb-0 chat-time mb-2"><b>{{ $p->editor }} </b>, {{ $p->tgl }}</p>
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
                <form action="{{ url('cabor/updatecberita') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="status" value="{{ $detail->idcabor }}">
                        <input type="hidden" name="aktif" value="{{ $data->aktif }}">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Judul Berita </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="judul" value="{{ $data->judul }}" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kategori Berita</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="id_katberita" required aria-label="Default select example">
                                                <option selected value="{{ $data->idkat }}">{{ $data->kategoriberita }}</option>
                                                @foreach ($kat as $p)
                                                <option value="{{$p->id}}">

                                                    {{ $p->nama }}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Berita </h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary">
                                            <input type="date" name="tgl_berita" value="{{ $data->tgl_berita }}" required class="form-control" />
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
                                                <input type='file' onchange="readURL(this);" hidden accept="image/png, image/gif, image/jpeg" name="file" />
                                                <img id="blah" src="{{ asset('berkas/berita/thumbnail/'.$data->foto) }}" class="card-img-top" />
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Isi Berita</h6><br>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea id="summernote" name="isi">{{ $data->isi }}</textarea>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tags Berita</h6><br>

                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="tag" value="{{ $data->tag }}" class="form-control" data-role="tagsinput">


                                        </div>
                                    </div>


                                    <br>



                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary ">SIMPAN DATA</button>
                                    </div>
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
    $('#summernote').summernote({

        tabsize: 2,
        height: 300
    });
</script>

@endsection