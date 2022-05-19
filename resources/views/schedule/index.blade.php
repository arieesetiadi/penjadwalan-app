{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    {{-- Alert set --}}
    @include('components.alert-set')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">JADWAL</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><i class="bx bx-home-alt"></i>
                    </li>
                    <li class="breadcrumb-item schedule" aria-current="page">{{ $title ??= 'Title' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- table --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                {{-- schedule buttons --}}
                <div>
                    <a href="{{ route('schedule.create') }}" class="btn btn-sm" title="Tambah Jadwal"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </a>
                </div>
                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                            class="bi bi-search"></i></div>
                    <form action="{{ route('schedule.search') }}" method="GET">
                        <input name="key" class="form-control ps-5" type="text" placeholder="Cari jadwal..">
                    </form>
                </div>
            </div>
            <div id="schedules-table-wrapper" class="table-responsive mt-3">
                <table id="schedules-table" class="table align-middle">
                    @if (count($schedules) > 0)
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Ruangan</td>
                                <td>Nama Peminjam</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td class="cell-head-center">Status</td>
                                <td class="cell-head-center">Informasi</td>
                                <td class="cell-head-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $i => $schedule)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $schedule->room->name }}</td>
                                    <td>{{ $schedule->borrower->name }}</td>
                                    <td>{{ dateFormat($schedule->date) }}</td>
                                    <td>{{ timeFormat($schedule->start) }}</td>
                                    <td>{{ timeFormat($schedule->end) }}</td>
                                    <td>{{ $schedule->description }}</td>

                                    {{-- Status --}}
                                    <td class="cell-head-center">
                                        {!! makeStatus($schedule->status) !!}
                                    </td>

                                    {{-- Detail --}}
                                    <td>
                                        <center>
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Tampilkan Detail Jadwal" class="d-inline">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-detail-{{ $schedule->id }}">Detail</a>
                                            </div>
                                        </center>

                                        {{-- Modal Detail Jadwal --}}
                                        <div class="modal fade" id="modal-detail-{{ $schedule->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail Jadwal
                                                            <strong>{{ $schedule->description }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-sm table-borderless">
                                                            {{-- Peminjam --}}
                                                            @if ($schedule->borrower)
                                                                {{-- <tr>
                                                                    <td>Peminjam</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-2 offset-1">
                                                                                @if ($schedule->borrower->gender == 'Pria')
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
                                                                                    class="d-block">{{ $schedule->borrower->name }}
                                                                                </span>
                                                                                <span
                                                                                    class="d-block">{{ $schedule->borrower->division->name }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr> --}}
                                                            @endif

                                                            {{-- Diajukan Pada --}}
                                                            @if ($schedule->requested_at)
                                                                <tr>
                                                                    <td>Diajukan pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($schedule->requested_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Disetujui Pada --}}
                                                            @if ($schedule->approved_at)
                                                                <tr>
                                                                    <td>Disetujui pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($schedule->approved_at) }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            {{-- Dibuat Pada --}}
                                                            @if ($schedule->created_at)
                                                                <tr>
                                                                    <td>Dibuat pada</td>
                                                                    <td>:</td>
                                                                    <td>{{ dateTimeFormat($schedule->created_at) }}
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

                                    {{-- Aksi --}}
                                    <td class="d-flex justify-content-center">
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <form action="{{ route('schedule.edit', $schedule->id) }}" method="GET">
                                                <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Ubah"
                                                    {{ $schedule->status == 'finish' ? 'disabled' : '' }}>
                                                    <i class="bi bi-pen"></i>
                                                </button>
                                            </form>
                                            {{-- <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                class="text-dark" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Ubah">
                                                <i class="bi bi-pen"></i>
                                            </a> --}}
                                            <div>
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modal-schedule-delete-{{ $schedule->id }}"
                                                    {{ $schedule->status == 'finish' ? 'disabled' : '' }}>
                                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"
                                                        class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade"
                                                id="modal-schedule-delete-{{ $schedule->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('schedule.destroy', $schedule->id) }}"
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
                                                                <strong>{{ $schedule->description }}</strong> akan
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
                    @else
                        <thead>
                            <h6 class="text-center">Data jadwal tidak ditemukan.</h6>
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
