{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    {{-- Alert untuk keberhasilan --}}
    @if (session('status'))
        <div
            class="alert border-0 border-success border-start border-4 bg-light-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="ms-3">
                    <div class="text-success">{{ session('status') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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

    {{-- table --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                {{-- user buttons --}}
                <div>
                    <a href="{{ route('user.create') }}" class="btn btn-sm ">
                        <i class="bi bi-person-plus"></i>
                        Tambah
                    </a>
                </div>
                @if (count($users) > 1)
                    <div>
                        <button class="btn btn-sm ">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            Excell
                        </button>
                        <button class="btn btn-sm ">
                            <i class="bi bi-file-earmark-pdf"></i>
                            PDF
                        </button>
                    </div>
                @endif
                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                            class="bi bi-search"></i></div>
                    <form action="{{ route('user.search') }}" method="GET">
                        <input name="key" class="form-control ps-5" type="text" placeholder="Cari nama user..">
                    </form>
                </div>
            </div>
            <div id="users-table-wrapper" class="table-responsive mt-3">
                <table id="users-table" class="table align-middle">
                    @if (count($users) > 0)
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Divisi</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if ($user->gender == 'Pria')
                                            <img src="{{ asset('images/avatars/man.png') }}" alt=""
                                                class="rounded-circle" width="35" height="35">
                                        @else
                                            <img src="{{ asset('images/avatars/woman.png') }}" alt=""
                                                class="rounded-circle" width="35" height="35">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>
                                        {{ $user->division->name }}
                                    </td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                            <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Ubah">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <thead>
                            <h6 class="text-center">Data pengguna tidak ditemukan.</h6>
                        </thead>
                    @endif
                </table>
            </div>
        </div>
    </div>
    {{-- end table --}}

</main>
<!--end page main-->

{{-- Include footer --}}
@include('layout.footer')
