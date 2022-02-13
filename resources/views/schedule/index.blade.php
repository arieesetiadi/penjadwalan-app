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
                    <a href="{{ route('schedule.create') }}" class="btn btn-sm" title="Tambah Pengguna"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </a>
                </div>
                @if (count($schedules) > 1)
                    <div>
                        <button class="btn btn-sm" title="Export Excell" data-bs-toggle="tooltip"
                            data-bs-placement="bottom">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            Excell
                        </button>
                        <button class="btn btn-sm" title="Export PDF" data-bs-toggle="tooltip"
                            data-bs-placement="bottom">
                            <i class="bi bi-file-earmark-pdf"></i>
                            PDF
                        </button>
                    </div>
                @endif
                <div class="ms-auto position-relative">
                </div>
            </div>
            <div id="schedules-table-wrapper" class="table-responsive mt-3">
                <table id="schedules-table" class="table align-middle">
                    @if (count($schedules) > 0)
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tanggal Rapat</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Keterangan</td>
                                <td>Peminjam</td>
                                <td>Diajukan pada</td>
                                <td>Disetujui pada</td>
                                <td>Disetujui oleh</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $i => $schedule)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ dateFormat($schedule->date) }}</td>
                                    <td>{{ timeFormat($schedule->start) }}</td>
                                    <td>{{ timeFormat($schedule->end) }}</td>
                                    <td>{{ $schedule->description }}</td>

                                    {{-- Peminjam --}}
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <span>{{ $schedule->borrower->name }}</span>
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Detail Peminjam">
                                                <a href="#" class="" data-bs-toggle="modal"
                                                    data-bs-target="#modal-borrower-{{ $schedule->id }}">
                                                    <i class="bi bi-info-square-fill"></i>
                                                </a>
                                            </div>
                                            <div class="modal fade" id="modal-borrower-{{ $schedule->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Detail Peminjam
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                @if ($schedule->borrower->gender == 'Pria')
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
                                                                class="mb-3 d-block">{{ $schedule->borrower->name }}</span>

                                                            <span class="text-dark d-block">Divisi
                                                                :</span>
                                                            <span
                                                                class="mb-3 d-block">{{ $schedule->borrower->division->name }}</span>

                                                            <span class="text-dark d-block">Email
                                                                :</span>
                                                            <span
                                                                class="mb-3 d-block">{{ $schedule->borrower->email }}</span>

                                                            <span class="text-dark d-block">Telepon
                                                                :</span>
                                                            <span
                                                                class="mb-3 d-block">{{ $schedule->borrower->phone }}</span>

                                                            <span class="text-dark d-block">Jenis
                                                                Kelamin :</span>
                                                            <span
                                                                class="mb-3 d-block">{{ $schedule->borrower->gender }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $schedule->requested_at != null ? dateFormat($schedule->requested_at) : '-' }}
                                    </td>
                                    <td>{{ $schedule->approved_at != null ? dateFormat($schedule->approved_at) : '-' }}
                                    </td>

                                    {{-- Petugas --}}
                                    @if ($schedule->user_officer_id > 0)
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3">
                                                <span>{{ $schedule->officer->name }}</span>
                                                <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Detail Petugas">
                                                    <a href="#" class="" data-bs-toggle="modal"
                                                        data-bs-target="#modal-officer-{{ $schedule->id }}">
                                                        <i class="bi bi-info-square-fill"></i>
                                                    </a>
                                                </div>
                                                <div class="modal fade" id="modal-officer-{{ $schedule->id }}"
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
                                                                    @if ($schedule->officer->gender == 'Pria')
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
                                                                    class="mb-3 d-block">{{ $schedule->officer->name }}</span>

                                                                <span class="text-dark d-block">Divisi
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $schedule->officer->division->name }}</span>

                                                                <span class="text-dark d-block">Email
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $schedule->officer->email }}</span>

                                                                <span class="text-dark d-block">Telepon
                                                                    :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $schedule->officer->phone }}</span>

                                                                <span class="text-dark d-block">Jenis
                                                                    Kelamin :</span>
                                                                <span
                                                                    class="mb-3 d-block">{{ $schedule->officer->gender }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
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
