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

    {{-- Jadwal Aktif --}}
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
                                <td>Informasi</td>
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

                                    {{-- Detail --}}
                                    <td>
                                        <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Tampilkan Detail Jadwal" class="d-inline">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-detail-active-{{ $active->id }}">Detail</a>
                                        </div>

                                        {{-- Modal Detail Jadwal Aktif --}}
                                        <div class="modal fade" id="modal-detail-active-{{ $active->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Jadwal <strong>{{ $active->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- 1.  Peminjam
                                                            2.  Diajukan Pada
                                                            3.  Disetujui Pada
                                                            4.  Dibuat Pada
                                                            5. Diubah Pada --}}
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

                                    {{-- Aksi --}}
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            {{-- Selesaikan rapat --}}
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Selesaikan Rapat">
                                                <a href="#" class="on-schedule-finish d-none" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-finish-{{ $active->id }}">
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                </a>
                                            </div>

                                            {{-- Batal rapat --}}
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Batal">
                                                <a href="#" class="" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $active->id }}">
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                </a>
                                            </div>

                                            {{-- Modal Batalkan rapat --}}
                                            <div class="modal fade" id="modal-schedule-delete-{{ $active->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.cancel', $active->id) }}"
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

                                            {{-- Modal Selesaikan rapat --}}
                                            <div class="modal fade" id="modal-schedule-finish-{{ $active->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.finish', $active->id) }}"
                                                        method="GET">
                                                        <input name="id" type="hidden" value="{{ $active->id }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Selesaikan Rapat
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                    Tekan OK untuk menyelesaikan rapat
                                                                </p>
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

    {{-- Pengajuan --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Pengajuan</h6>
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
                                <td>Informasi</td>
                                <td>Status</td>
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

                                        {{-- Modal Detail Jadwal Aktif --}}
                                        <div class="modal fade" id="modal-detail-pending-{{ $pending->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Pengajuan
                                                            <strong>{{ $pending->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- 1.  Peminjam
                                                            2.  Diajukan Pada --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($pending->status == 'active')
                                            <span class="" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Disetujui">
                                                <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
                                            </span>
                                        @elseif ($pending->status == 'decline')
                                            <span class="" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Ditolak">
                                                <i class="bi bi-x-circle-fill text-danger"></i>
                                            </span>
                                        @elseif ($pending->status == 'pending')
                                            <span class="" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Pending">
                                                <i class="bi bi-clock-fill text-warning"></i>
                                            </span>
                                        @elseif ($pending->status == 'finish')
                                            <span class="" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Selesai">
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="d-flex justify-content-right">
                                        @if ($pending->status == 'decline')
                                            <a href="{{ route('request.edit', $pending->id) }}"
                                                class="d-inline-block" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Ajukan Kembali">
                                                <i class="bi bi-arrow-up-circle-fill text-dark"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-arrow-up-circle-fill text-white"></i>
                                        @endif

                                        <div class="table-actions d-flex align-items-center gap-3">
                                            {{-- Batalkan pengajuan --}}
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Batal">
                                                <a href="#" type="button" class="d-inline-block mx-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $pending->id }}">
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                </a>
                                            </div>

                                            {{-- Modal batal pengajuan --}}
                                            <div class="modal fade" id="modal-schedule-delete-{{ $pending->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.cancel', $pending->id) }}"
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
                <h6 class="text-center">-</h6>
            @endif
        </div>
    </div>

    {{-- Riwayat --}}
    <div class="card">
        <div class="card-header">
            <h6 class="text-center text-dark mt-2">Riwayat Jadwal</h6>
        </div>
        <div class="card-body">
            @if (count($finishSchedules) > 0)
                <div id="users-table-wrapper" class="table-responsive">
                    <table id="users-table" class="table align-middle">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Informasi</td>
                                <td>Notulen</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($finishSchedules as $i => $finish)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ dateFormat($finish->date) }}</td>
                                    <td>{{ timeFormat($finish->start) }}</td>
                                    <td>{{ timeFormat($finish->end) }}</td>
                                    <td>{{ $finish->description }}</td>

                                    {{-- Detail --}}
                                    <td>
                                        <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Tampilkan Detail Riwayat" class="d-inline">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-detail-finish-{{ $finish->id }}">Detail</a>
                                        </div>

                                        {{-- Modal Detail Jadwal Aktif --}}
                                        <div class="modal fade" id="modal-detail-finish-{{ $finish->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Riwayat
                                                            <strong>{{ $finish->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- 1.  Peminjam
                                                            2.  Diajukan Pada
                                                            3.  Disetujui Pada
                                                            4.  Dibuat Pada
                                                            5. Diubah Pada --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Notulen --}}
                                    <td>-</td>

                                    {{-- Aksi --}}
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="{{ $finish->note ? '' : 'Upload Notulen' }}">
                                                <button {{ $finish->note ? 'disabled' : '' }} type="button"
                                                    class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $finish->id }}">
                                                    <i class="bi bi-upload"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modal-schedule-delete-{{ $finish->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    @include('components.notulen-form')
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
