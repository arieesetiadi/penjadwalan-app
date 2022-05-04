{{-- Include header --}}
@include('layout.header')

<!--Start content-->
<main class="page-content">
    <!--breadcrumb-->
    <section>
        <div class="row">
            <div class="col">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <a href="{{ route('schedule.index') }}" class="d-inline-block" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Kembali">
                        <i class="bi bi-chevron-left text-dark"></i>
                    </a>
                    <div class="breadcrumb-title mx-2 pe-3">JADWAL</div>
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
            </div>
        </div>
    </section>
    <!--end breadcrumb-->

    {{-- Alert set --}}
    @include('components.alert-set')

    <div class="row">
        <div class="col-4">
            {{-- Form pengajuan --}}
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        Form Tambah Jadwal
                    </div>
                    <div class="card-body">
                        <form action="{{ route('schedule.store') }}" method="POST">
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
                                            @error('date') is-invalid @enderror"
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
                                                    @error('start') is-invalid @enderror"
                                                            aria-label="start" value="{{ old('start', '00:00') }}">
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
                                                    @error('end') is-invalid @enderror"
                                                            aria-label="end" value="{{ old('end', '00:00') }}">
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
                                            @error('description') is-invalid @enderror"
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

                                        {{-- Peminjam --}}
                                        <div class="mb-4">
                                            <label class="mb-2" for="role">Nama Peminjam :</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-building"></i>
                                                </span>
                                                <select name="user" id="user"
                                                    class="form-select 
                                                    @error('user') is-invalid @enderror"
                                                    aria-label="Divisi" required>
                                                    <option selected hidden value="">Nama peminjam</option>
                                                    @foreach ($users as $user)
                                                        @if (old('user') && old('user') == $user->id)
                                                            <option selected value="{{ $user->id }}">
                                                                {{ $user->name . ' - ' . $user->division->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $user->id }}">
                                                                {{ $user->name . ' - ' . $user->division->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('divisi')
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
            {{-- Kalender --}}
            @include('components.calendar')
        </div>
    </div>

</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
