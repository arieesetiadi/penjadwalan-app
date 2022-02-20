{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    {{-- Alert set --}}
    @include('components.alert-set')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">PENGGUNA</div>
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
                    <a href="{{ route('user.create') }}" class="btn btn-sm" title="Tambah Pengguna"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="bi bi-person-plus"></i>
                        Tambah
                    </a>
                </div>
                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                            class="bi bi-search"></i></div>
                    <form action="{{ route('user.search') }}" method="GET">
                        <input name="key" class="form-control ps-5" type="text" placeholder="Cari nama pengguna..">
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
                                {{-- <th>Username</th> --}}
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Divisi</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
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
                                    {{-- <td>{{ $user->username }}</td> --}}
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>
                                        {{ $user->division->name }}
                                    </td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <a href="{{ route('user.edit', $user->id) }}" class="text-dark"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modal-user-delete-{{ $user->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modal-user-delete-{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('user.destroy', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Konfirmasi
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Data <strong>{{ $user->name }}</strong> akan dihapus
                                                                dari sistem.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light border"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">OK</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
