{{-- Include header --}}
@include('layout.header')

<!--Start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div>
        <div class="row">
            <div class="col">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">DASHBOARD</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><i class="bx bx-home-alt"></i>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ auth()->user()->role->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- Alert set --}}
    @include('components.alert-set')

    <div>
        <div class="row">
            <div class="col">
                <div class="card radius-10 border-0 border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Jadwal Pending</p>
                                <h4 class="mb-0">{{ $countPending }}</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-warning text-white">
                                <i class="bi bi-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-0 border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Jadwal Aktif</p>
                                <h4 class="mb-0">{{ $countActive }}</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-primary text-white">
                                <i class="bi bi-list-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Active --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Jadwal Aktif</h6>
        </div>
        <div class="card-body">
            @if (count($activeSchedules) > 0)
                <div id="users-table-wrapper" class="table-responsive">
                    <table id="users-table" class="table align-middle">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Status</td>
                                <td>Diajukan pada</td>
                                <td>Disetujui pada</td>
                                <td>Disetujui oleh</td>
                                <td>Countdown</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activeSchedules as $i => $active)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ dateFormat($active->date) }}</td>
                                    <td>{{ timeFormat($active->start) }}</td>
                                    <td>{{ timeFormat($active->end) }}</td>
                                    <td>{{ $active->description }}</td>

                                    <td>
                                        @if ($active->status == 'active')
                                            <span class="badge bg-primary text-white">Disetujui</span>
                                        @elseif ($active->status == 'decline')
                                            <span class="badge bg-danger text-white">Ditolak</span>
                                        @elseif ($active->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($active->status == 'finish')
                                            <span class="badge bg-success text-white">Selesai</span>
                                        @endif
                                    </td>

                                    <td>{{ dateFormat($active->requested_at) }}</td>

                                    <td>{{ !is_null($active->approved_at) ? dateFormat($active->approved_at) : '-' }}
                                    </td>

                                    <td>
                                        @if ($active->user_officer_id)
                                            <div class="table-actions d-flex align-items-center gap-3">
                                                <span>{{ $active->officer->name }}</span>
                                                <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Detail Petugas">
                                                    <a href="#" class="" data-bs-toggle="modal"
                                                        data-bs-target="#modal-officer-{{ $active->id }}">
                                                        <i class="bi bi-info-square-fill"></i>
                                                    </a>
                                                </div>
                                                <div class="modal fade" id="modal-officer-{{ $active->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Detail Petugas
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    @if ($active->officer->gender == 'Pria')
                                                                        <img src="{{ asset('images/avatars/man.png') }}"
                                                                            alt="" class="rounded-circle" width="100"
                                                                            height="100" class="my-3 d-block">
                                                                    @else
                                                                        <img src="{{ asset('images/avatars/woman.png') }}"
                                                                            alt="" class="rounded-circle" width="100"
                                                                            height="100" class="my-3 d-block">
                                                                    @endif
                                                                </center>
                                                                <span class="text-dark d-block">Nama
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $active->officer->name }}</span>

                                                                <span class="text-dark d-block">Divisi
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $active->officer->division->name }}</span>

                                                                <span class="text-dark d-block">Email
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $active->officer->email }}</span>

                                                                <span class="text-dark d-block">Telepon
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $active->officer->phone }}</span>

                                                                <span class="text-dark d-block">Jenis
                                                                    Kelamin :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $active->officer->gender }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if (!is_null($active->approved_at))
                                            <strong>
                                                <span class="countdown"
                                                    data-then="{{ $active->date . ' ' . $active->start }}"
                                                    data-schedule-id="{{ $active->id }}"></span>
                                            </strong>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $active->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modal-schedule-delete-{{ $active->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.destroy', $active->id) }}"
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
                                                                Jadwal rapat
                                                                <strong>{{ $active->description }}</strong> akan
                                                                dibatalkan.
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
                    </table>
                </div>
            @else
                <h6 class="text-center">Pengguna tidak memiliki jadwal pinjaman</h6>
            @endif
        </div>
    </div>

    {{-- Pending --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Jadwal Pending</h6>
        </div>
        <div class="card-body">
            @if (count($pendingSchedules) > 0)
                <div id="users-table-wrapper" class="table-responsive">
                    <table id="users-table" class="table align-middle">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Status</td>
                                <td>Diajukan pada</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingSchedules as $i => $pending)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ dateFormat($pending->date) }}</td>
                                    <td>{{ timeFormat($pending->start) }}</td>
                                    <td>{{ timeFormat($pending->end) }}</td>
                                    <td>{{ $pending->description }}</td>

                                    <td>
                                        @if ($pending->status == 'active')
                                            <span class="badge bg-primary text-white">Disetujui</span>
                                        @elseif ($pending->status == 'decline')
                                            <span class="badge bg-danger text-white">Ditolak</span>
                                        @elseif ($pending->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($pending->status == 'finish')
                                            <span class="badge bg-success text-white">Selesai</span>
                                        @endif
                                    </td>

                                    <td>{{ dateFormat($pending->requested_at) }}</td>

                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $pending->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modal-schedule-delete-{{ $pending->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.destroy', $pending->id) }}"
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
                                                                Jadwal rapat
                                                                <strong>{{ $pending->description }}</strong> akan
                                                                dibatalkan.
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
                    </table>
                </div>
            @else
                <h6 class="text-center">Pengguna tidak memiliki jadwal pending</h6>
            @endif
        </div>
    </div>
</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
