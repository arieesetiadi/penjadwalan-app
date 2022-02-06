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

    {{-- Main Content --}}
    @if (session('greeting'))
        <div>
            <div class="row">
                <div class="col">
                    <div
                        class="alert border-0 border-success border-start border-4 bg-light-success alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="ms-3">
                                <div class="text-success">{{ session('greeting') }}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
        <div>
            <div class="row">
                {{-- Jumlah Pengguna --}}
                {{-- Hanya dilihat oleh Admin --}}
                @if (auth()->user()->role_id == 1)
                    <div class="col">
                        <div class="card radius-10 border-0 border-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1">Jumlah Pengguna</p>
                                        <h4 class="mb-0">8</h4>
                                    </div>
                                    <div class="ms-auto widget-icon bg-primary text-white">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                {{-- Jumlah Pengajuan --}}
                <div class="col">
                    <div class="card radius-10 border-0 border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <p class="mb-1">Jumlah Pengajuan</p>
                                    <h4 class="mb-0">3</h4>
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
                                    <p class="mb-1">Jumlah Jadwal</p>
                                    <h4 class="mb-0">6</h4>
                                </div>
                                <div class="ms-auto widget-icon bg-success text-white">
                                    <i class="bi bi-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar pengajuan --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="text-center text-dark mt-2">Daftar Pengajuan Jadwal</h6>
                </div>
                <div class="card-body">
                    <div id="users-table-wrapper" class="table-responsive">
                        <table id="users-table" class="table align-middle">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Tanggal</td>
                                    <td>Mulai</td>
                                    <td>Selesai</td>
                                    <td>Keterangan</td>
                                    <td>Peminjam</td>
                                    <td>Diajukan pada</td>
                                    <td>Divisi</td>
                                    <td>Tipe</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)

    @endif
</main>
<!--End Page Main-->

{{-- Include footer --}}
@include('layout.footer')
