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

    <section>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('request-process') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3">
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
                                        <textarea rows="3" name="description" id="description" type="description"
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
                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn btn-primary my-3 mt-4">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
