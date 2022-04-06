{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <a href="{{ route('user.index') }}" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom"
            title="Kembali">
            <i class="bi bi-chevron-left text-dark"></i>
        </a>
        <div class="breadcrumb-title mx-2 pe-3">PENGGUNA</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><i class="bx bx-home-alt"></i>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ??= 'Title' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                        value="{{ old('username', $user->username) }}">
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
                                        placeholder="Nama" aria-label="name" value="{{ old('name', $user->name) }}">
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
                                        value="{{ old('email', $user->email) }}">
                                </div>
                                @error('email')
                                    <span class="text-danger position-absolute d-block">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-4">
                                <label class="mb-2" for="phone">Nomor Telepon :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <input name="phone" id="phone" type="number"
                                        class="form-control 
                                    @error('phone') is-invalid @enderror"
                                        placeholder="Nomor Telepon" aria-label="phone"
                                        value="{{ old('phone', $user->phone) }}">
                                </div>
                                @error('phone')
                                    <span class="text-danger position-absolute d-block">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                                        <option selected hidden value="">Pilih divisi</option>
                                        @foreach ($divisions as $division)
                                            @if (old('division') && old('division') == $division->id)
                                                <option selected value="{{ $division->id }}">{{ $division->name }}
                                                </option>
                                            @elseif ($division->id == $user->division_id)
                                                <option selected value="{{ $division->id }}">{{ $division->name }}
                                                </option>
                                            @else
                                                <option value="{{ $division->id }}">{{ $division->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('divisi')
                                    <span class="text-danger position-absolute d-block">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-4">
                                <label class="mb-2" for="password">Password (Optional) :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input name="password" id="password" type="password"
                                        class="form-control 
                                    @error('password') is-invalid @enderror"
                                        placeholder="Password" aria-label="password" value="{{ old('password') }}">
                                    <div class="border d-flex align-items-center justify-content-center px-3">
                                        <a id="toggle-password" class="link-dark" href="#">
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

                            {{-- Role --}}
                            <div class="mb-4">
                                <label class="mb-2" for="role">Jenis Pengguna :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-briefcase"></i>
                                    </span>
                                    <select name="role" id="role"
                                        class="form-select 
                                    @error('role') is-invalid @enderror"
                                        aria-label="User Roles">
                                        <option selected hidden value="">Pilih jenis pengguna</option>
                                        @foreach ($roles as $role)
                                            @if (old('role') && old('role') == $role->id)
                                                <option selected value="{{ $role->id }}">{{ $role->name }}
                                                </option>
                                            @elseif ($role->id == $user->role_id)
                                                <option selected value="{{ $role->id }}">{{ $role->name }}
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <span class="text-danger position-absolute d-block">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                @enderror
                            </div>

                            {{-- Gender --}}
                            <div>
                                <label class="mb-3 d-block" for="password">Jenis Kelamin :</label>
                                @foreach (['Pria', 'Wanita'] as $gender)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                            id="{{ strtolower($gender) }}" value="{{ $gender }}"
                                            {{ $gender == $user->gender ? 'checked' : '' }}>

                                        <label class="form-check-label"
                                            for="{{ strtolower($gender) }}">{{ $gender }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="btn btn-primary my-3 mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end form --}}

</main>
<!--end page main-->

{{-- Include footer --}}
@include('layout.footer')
