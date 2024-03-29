<section>
    <div class="card">
        <div class="card-header bg-light">
            <center>
                <a href="{{ route('change-month', ['current' => $current->format('Y-m-d'), 'counter' => -1]) }}">
                    <i class="bi bi-caret-left-square-fill text-dark"></i>
                </a>
                <span class="d-block-inline mx-4">{{ $current->isoFormat('MMMM Y') }}</span>
                <a href="{{ route('change-month', ['current' => $current->format('Y-m-d'), 'counter' => 1]) }}">
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
                            <div class="btn btn-sm w-100">
                                <span class="d-block font-24 text-center">-</span>
                            </div>
                        </div>
                    @endfor

                    {{-- Looping / tampilkan seluruh tanggal di bulan ini --}}
                    @foreach ($datesOfMonth as $i => $dateOfMonth)
                        <div class="col-7 mb-3">
                            {{-- Tombol date --}}
                            <button onclick="setDateToForm('{{ $dateOfMonth->format('Y-m-d') }}')"
                                class="date-button btn btn-sm shadow-sm {{ isToday($dateOfMonth) ? 'date-button-active btn-primary' : 'btn-outline-secondary' }} w-100 position-relative {{ isPass($dateOfMonth) ? 'disabled bg-light text-secondary shadow-none' : '' }}">
                                <span class="d-block text-center my-2">{{ $dateOfMonth->isoFormat('D') }}</span>
                                <a href="#" class="{{ count($dataInMonth[$i]) <= 0 ? 'd-none' : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#modal-data-in-date-{{ $i }}">
                                    <span class="position-absolute top-0 start-100 translate-middle">
                                        <i class="bi bi-info-circle-fill text-dark"></i>
                                    </span>
                                </a>
                            </button>

                            {{-- Modal data jadwal --}}
                            <div class="modal fade" id="modal-data-in-date-{{ $i }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <div id="schedule-table-wrapper" class="table-responsive">
                                                        <table id="schedule-table" class="table align-middle">
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Ruangan</td>
                                                                <td>Peminjam</td>
                                                                <td>Tanggal</td>
                                                                <td>Mulai</td>
                                                                <td>Selesai</td>
                                                                <td>Keterangan</td>
                                                                <td>
                                                                    <center>
                                                                        Status
                                                                    </center>
                                                                </td>
                                                            </tr>

                                                            {{-- Content --}}
                                                            @foreach ($dataInMonth[$i] as $i => $data)
                                                                <tr>
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $data->room->name }}</td>
                                                                    <td>{{ $data->borrower->name }}</td>
                                                                    <td>{{ dateFormat($data->date) }}
                                                                    </td>
                                                                    <td>{{ timeFormat($data->start) }}
                                                                    </td>
                                                                    <td>{{ timeFormat($data->end) }}</td>
                                                                    <td>{{ $data->description }}</td>

                                                                    {{-- Status --}}
                                                                    <td>
                                                                        <center>
                                                                            {!! makeStatus($data->status) !!}
                                                                        </center>
                                                                    </td>
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
