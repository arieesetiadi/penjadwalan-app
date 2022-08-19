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
                        <input name="key" class="form-control ps-5" type="text"
                            placeholder="Cari nama pengguna.." autocomplete="off">
                    </form>
                </div>
            </div>
            <div id="users-table-wrapper" class="table-responsive mt-3">
                <table id="users-table" class="table table-sm align-middle">
                    @if (count($users) > 0)
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Nama</th>
                                {{-- <th>Username</th> --}}
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Divisi</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th class="cell-head-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                @if ($user->id != auth()->user()->id)
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
                                        <td>
                                            {{ $user->division->name }}
                                        </td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            @if ($user->status)
                                                <span class="badge bg-success w-100">Aktif</span>
                                            @else
                                                <span class="badge bg-danger w-100">Nonaktif</span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="d-flex justify-content-center">
                                            <div class="table-actions d-flex align-items-center">
                                                {{-- Ubah --}}
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn text-dark"
                                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Ubah">
                                                    <i class="bi bi-pen"></i>
                                                </a>

                                                @if ($user->status)
                                                    {{-- Tombol disable user --}}
                                                    <div data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Nonaktifkan Pengguna">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#modal-user-disable-{{ $user->id }}">
                                                            <i class="fa-solid fa-power-off text-danger"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    {{-- Tombol Enable user --}}
                                                    <div data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Aktifkan Pengguna">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#modal-user-enable-{{ $user->id }}">
                                                            <i class="fa-solid fa-power-off text-success"></i>
                                                        </button>
                                                    </div>
                                                @endif

                                                {{-- Modal disable user --}}
                                                <div class="modal fade" id="modal-user-disable-{{ $user->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    @php
                                                        $runnings = getRunningByUserId($user->id);
                                                    @endphp
                                                    <div
                                                        class="modal-dialog {{ count($runnings) > 0 ? 'modal-xl' : 'modal-lg' }}">
                                                        <form action="{{ route('user.disable', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Nonaktifkan Pengguna
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if (count($runnings) > 0)
                                                                        <p><strong>{{ $user->name }}</strong> masih
                                                                            memiliki jadwal sebagai berikut :</p>

                                                                        <table id="schedule-table"
                                                                            class="table align-middle">
                                                                            <tr>
                                                                                <td>#</td>
                                                                                <td>Ruangan</td>
                                                                                <td>Tanggal</td>
                                                                                <td>Mulai</td>
                                                                                <td>Selesai</td>
                                                                                <td>Keterangan</td>
                                                                                <td>Status</td>
                                                                            </tr>
                                                                            @foreach ($runnings as $i => $running)
                                                                                <tr>
                                                                                    <td>{{ $i + 1 }}</td>
                                                                                    <td>{{ $running->room->name }}
                                                                                    </td>
                                                                                    <td>{{ dateFormat($running->date) }}
                                                                                    </td>
                                                                                    <td>{{ timeFormat($running->start) }}
                                                                                    </td>
                                                                                    <td>{{ timeFormat($running->end) }}
                                                                                    </td>
                                                                                    <td>{{ $running->description }}
                                                                                    </td>
                                                                                    <td>{!! makeStatus($running->status) !!}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>

                                                                        <hr class="text-white">

                                                                        {{-- Alasan disable user --}}
                                                                        <div class="form-floating">
                                                                            <textarea name="msg" class="form-control"
                                                                                placeholder="Alasan
                                                                                pengguna di-nonaktifkan"
                                                                                id="msg" style="height: 100px"></textarea>
                                                                            <label for="msg">Alasan
                                                                                pengguna di-nonaktifkan</label>
                                                                        </div>

                                                                        <hr class="text-white">

                                                                        <p class="d-block"><strong>- Note :
                                                                            </strong>Jadwal diatas akan
                                                                            dihapus jika pengguna ini dinonaktifkan.
                                                                            Tekan <strong>OK</strong> untuk melanjutkan.
                                                                        </p>
                                                                    @else
                                                                        {{-- Alasan disable user --}}
                                                                        <div class="form-floating">
                                                                            <textarea name="msg" class="form-control"
                                                                                placeholder="Alasan
                                                                                pengguna di-nonaktifkan"
                                                                                id="msg" style="height: 100px"></textarea>
                                                                            <label for="msg">Alasan
                                                                                pengguna di-nonaktifkan</label>
                                                                        </div>

                                                                        <hr class="text-white">

                                                                        <p class="d-block">
                                                                            <strong>{{ $user->name }}</strong> akan
                                                                            dinonaktifkan
                                                                            dari sistem. Tekan <strong>OK</strong> untuk
                                                                            melanjutkan.
                                                                        </p>
                                                                    @endif

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light border"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">OK</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                {{-- Modal enable user --}}
                                                <div class="modal fade" id="modal-user-enable-{{ $user->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('user.enable', $user->id) }}"
                                                            method="GET">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Aktifkan Pengguna
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong>{{ $user->name }}</strong> akan
                                                                    diaktifkan. Tekan <strong>OK</strong> untuk
                                                                    melanjutkan.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light border"
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
                                @endif
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
