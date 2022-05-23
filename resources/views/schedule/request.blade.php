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

    {{-- Alert set --}}
    @include('components.alert-set')

    <div class="row">
        <div class="col-4">
            {{-- Form pengajuan --}}
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        Form Pengajuan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('request.process') }}" method="POST">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{-- Date --}}
                                        <div class="mb-4">
                                            <label class="mb-2" for="date">Tanggal :</label>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                                <input name="date" id="date" type="date"
                                                    class="form-control
                                            @error('date') is-invalid @enderror"
                                                    aria-label="date"
                                                    value="{{ old('date', now()->format('Y-m-d')) }}"
                                                    onchange="validateDate()">
                                            </div>
                                            @error('date')
                                                <span class="text-danger position-absolute d-block">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </span>
                                            @enderror
                                            <span id="msg-date-invalid" class="text-danger d-none mt-1">
                                                <small>
                                                    Tanggal yang dipilih tidak valid.
                                                </small>
                                            </span>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-6">
                                                {{-- Start --}}
                                                <div>
                                                    <label class="mb-2" for="start">Waktu Mulai :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-clock"></i>
                                                        </span>
                                                        <input name="start" id="start" type="time"
                                                            class="form-control 
                                                    @error('start') is-invalid @enderror"
                                                            aria-label="start" value="{{ old('start') }}"
                                                            onchange="validateHour()">
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
                                                <div>
                                                    <label class="mb-2" for="end">Waktu Selesai :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-clock-history"></i>
                                                        </span>
                                                        <input name="end" id="end" type="time"
                                                            class="form-control 
                                                    @error('end') is-invalid @enderror"
                                                            aria-label="end" value="{{ old('end') }}"
                                                            onchange="validateHour()">
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
                                            <span id="msg-time-invalid"
                                                class="text-danger {{ session('invalidTime') ? 'd-block' : 'd-none' }} mt-1">
                                                <small>
                                                    Waktu yang dipilih tidak valid.
                                                </small>
                                            </span>
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

                                        {{-- Ruangan --}}
                                        <div class="mb-4">
                                            <label class="mb-2" for="room">Pilih Ruangan :</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-building"></i>
                                                </span>
                                                <select name="room" id="room"
                                                    class="form-select 
                                                    @error('room') is-invalid @enderror">
                                                    <option selected hidden value="">Pilih ruangan</option>
                                                    @foreach ($rooms as $room)
                                                        @if (old('room') && old('room') == $room->id)
                                                            <option selected value="{{ $room->id }}">
                                                                {{ $room->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $room->id }}">
                                                                {{ $room->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('room')
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
                                        <button id="btn-request-submit"
                                            class="btn btn-primary my-3 mt-3 px-5">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-8">
            @include('components.calendar')
        </div>
    </div>

</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
