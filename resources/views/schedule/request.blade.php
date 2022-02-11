{{-- Include header --}}
@include('layout.header')

<!--Start content-->
<main class="page-content">
    <!--breadcrumb-->
    <section>
        <div class="row">
            <div class="col">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">PENGAJUAN</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><i class="bx bx-home-alt"></i>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->

    {{-- Alert untuk keberhasilan --}}
    @if (session('warning'))
        <div
            class="alert border-0 border-danger border-start border-4 bg-light-danger alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="fs-3 text-danger"><i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="ms-3">
                    <div class="text-danger">{{ session('warning') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-4">
            {{-- Form pengajuan --}}
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        Form Pengajuan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('request-process') }}" method="POST">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{-- Date --}}
                                        <div class="mb-4">
                                            <label class="mb-2" for="date">Tanggal :</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                                <input name="date" id="date" type="date"
                                                    class="form-control
                                            @error('date')
                                                is-invalid
                                            @enderror"
                                                    aria-label="date" value="{{ old('date') }}">
                                            </div>
                                            @error('date')
                                                <span class="text-danger position-absolute d-block">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                {{-- Start --}}
                                                <div class="mb-4">
                                                    <label class="mb-2" for="start">Waktu Mulai :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-clock"></i>
                                                        </span>
                                                        <input name="start" id="start" type="time"
                                                            class="form-control 
                                                    @error('start')
                                                        is-invalid
                                                    @enderror"
                                                            aria-label="start" value="{{ old('start') }}">
                                                    </div>
                                                    @error('start')
                                                        <span class="text-danger position-absolute d-block">
                                                            <small>
                                                                {{ $message }}
                                                            </small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                {{-- End --}}
                                                <div class="mb-4">
                                                    <label class="mb-2" for="end">Waktu Selesai :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-clock-history"></i>
                                                        </span>
                                                        <input name="end" id="end" type="time"
                                                            class="form-control 
                                                    @error('end')
                                                        is-invalid
                                                    @enderror"
                                                            aria-label="end" value="{{ old('end') }}">
                                                    </div>
                                                    @error('end')
                                                        <span class="text-danger position-absolute d-block">
                                                            <small>
                                                                {{ $message }}
                                                            </small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Description --}}
                                        <div class="mb-4">
                                            <label class="mb-2" for="description">Keterangan :</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-chat-square-text"></i>
                                                </span>
                                                <textarea rows="3" name="description" id="description"
                                                    type="description"
                                                    class="form-control
                                            @error('description')
                                                is-invalid
                                            @enderror"
                                                    placeholder="Description"
                                                    aria-label="description">{{ old('description') }}</textarea>
                                            </div>
                                            @error('description')
                                                <span class="text-danger position-absolute d-block">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary my-3 mt-3 px-5">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-8">
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        <center>
                            <a href="#">
                                <i class="bi bi-caret-left-square-fill text-dark"></i>
                            </a>
                            <span class="d-block-inline mx-4">{{ $current->isoFormat('MMMM Y') }}</span>
                            <a href="#">
                                <i class="bi bi-caret-right-square-fill text-dark"></i>
                            </a>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid ">
                            <div class="row">
                                {{-- Looping nama hari sebagai header --}}
                                @foreach ($daysName as $dayName)
                                    <div class="col-7 pb-3">
                                        <span class="d-block text-center fw-bold">{{ $dayName }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                {{-- Looping blank --}}
                                @for ($i = 0; $i < $offset; $i++)
                                    <div class="col-7">
                                        <div class="btn w-100">
                                            <span class="d-block font-24 text-center my-2">-</span>
                                        </div>
                                    </div>
                                @endfor

                                {{-- Looping / tampilkan seluruh tanggal di bulan ini --}}
                                @foreach ($datesOfMonth as $i => $dateOfMonth)
                                    <div class="col-7 mb-3">
                                        {{-- Tombol date --}}
                                        <button onclick="setDateToForm('{{ $dateOfMonth->format('Y-m-d') }}')"
                                            class="btn shadow-sm {{ $dateOfMonth->format('Y-m-d') == now()->format('Y-m-d') ? 'btn-primary' : 'btn-outline-dark' }} w-100 position-relative">
                                            <span
                                                class="d-block text-center my-2">{{ $dateOfMonth->isoFormat('D') }}</span>
                                            <a href="#" class="{{ count($dataInMonth[$i]) <= 0 ? 'd-none' : '' }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-data-in-date-{{ $i }}">
                                                <span class="position-absolute top-0 start-100 translate-middle">
                                                    <i class="bi bi-info-circle-fill text-dark"></i>
                                                </span>
                                            </a>
                                        </button>

                                        {{-- Modal data jadwal --}}
                                        <div class="modal fade" id="modal-data-in-date-{{ $i }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <form action="#" method="post">
                                                    <div class="modal-content rounded">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Jadwal pada
                                                                <strong>{{ $dateOfMonth->isoFormat('dddd, D MMMM Y') }}</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (count($dataInMonth[$i]) > 0)
                                                                {{-- Tabel jadwal --}}
                                                                <div id="schedule-table-wrapper"
                                                                    class="table-responsive">
                                                                    <table id="schedule-table"
                                                                        class="table align-middle">
                                                                        <tr>
                                                                            <td>#</td>
                                                                            <td>Tanggal Rapat</td>
                                                                            <td>Mulai</td>
                                                                            <td>Selesai</td>
                                                                            <td>Keterangan</td>
                                                                            <td>Peminjam</td>
                                                                        </tr>

                                                                        {{-- Content --}}
                                                                        @foreach ($dataInMonth[$i] as $i => $data)
                                                                            <tr>
                                                                                <td>{{ $i + 1 }}</td>
                                                                                <td>{{ dateFormat($data->date) }}
                                                                                </td>
                                                                                <td>{{ timeFormat($data->start) }}
                                                                                </td>
                                                                                <td>{{ timeFormat($data->end) }}</td>
                                                                                <td>{{ $data->description }}</td>
                                                                                <td>{{ $data->borrower->name }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <h6>Tidak ada jadwal yang terdaftar.</h6>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
