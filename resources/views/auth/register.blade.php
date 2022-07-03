<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- loader-->
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet" />

    <title>Daftar Peminjam | Kominfo Denpasar</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container" style="width: 60%">
                <div class="authentication-card">
                    <div class="card shadow rounded overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-4 p-sm-5">
                                    <center>
                                        <img width="150px" src="{{ asset('images/icons/kominfo-dps-shadow.png') }}"
                                            alt="">
                                    </center>
                                    <h4 class="card-title text-center mt-4">DINAS KOMINFO DENPASAR</h4>
                                    <form action="{{ route('register-process') }}" method="POST">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    {{-- Username --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="username">Username :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-person"></i>
                                                            </span>
                                                            <input name="username" id="username" type="text"
                                                                class="form-control 
                                                                @error('username') is-invalid @enderror"
                                                                placeholder="Username" aria-label="Username"
                                                                value="{{ old('username') }}">
                                                        </div>
                                                        @error('username')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{-- Name --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="name">Nama :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-card-heading"></i>
                                                            </span>
                                                            <input name="name" id="name" type="text"
                                                                class="form-control 
                                    @error('name') is-invalid @enderror"
                                                                placeholder="Nama" aria-label="name"
                                                                value="{{ old('name') }}">
                                                        </div>
                                                        @error('name')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{-- Email --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="email">Email :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-envelope"></i>
                                                            </span>
                                                            <input name="email" id="email" type="email"
                                                                class="form-control
                                    @error('email') is-invalid @enderror"
                                                                placeholder="Email" aria-label="email"
                                                                value="{{ old('email') }}">
                                                        </div>
                                                        @error('email')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{-- Gender --}}
                                                    <div>
                                                        <label class="mb-3 d-block" for="password">Jenis Kelamin
                                                            :</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="gender" id="pria" value="Pria" checked>
                                                            <label class="form-check-label" for="pria">Pria</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="gender" id="wanita" value="Wanita">
                                                            <label class="form-check-label"
                                                                for="wanita">Wanita</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    {{-- Phone --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="phone">Nomor Telepon :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-phone"></i>
                                                            </span>
                                                            <input name="phone" id="phone" type="text"
                                                                class="form-control 
                                                                @error('phone') is-invalid @enderror"
                                                                placeholder="Nomor Telepon" aria-label="phone"
                                                                value="{{ old('phone') }}">
                                                        </div>
                                                        @error('phone')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{-- Divisi --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="role">Divisi :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-building"></i>
                                                            </span>
                                                            <select name="division" id="division"
                                                                class="form-select 
                                                                @error('division') is-invalid @enderror"
                                                                aria-label="Divisi">
                                                                <option selected hidden value="">Pilih divisi
                                                                </option>
                                                                @foreach ($divisions as $division)
                                                                    @if (old('division') && old('division') == $division->id)
                                                                        <option selected
                                                                            value="{{ $division->id }}">
                                                                            {{ $division->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $division->id }}">
                                                                            {{ $division->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('division')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{-- Password --}}
                                                    <div class="mb-4">
                                                        <label class="mb-2" for="password">Password :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-lock"></i>
                                                            </span>
                                                            <input name="password" id="password" type="password"
                                                                class="form-control 
                                    @error('password') is-invalid @enderror"
                                                                placeholder="Password" aria-label="password"
                                                                value="{{ old('password') }}">
                                                            <div
                                                                class="border d-flex align-items-center justify-content-center px-3">
                                                                <a id="toggle-password" class="link-dark"
                                                                    href="#">
                                                                    <i id="eye-icon" class="bi bi-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                            <span class="text-danger position-absolute d-block">
                                                                <small>
                                                                    {{ $message }}
                                                                </small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-outline-primary mt-3 w-100">Simpan</button>
                                                    <p class="d-block mt-3 text-center">Sudah memiliki akun ? <a
                                                            href="/login">Login</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>


</body>

</html>
