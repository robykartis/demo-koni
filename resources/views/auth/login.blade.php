<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>Login - Koni Kota Pekanbaru</title>
</head>
<style>
    .form-control:focus {
        border-color: #ffd450;
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    .has-error .form-control:focus {
        box-shadow: none;
        -webkit-box-shadow: none;
    }
</style>

<body>
    <!-- wrapper -->
    <div class="wrapper bg-white">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-12 mx-auto">
                    <div class="container">
                        <div class="row g-0">
                            <div class="col-lg-7 my-auto">
                                <div class="text-start">
                                    <h2><img src="{{ asset('assets/images/koni.png') }}" width="60" height="40" alt="">
                                        Login Administrator</h2>
                                   
                                </div>


                                <img src="{{ asset('assets/images/bgkoni.png') }}" class="card-img login-img w-80 h-80" alt="...">
                            </div>
                            <div class="col-lg-5 my-auto mx-auto">
                                <div class="card">
                                    <div class="card-header bg-warning"></div>


                                    <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="p-5">

                                            <h4 class="mt-0 font-weight-bold">Silahkan Login</h4>
                                            <p class="text-muted mb-0">untuk mendapatkan akses dashboard administrator</p>
                                            <hr>
                                            @if(session()->has('error'))
                                            <div class="alert border-0 border-start border-2 border-danger alert-dismissible fade show py-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="font-20 text-danger"><i class='bx bx-meh'></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 text-danger">Login Gagal !! </h6>
                                                        <div> {{ session()->get('error') }}</div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            @endif
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Alamat Email</label>
                                                <input type="email" name="email" required class="form-control" placeholder="Masukan alamat email" />
                                                @error('error')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kata Sandi</label>
                                                <input type="password" required name="password" class="form-control" placeholder="Masukan kata sandi" />
                                                @error('error')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="d-grid gap-2 mt-5">
                                                <button type="submit" class="btn btn-warning">MASUK</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
</body>

</html>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>