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

    {{-- Summary --}}
    <div class="row">
        {{-- Jumlah Pengajuan --}}
        <div class="col">
            <div class="card radius-10 border-0 border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Jumlah Pengajuan</p>
                            <h4 class="mb-0">{{ $countPending }}</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-warning text-white">
                            <i class="bi bi-list"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jumlah Jadwal --}}
        <div class="col">
            <div class="card radius-10 border-0 border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Jumlah Jadwal Aktif</p>
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

    {{-- Daftar jadwal aktif --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Daftar Jadwal Aktif</h6>
        </div>
        <div class="card-body">
            @if (count($activeSchedules) > 0)
                <div id="users-table-wrapper" class="table-responsive" style="max-height: 200px">
                    <table id="users-table" class="table align-middle">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Informasi</td>
                                <td>Countdown</td>
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

                                    {{-- Detail --}}
                                    <td>
                                        <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Tampilkan Detail Jadwal Aktif" class="d-inline">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-detail-active-{{ $active->id }}">Detail</a>
                                        </div>

                                        {{-- Modal Detail Pengajuan --}}
                                        <div class="modal fade" id="modal-detail-active-{{ $active->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Jadwal
                                                            <strong>{{ $active->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-sm table-borderless">
                                                            {{-- Peminjam --}}
                                                            <tr>
                                                                <td>Peminjam</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2 offset-1">
                                                                            @if ($active->borrower->gender == 'Pria')
                                                                                <img src="{{ asset('images/avatars/man.png') }}"
                                                                                    alt="" width="50%">
                                                                                </p>
                                                                            @else
                                                                                <img src="{{ asset('images/avatars/woman.png') }}"
                                                                                    alt="" width="50%">
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <span
                                                                                class="d-block">{{ $active->borrower->name }}
                                                                            </span>
                                                                            <span
                                                                                class="d-block">{{ $active->borrower->division->name }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            {{-- Diajukan Pada --}}
                                                            @if ($active->requested_at)
                                                                <tr>
                                                                    <td>Diajukan pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($active->requested_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Disetujui Pada --}}
                                                            @if ($active->approved_at)
                                                                <tr>
                                                                    <td>Disetujui pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($active->approved_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Dibuat Pada --}}
                                                            @if ($active->created_at)
                                                                <tr>
                                                                    <td>Dibuat pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($active->created_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Countdown --}}
                                    <td>
                                        <strong>
                                            <span class="countdown"
                                                data-then="{{ $active->date . ' ' . $active->start }}"></span>
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h6 class="text-center">-</h6>
            @endif
        </div>
    </div>

    {{-- Daftar pengajuan --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Daftar Pengajuan Jadwal</h6>
        </div>
        <div class="card-body">
            @if (count($pendingSchedules) > 0)
                <div id="users-table-wrapper" class="table-responsive" style="max-height: 200">
                    <table id="users-table" class="table align-middle">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Informasi</td>
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

                                    {{-- Detail --}}
                                    <td>
                                        <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Tampilkan Detail Pengajuan" class="d-inline">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-detail-pending-{{ $pending->id }}">Detail</a>
                                        </div>

                                        {{-- Modal Detail Pengajuan --}}
                                        <div class="modal fade" id="modal-detail-pending-{{ $pending->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Pengajuan
                                                            <strong>{{ $pending->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-sm table-borderless">
                                                            {{-- Peminjam --}}
                                                            <tr>
                                                                <td>Peminjam</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2 offset-1">
                                                                            @if ($pending->borrower->gender == 'Pria')
                                                                                <img src="{{ asset('images/avatars/man.png') }}"
                                                                                    alt="" width="50%">
                                                                                </p>
                                                                            @else
                                                                                <img src="{{ asset('images/avatars/woman.png') }}"
                                                                                    alt="" width="50%">
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <span
                                                                                class="d-block">{{ $pending->borrower->name }}
                                                                            </span>
                                                                            <span
                                                                                class="d-block">{{ $pending->borrower->division->name }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            {{-- Diajukan Pada --}}
                                                            @if ($pending->requested_at)
                                                                <tr>
                                                                    <td>Diajukan pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($pending->requested_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Disetujui Pada --}}
                                                            @if ($pending->approved_at)
                                                                <tr>
                                                                    <td>Disetujui pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($pending->approved_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Dibuat Pada --}}
                                                            @if ($pending->created_at)
                                                                <tr>
                                                                    <td>Dibuat pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($pending->created_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            {{-- Setuju --}}
                                            <div>
                                                <a href="#" class="text-dark" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-approve-{{ $pending->id }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Setujui">
                                                    <i class="bi bi-hand-thumbs-up-fill text-dark"></i>
                                                </a>
                                            </div>
                                            <div class="modal fade"
                                                id="modal-schedule-approve-{{ $pending->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.approve', $pending->id) }}"
                                                        method="GET">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Persetujuan
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Tekan OK untuk menyetujui jadwal
                                                                <strong>{{ $pending->description }}</strong>.
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

                                            {{-- Tolak --}}
                                            <div>
                                                <a href="#" class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-decline-{{ $pending->id }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tolak">
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                </a>
                                            </div>
                                            <div class="modal fade"
                                                id="modal-schedule-decline-{{ $pending->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.decline') }}" method="POST">
                                                        @csrf
                                                        <input name="id" type="hidden" value="{{ $pending->id }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Tolak Pengajuan
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                    Tuliskan pesan untuk peminjam !
                                                                </p>
                                                                <textarea class="form-control mb-3" name="declineMessage" id="declineMessage" rows="6"
                                                                    placeholder="Alasan penolakan jadwal"
                                                                    required></textarea>
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
                <h6 class="text-center">-</h6>
            @endif
        </div>
    </div>


</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
