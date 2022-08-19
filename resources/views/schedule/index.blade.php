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
                        <input name="key" class="form-control ps-5" type="text" placeholder="Cari jadwal.."
                            autocomplete="off">
                    </form>
                </div>
            </div>
            <div id="schedules-table-wrapper" class="table-responsive mt-3">
                <table id="schedules-table" class="table table-sm align-middle">
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
                                <td class="cell-head-center">Notulen</td>
                                <td class="cell-head-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $i => $schedule)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $schedule->room->name }}</td>

                                    {{-- Peminjam --}}
                                    <td>
                                        <div>
                                            <div class="d-inline-block" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Detail Peminjam">
                                                <a href="#" class="text-dark" data-bs-toggle="modal"
                                                    data-bs-target="#modal-borrower-{{ $schedule->id }}">
                                                    <i class="bi bi-info-circle-fill d-inline-block mx-1"></i>
                                                </a>
                                            </div>
                                            {{ $schedule->borrower->name }}
                                        </div>

                                        <div class="modal fade" id="modal-borrower-{{ $schedule->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Detail dari
                                                            <strong>{{ $schedule->borrower->name }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td>Nama Lengkap</td>
                                                                <td>:</td>
                                                                <td>{{ $schedule->borrower->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Divisi</td>
                                                                <td>:</td>
                                                                <td>{{ $schedule->borrower->division->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alamat Email</td>
                                                                <td>:</td>
                                                                <td>{{ $schedule->borrower->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Telepon</td>
                                                                <td>:</td>
                                                                <td>{{ $schedule->borrower->phone }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


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
                                        <div class="modal fade" id="modal-detail-{{ $schedule->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                    {{-- Tampil Notulen --}}
                                    <td>
                                        @if ($schedule->note)
                                            <div class="table-actions d-flex align-items-center gap-3">
                                                <div data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Tampilkan Notulen" class="w-100 text-center">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-note-show-{{ $schedule->id }}">
                                                        Tampil
                                                    </a>
                                                </div>

                                                <div class="modal fade" id="modal-note-show-{{ $schedule->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title d-block" id="exampleModalLabel">
                                                                    Notulen {{ $schedule->description }}
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body" style="border: 1px solid black">
                                                                <span>Diunggah pada :
                                                                    {{ dateTimeFormat($schedule->note->created_at) }}</span>
                                                                <hr>

                                                                {{-- Content Text --}}
                                                                @if ($schedule->note->content_text)
                                                                    <div class="text-wrap w-100"
                                                                        style="word-wrap: break-word">
                                                                        {!! $schedule->note->content_text !!}</div>
                                                                @endif

                                                                {{-- Content Image --}}
                                                                @php
                                                                    $imageNames = str($schedule->note->content_image)->explode('|');
                                                                @endphp

                                                                @if (count($imageNames) > 0)
                                                                    <hr>
                                                                    <div id="carouselExampleControls"
                                                                        class="carousel slide"
                                                                        data-bs-ride="carousel">
                                                                        <div class="carousel-inner">
                                                                            @for ($i = 0; $i < count($imageNames) - 1; $i++)
                                                                                <div
                                                                                    class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                                                    <img width="100%"
                                                                                        src="{{ asset('uploaded/images/' . $imageNames[$i]) }}"
                                                                                        alt="Content Image"
                                                                                        class="rounded">
                                                                                </div>
                                                                            @endfor
                                                                        </div>
                                                                        <button class="carousel-control-prev"
                                                                            type="button"
                                                                            data-bs-target="#carouselExampleControls"
                                                                            data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span
                                                                                class="visually-hidden">Previous</span>
                                                                        </button>
                                                                        <button class="carousel-control-next"
                                                                            type="button"
                                                                            data-bs-target="#carouselExampleControls"
                                                                            data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Next</span>
                                                                        </button>
                                                                    </div>
                                                                @endif

                                                                {{-- Content File --}}
                                                                @php
                                                                    $fileNames = str($schedule->note->content_file)->explode('|');
                                                                @endphp

                                                                @if (count($fileNames) > 0)
                                                                    <hr>
                                                                    @for ($i = 0; $i < count($fileNames) - 1; $i++)
                                                                        <a target="_blank"
                                                                            href="{{ asset('uploaded/files/' . $fileNames[$i]) }}"
                                                                            class="d-block my-1">
                                                                            <i class="bi bi-download"></i> Download
                                                                            Lampiran | {{ $fileNames[$i] }}
                                                                        </a>
                                                                    @endfor
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <center>-</center>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="d-flex justify-content-center">
                                        <div class="table-actions d-flex align-items-center gap-3">
                                            <form action="{{ route('schedule.edit', $schedule->id) }}"
                                                method="GET">
                                                <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Ubah"
                                                    {{ $schedule->status == 4 ? 'disabled' : '' }}>
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
                                                    {{ $schedule->status == 4 ? 'disabled' : '' }}>
                                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Batal" class="bi bi-x-circle-fill text-danger"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modal-schedule-delete-{{ $schedule->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
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
                                                                <span class="text-wrap">
                                                                    Jadwal
                                                                    <strong>{{ $schedule->description }}</strong> akan
                                                                    dibatalkan. Silahkan cantumkan alasan dari
                                                                    pembatalan jadwal.
                                                                </span>
                                                                <div class="py-3">
                                                                    <div class="form-floating">
                                                                        <textarea required name="cancelMessage" class="form-control" placeholder="Masukan alasan penolakan"
                                                                            id="alasanPenolakan" style="height: 100px"></textarea>
                                                                        <label for="alasanPenolakan">Alasan
                                                                            pembatalan</label>
                                                                    </div>
                                                                </div>
                                                                <span>
                                                                    Tekan <strong>OK</strong> untuk melanjutkan
                                                                    pembatalan jadwal.
                                                                </span>
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
