{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">USERS</div>
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
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- username --}}
                            <div class="mb-4">
                                <label class="mb-2" for="username">Username :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input name="username" id="username" type="text" class="form-control 
                                    @error('username')
                                        is-invalid
                                    @enderror" 
                                    placeholder="Username" aria-label="Username" value="{{ old('username') }}">
                                </div>
                                @error('username')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- name --}}
                            <div class="mb-4">
                                <label class="mb-2" for="name">Nama :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-card-heading"></i>
                                    </span>
                                    <input name="name" id="name" type="text" class="form-control 
                                    @error('name')
                                        is-invalid
                                    @enderror" 
                                    placeholder="Nama" aria-label="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- email --}}
                            <div class="mb-4">
                                <label class="mb-2" for="email">Email :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input name="email" id="email" type="email" class="form-control
                                    @error('email')
                                        is-invalid
                                    @enderror"
                                    placeholder="Email" aria-label="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- phone --}}
                            <div class="mb-4">
                                <label class="mb-2" for="phone">Nomor Telepon :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <input name="phone" id="phone" type="number" class="form-control 
                                    @error('phone')
                                        is-invalid
                                    @enderror"
                                    placeholder="Nomor Telepon" aria-label="phone" value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{-- instansi --}}
                            <div class="mb-4">
                                <label class="mb-2" for="instansi">Nama Instansi :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <input name="instansi" id="instansi" type="text" class="form-control 
                                    @error('instansi')
                                        is-invalid
                                    @enderror"
                                    placeholder="Nama Instansi" aria-label="instansi" data-url="{{ route('search-instansi') }}" value="{{ old('instansi') }}">
                                </div>
                                @error('instansi')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- password --}}
                            <div class="mb-4">
                                <label class="mb-2" for="password">Password :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input name="password" id="password" type="password" class="form-control 
                                    @error('password')
                                        is-invalid
                                    @enderror"
                                        placeholder="Password" aria-label="password">
                                </div>
                                @error('password')
                                    <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- user role --}}
                            <div class="mb-4">
                                <label class="mb-2" for="userRole">Jenis Pengguna :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-briefcase"></i>
                                    </span>
                                    <select name="userRole" id="userRole" class="form-select 
                                    @error('userRole')
                                        is-invalid
                                    @enderror"
                                        aria-label="User Roles">
                                        <option selected hidden value="">Pilih jenis pengguna</option>
                                        @foreach ($userRoles as $userRole)
                                            <option value="{{ $userRole->id }}">{{ $userRole->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('userRole')
                                        <span class="text-danger position-absolute d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- gender --}}
                            <div>
                                <label class="mb-3 d-block" for="password">Jenis Kelamin :</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="pria" value="Pria"
                                        checked>
                                    <label class="form-check-label" for="pria">Pria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="wanita"
                                        value="Wanita">
                                    <label class="form-check-label" for="wanita">Wanita</label>
                                </div>
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
